<?php

require_once "basetable.class.php";
require_once "salesorder.obj.php";

function xisEmptyOrNull($value) {
    if (!isset($value)) {
        return true;
    }
    if ($value === null) {
        return true;
    }
    if ($value === "") {
        return true;
    }
    return false;
}

class ArchivedSalesOrder {
    protected $hdrFields = array(
        'ordnbr',
        'ordtype',
        'invcnbr',
        'status',
        'slsperid',
        'orddate',
        'shipvia',
        'fob',
        'terms',
        'custordnbr',
        'ourponbr',
        'ordtot',
        'invctot',
        'shipdate',
        'sitetype',
        'nbrprts',
        'perent',
        'perclosed',
        'custid',
        'bocntr',
        'deltcktno',
        'shipaddr1',
        'shipaddr2',
        'shipcity',
        'shiplastname',
        'shipfirstname',
        'shipstate',
        'shipzip',
        'shipaddressid',
        'linecntr',
        'openso',
    );
    protected $dtlFields = array(
        'invtid',
        'unitdesc',
        'cnvfact',
        'lotsernbr',
        'whseloc',
        'ordqty',
        'qtyship',
        'slsprice',
        'extprice',
        'extpriceinvc',
        'wood',
        'acct',
        'sub',
        'taxflag',
        'prcchngcode',
        'descr',
        'misc',
        'freight',
        'treat',
        'pcsship',
        'trtadj',
        'bfship',
        'billunits',
        'siteid',
        'linenbr',
        'lineid',
        'openline',
    );
    protected $hdrFieldsMap = array(
        "sitetype" => "user1",
        "deltcktno" => "user2",
        "nbrprts" => "user3"
    );
    protected $dtlInsFieldMap = array(
        "wood" => "cost",
        'misc' => 'user1',
        "freight" => 'user3',
        'treat' => 'cmmnpct',
        'pcsship' => 'user2',
        'trtadj' => 'user4',
    );
    protected $dtlFieldsMap = array(
        "wood" => "cost",
        'misc' => 'user1_2',
        "freight" => 'user3_2',
        'treat' => 'cmmnpct_2',
        'pcsship' => 'user2_2',
        'trtadj' => 'user4_2',
    );
    protected $noUpdateFields = array(
        'ordnbr',
        'ordtype',
        'bocntr'
    );
    protected $salesorder;
    protected $sodet;
    protected $db;

    public function __construct() {
        $this->salesorder = new GenericMySqlTable("slshdr"); //Sohdr($dsn);
        $this->sodet = new GenericMySqlTable("slsdet"); //Sodet($dsn);
        $this->db = new DbProvider();
    }

    protected function extractHeaderRecord($row) {
        $retObj = new stdClass();
        foreach($this->hdrFields as $field) {
            $colName = $this->getMappedColumn($field, $this->hdrFieldsMap);
            $retObj->$field = $row->$colName;
        }
        return $retObj;
    }

    protected function extractDetailRecord($row) {
        $retObj = new stdClass();
        foreach($this->dtlFields as $field) {
            $colName = $this->getMappedColumn($field, $this->dtlFieldsMap);
            $retObj->$field = $row->$colName;
        }
        return $retObj;
    }

    public function findOpen() {
        return $this->findWhere(array("openso"=>"Y"));
    }

    protected function getExtraRecs($criteria) {
        $extraRecs = array();
        $soNewCriteria = (array) $criteria;
        unset($soNewCriteria['ordtype']);
        unset($soNewCriteria['bocntr']);
        $soNewCriteria['sitetype'] = $criteria['user1'];
        unset($soNewCriteria['user1']);
        //unset($soNewCriteria['startdate']);
        $newRecs = $this->db->findWhere("salesordersnew", $soNewCriteria);
        foreach($newRecs->data as $newRow) {
            $key = $newRow->ordnbr; //.$newRow->ordtype.$newRow->bocntr;
            $extraRecs[$key] = $newRow;
        }
        return $extraRecs;
    }

    public function findWhere($criteria = "") {
        // Get open orders first
        $openOrds = new SalesOrder();
        $openList = $openOrds->findWhere(array_merge($criteria, array("openso"=>"Y")));
        return $openList;



        $str = "";
        $getNotes = false;
        if (isset($criteria['notesonly'])) {
            $getNotes = true;
            unset($criteria['notesonly']);
        }
        if (isset($criteria['startdate'])) {
            $criteria['orddate'] = array("op"=>"GE","value"=>$criteria['startdate']);
            unset($criteria['startdate']);
        }
        if (isset($criteria['sitetype'])) {
            $criteria['user1'] = $criteria['sitetype'];
            unset($criteria['sitetype']);
        }
        $str = $this->salesorder->buildWhere(array_keys($criteria), array_values($criteria), false);
        $joinArray = array("header"=>$str);
        if ($getNotes) {
            $joinArray['join'] = "invtid=''";
        }
        $stmt = $this->salesorder->join(
            $this->sodet,
            array(
                "ordnbr"=>"ordnbr",
                "ordtype"=>"ordtype",
                "bocntr"=>"bocntr",
                "custid"=>"custid",
                "weekended"=>"weekended",
            ),
            $joinArray
        );

        $extraRecs = $this->getExtraRecs($criteria);
        // Build Objects
        $hdrArray = array();
        foreach($stmt as $row) {
            $ordnbr = $row->ordnbr;
            if ($row->ordtype == 'BO') {
                $row->ordtype = 'OR';
            }
            $key = $ordnbr.$row->ordtype.$row->custid;
            if (!isset($hdrArray[$key])) {
                // Add the row
                $hdrArray[$key] = $this->extractHeaderRecord($row);
                $hdrArray[$key]->emaillist = '';
                $hdrArray[$key]->export = 'N';
                if (isset($extraRecs[$ordnbr])) {
                    $hdrArray[$key]->emaillist = $extraRecs[$ordnbr]->emaillist;
                    $hdrArray[$key]->export =  $extraRecs[$ordnbr]->export;
                }
                $hdrArray[$key]->tmpDtlIndx = array();
                $hdrArray[$key]->detail = array();
            }
            $dtlRow = $this->extractDetailRecord($row);
            $dtlKey = $dtlRow->invtid.$dtlRow->lineid;
            if (isset($hdrArray[$key]->tmpDtlIndx[$dtlKey])) {
                $ndx = $hdrArray[$key]->tmpDtlIndx[$dtlKey];
                $hdrArray[$key]->detail[$ndx]->pcsship += $dtlRow->pcsship;
                $hdrArray[$key]->detail[$ndx]->extpriceinvc += $dtlRow->extpriceinvc;
                $hdrArray[$key]->detail[$ndx]->qtyship += $dtlRow->qtyship;
                $hdrArray[$key]->detail[$ndx]->bfship += $dtlRow->bfship;
                $hdrArray[$key]->detail[$ndx]->billunits += $dtlRow->billunits;

                if ($hdrArray[$key]->detail[$ndx]->ordqty < $hdrArray[$key]->detail[$ndx]->qtyship) {
                    $hdrArray[$key]->detail[$ndx]->ordqty = $hdrArray[$key]->detail[$ndx]->qtyship;
                }
            }
            else {
                $hdrArray[$key]->detail[] = $dtlRow;
                $hdrArray[$key]->tmpDtlIndx[$dtlKey] = count($hdrArray[$key]->detail) - 1;
            }
        }
        foreach($hdrArray as $row) {
            unset($row->tmpDtlIndx);
        }
        return array_values($hdrArray);
    }

    protected function getMappedColumn($field, $map) {
        // finds the column name from a field
        if (isset($map[$field])) {
            return $map[$field];
        }
        return $field;
    }

    protected function getMappedField($columnName, $map) {
        // finds the field name from a column
        $tmp = array_search($columnName, $map);
        if ($tmp === false) {
            $tmp = $columnName;
        }
        return $tmp;
    }

    protected function insertDetailRecords($insertValues) {
        foreach($insertValues->detail as $dtlRow) {
            $dtlInsert = new StdClass();
            foreach($this->sodet->getColumnList() as $colName) {
                $field = $this->getMappedField($colName, $this->dtlInsFieldMap);
                if (in_array($field, $this->dtlFields)) {
                    $dtlInsert->$colName = $dtlRow->$field;
                }
                else {
                    // check fields from header
                    if (in_array($colName, array("ordnbr","ordtype","bocntr","custid"))) {
                        $dtlInsert->$colName = $insertValues->$colName;
                    }
                }
            }
            $this->sodet->insert($dtlInsert);
        }
    }

    public function insert($insertValues = "") {
        checkObjectOrArray($insertValues);
        // Build the SalesOrder Header object to be inserted
        $insObj = new stdClass();
        foreach($this->salesorder->getColumnList() as $colName){
            $field = $this->getMappedField($colName, $this->hdrFieldsMap);
            if (in_array($field, $this->hdrFields)) {
                $insObj->$colName = $insertValues->$field;
            }
        }
        $this->salesorder->insert($insObj);
        $this->insertDetailRecords($insertValues);
        $newInsertValues = clone($insertValues);
        unset($newInsertValues->perent);
        $this->db->insertObject("salesordersnew", $newInsertValues);
        // Handle the salestax
        $taxValues = (object) array(
            "ordnbr"=>$insertValues->ordnbr,
            "ordtype"=>$insertValues->ordtype,
            "bocntr"=>$insertValues->bocntr,
            "custid"=>$insertValues->custid
        );
        $this->db->insertObject("salesordertax", $taxValues);
        return array($insertValues);
    }

    public function delete($values) {
        checkObjectOrArray($values);
        $values = (array) $values;
        $keys = array();
        $keys['ordnbr'] = $values['ordnbr'];
        $keys['ordtype'] = $values['ordtype'];
        $keys['bocntr'] = $values['bocntr'];
        foreach($keys as $field => $value) {
            if (isEmptyOrNull($value)) {
                throw new Exception("You must pass a non-empty $field to the delete method");
            }
        }
        $this->salesorder->delete($keys);
        $this->sodet->delete($keys);
        unset($values['ordtype']);
        unset($values['bocntr']);
        $this->db->deleteWhere("salesordersnew", $values);
    }


    protected function updateHeader($oldRec, $newRec) {
        $newRec = (object) $newRec;
        $updateList = array();
        foreach($this->salesorder->getColumnList() as $columnName) {
            if (in_array($columnName, $this->noUpdateFields)) {
                continue;
            }
            $fieldName = $this->getMappedField($columnName, $this->hdrFieldsMap);
            if (isset($newRec->$fieldName) && $oldRec->$fieldName != $newRec->$fieldName) {
                $updateList[$columnName] = $newRec->$fieldName;
            }
        }
        $keys = array(
            "ordnbr" => $oldRec->ordnbr,
            "ordtype" => $oldRec->ordtype,
            "bocntr" => $oldRec->bocntr,
        );
        $retVal = $this->salesorder->update($keys, $updateList);
        if ($retVal === true) {
            $logObj = (object) $updateList;
            $logObj->keys = $keys;
            return $logObj;
        }
        else {
            return "failed";
        }
    }

    protected function setUpdateDetailCustomer($oldRec, $newRec) {
        if (isset($newRec['custid'])) {
            return $newRec['custid'];
        }
        else {
            return $oldRec->custid;
        }
    }

    protected function updateDetail($oldOrder, $newOrder) {
        $oldDtlArray = array();
        for($ndx = 0; $ndx < count($oldOrder->detail); $ndx++) {
            $linenbr = $oldOrder->detail[$ndx]->linenbr;
            $oldDtlArray[$linenbr] = $oldOrder->detail[$ndx];
            $oldDtlArray[$linenbr]->custid = $oldOrder->custid;
        }
        $insertObject = clone ($oldOrder);
        $insertObject->detail = array();
        $logArray = array();
        foreach($newOrder['detail'] as $detailRow) {
            // Check for an insert first
            $linenbr = $detailRow->linenbr;
            if (!isset($oldDtlArray[$linenbr])) {
                // This is an insert
                $insertObject->detail[] = (object) $detailRow;
                $insertObject->custid = $this->setUpdateDetailCustomer($oldOrder, $newOrder);
                continue;
            }
            // Add the customer, a common field from the header
            $detailRow->custid = $this->setUpdateDetailCustomer($oldOrder, $newOrder);
            $updateArray = array();
            foreach($this->sodet->getColumnList() as $columnName) {
                if (in_array($columnName, $this->noUpdateFields)) {
                    continue;
                }
                $field = $this->getMappedField($columnName, $this->dtlInsFieldMap);
                if (isset($detailRow->$field) && $detailRow->$field != $oldDtlArray[$linenbr]->$field) {
                    $updateArray[$columnName] = $detailRow->$field;
                }
            }
            $keys = array(
                "ordnbr"=>$oldOrder->ordnbr,
                "ordtype"=>$oldOrder->ordtype,
                "bocntr"=>$oldOrder->bocntr,
                "linenbr"=>$linenbr
            );
            // ToDo: Logging changes to records
            if (count($updateArray) !== 0) {
                $logObject = (object) $updateArray;
                $logObject->origInvtid = $oldDtlArray[$linenbr]->invtid;
                $logObject->changeType = "update";
                $logObject->keys = $keys;
                $logArray[] = $logObject;
            }
            $this->sodet->update($keys, $updateArray);
        } // Each detail Row;
        if (count($insertObject->detail) != 0) {
            // ToDo: Logging changes to records
            array_push($logArray, $insertObject->detail);
            $this->insertDetailRecords($insertObject);
        }
        return $logArray;
    }

    public function update($params = "") {
        checkObjectOrArray($params);
        $params = (array) $params;
        if (isset($params['username'])) {
            $updUser = $params['username'];
            unset($params['username']);
        }
        else {
            // We don't expect to be called CGI
            $updUser = $_SERVER['REMOTE_ADDR'];
        }
        // Get the open order for this order
        $ordnbr = $params['ordnbr'];
        // Try an open order first
        $curOrderRes = $this->findWhere(array("ordnbr"=>$ordnbr, "openso"=>"Y"));
        if (count($curOrderRes) < 1 && $params['override']=='1') {
            $soHdr = new GenericPVSWTable("salesord");
            $rs = $soHdr->findWhere(array("ordnbr"=>$ordnbr));
            $maxBO = -1;
            foreach($rs as $row) {
                if ($row->bocntr > $maxBO) {
                    $maxBO = $row->bocntr;
                }
            }
            if ($maxBO < 0) {
                throw new Exception("Can't find this order $ordnbr");
            }
            unset($soHdr);
            $curOrderRes = $this->findWhere(array("ordnbr"=>$ordnbr, "bocntr"=>$maxBO));
            unset($params['override']);
        }
        if (count($curOrderRes) < 1) {
            throw new Exception("Can't get copy of open order for order # $ordnbr");
        }
        $oldOrder = $curOrderRes[0];
        // Find the fields that changed
        $solParams = $params;
        unset($solParams['emaillist']);
        unset($solParams['export']);
        $hdrChanges = $this->updateHeader(clone $oldOrder, $solParams);
        $dtlChanges = $this->updateDetail(clone $oldOrder, $solParams);
        $logObject = new stdClass();
        $logObject->username = $updUser;
        $logObject->header = $hdrChanges;
        $logObject->detail = $dtlChanges;
        $tmpFile = tempnam(__DIR__, "slslog");
        if ($tmpFile === false) {
            $tmpFile = __DIR__."/slslog".date("his");
        }
        file_put_contents(
            $tmpFile,
            serialize($logObject)."\n",
            FILE_APPEND
        );
        pclose(popen("start /d\"".__DIR__."\" php.exe ".__DIR__."/salesorderlogger.php $tmpFile > NUL:", "r"));
        unset($params['perent']);
        unset($params['nbrprts']);
        $this->db->updateObject("salesordersnew", (object) $params);
        // Go get the new version of the object and return it
        return $this->findWhere(array("ordnbr"=>$ordnbr, "ordtype"=>$oldOrder->ordtype, "bocntr"=>$oldOrder->bocntr));
    }
}
