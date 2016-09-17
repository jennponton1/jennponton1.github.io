<?php

require_once "basetable.class.php";
require_once "extcalculator.class.php";

function isEmptyOrNull($value) {
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

class SalesOrder {

    protected $hdrFields            = array(
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
    protected $numericalFields = array(
        "ordqty",
        "qtyship",
        "slsprice",
        "extprice",
        "extpriceinvc",
        "wood",
        "trtadj",
        "freight",
        "treat",
        "lineid",
        "linenbr",
        'cnvfact',

    );
    protected $dtlFields            = array(
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
        'siteid',
        'linenbr',
        'lineid',
        'openline',
    );
    protected $hdrFieldsMap         = array(
        "sitetype"  => "user1",
        "deltcktno" => "user2",
        "nbrprts"   => "user3"
    );
    protected $dtlInsFieldMap       = array(
        "wood"    => "cost",
        'misc'    => 'user1',
        "freight" => 'user3',
        'treat'   => 'cmmnpct',
        'pcsship' => 'user2',
        'trtadj'  => 'user4',
    );
    protected $dtlFieldsMap         = array(
        "wood"    => "cost",
        'misc'    => 'user1',
        "freight" => 'user3',
        'treat'   => 'cmmnpct',
        'pcsship' => 'user2',
        'trtadj'  => 'user4',
    );
    protected $noUpdateFields       = array(
        'ordnbr',
        'ordtype',
        'bocntr'
    );
    protected $readOnlyHeaderFields = array(
        "custname"
    );
    protected $readOnlyFields       = array(
        'bf'       => "calcUnits",
        'bu'       => "calcUnits",
        'custname' => null,
    );
    protected $salesorder;
    protected $sodet;
    protected $db;
    protected $itemCache;
    protected $bfCalculator;

    public function __construct($dsn = "adohtwsol") {
        $this->salesorder   = new GenericPVSWTable("salesord", $dsn); //Sohdr($dsn);
        $this->sodet        = new GenericPVSWTable("sodet", $dsn); //Sodet($dsn);
        $this->db           = new DbProvider();
        $this->itemCache    = array();
        $this->bfCalculator = null;
    }

    protected function extractHeaderRecord($row) {
        $retObj = new stdClass();
        foreach ($this->hdrFields as $field) {
            $colName        = $this->getMappedColumn($field, $this->hdrFieldsMap);
            $colName .= "_h";
            $retObj->$field = $row->$colName;
        }
        $retObj->custname = $row->lastname_u;
        return $retObj;
    }

    protected function extractDetailRecord($row) {
        $retObj = new stdClass();
        foreach ($this->dtlFields as $field) {
            $colName        = $this->getMappedColumn($field, $this->dtlFieldsMap);
            $colName .= "_d";
            $retObj->$field = $row->$colName;
        }
        // add ReadOnly Records
        foreach ($this->readOnlyFields as $field => $method) {
            if ($method == null) {
                continue;
            }
            $retObj->$field = $this->$method($row, $field);
        }
        return $retObj;
    }

    protected function clearReadOnly(&$parms) {
        // parms should be a single order
        foreach ($this->readOnlyHeaderFields as $field) {
            if (is_array($parms)) {
                unset($parms[$field]);
            }
            else {
                unset($parms->$field);
            }
        }
        foreach ($parms->detail as $dtlRow) {
            foreach ($this->readOnlyFields as $fld => $method) {
                unset($dtlRow->$fld);
            }
        }
    }

    protected function populateCache($ordnbr) {
        return;
        $items = $this->db->findWhere("woodfactors", array("ordnbr" => $ordnbr));
        foreach ($items->data as $itemRow) {
            if (!isset($this->itemCache[$itemRow->woodid])) {
                $this->itemCache[$itemRow->woodid] = array(
                    "bf"      => $itemRow->bf,
                    "sf"      => $itemRow->sf,
                    "bndl"    => $itemRow->bndl,
                    "stkitem" => "Y",
                );
            }
        }
    }

    protected function calcUnits($row, $field) {
        // the row will have pieces and and invtid
        // check that the item hasn't already been calculated
        if ($this->bfCalculator == null) {
            $this->bfCalculator = new extCalculator();
        }
        $pcs        = $row->ordqty_d * $row->cnvfact_d;
        //$woodid = substr($row->invtid, 0, 1).substr($row->invtid, 4);
        $bffactor   = $row->bf_c;
        $sffactor   = $row->sf_c;
        $bndlfactor = $row->bndl_c;
        $stkitem    = 'Y';
        if ($row->stkitem_i != "Y") {
            $stkitem = 'N';
        }
        $this->bfCalculator->setPriceComponents(
            array(
                'invtid'   => $row->invtid_d,
                'wood'     => 0,
                'misc'     => 0,
                'freight'  => 0,
                'treating' => 0,
                'trtadj'   => 0,
                'slsprice' => 0,
                'pieces'   => $pcs,
                'bffac'    => $bffactor,
                'sffac'    => $sffactor,
                'bndlfac'  => $bndlfactor,
                'credit'   => false,
                'stkitem'  => $stkitem,
                'invctot'  => 0
            )
        );
        //$this->bfCalculator->calculate();
        $bf = $this->bfCalculator->extBF;
        $bu = $this->bfCalculator->extBU;
        switch ($field) {
            case "bf":
                return $bf;
                break;
            case "bu":
                return $bu;
                break;
            default:
                return 0;
        }
    }

    public function findOpen() {
        return $this->findWhere(array("openso" => "Y"));
    }

    public function findWhere($criteria = "") {
        $str      = "";
        $getNotes = false;
        $this->populateCache("");
        if (isset($criteria['notesonly'])) {
            $getNotes = true;
            unset($criteria['notesonly']);
        }
        if (isset($criteria['startdate'])) {
            $criteria['orddate'] = array("op" => "GE", "value" => $criteria['startdate']);
            unset($criteria['startdate']);
        }
        if (isset($criteria['sitetype'])) {
            $criteria['user1'] = $criteria['sitetype'];
            unset($criteria['sitetype']);
        }
        //        foreach($criteria as $field => $value) {
        //            if ($field == "startdate") {
        //                $col = $this->getMappedColumn("orddate", $this->hdrFieldsMap);
        //                $op = ">=";
        //            }
        //            else {
        //                $col = $this->getMappedColumn($field, $this->hdrFieldsMap);
        //                $op = "=";
        //            }
        //            if (strpos($value, "%") !== false) {
        //                $op = "like";
        //            }
        //            $str = appendFieldList($col." $op '$value'", $str, " and ");
        //        }

        $str       = $this->salesorder->buildWhere(array_keys($criteria), array_values($criteria), false);
        $joinArray = array("header" => $str);
        if ($getNotes) {
            $joinArray['join'] = "invtid=''";
        }
        $stmt = $this->salesorder->multiJoin(
            "h",
            array(
                "d" => "sodet",
                new JoinTable("u", "customer", array("lastname")),
                new JoinTable("i", "invntory", array("stkitem")),
                "c" => "htinconv",
            ),
            array(
                new JoinLink("IJ", "h.ordnbr", "d.ordnbr"),
                new JoinLink("IJ", "h.ordtype", "d.ordtype"),
                new JoinLink("IJ", "h.bocntr", "d.bocntr"),
                new JoinLink("IJ", "h.custid", "u.custid"),
                new JoinLink("OJ", "d.invtid", "c.invtid"),
                new JoinLink("OJ", "d.invtid", "i.invtid"),
            ),
            array(
                "header" => array(
                    "query" => $str,
                    "alias" => "h"
                )
            )
        );
        //throw new Exception(var_export($stmt, true));
//         $stmt = $this->salesorder->join(
//             $this->sodet,
//             array(
//                 "ordnbr"=>"ordnbr",
//                 "ordtype"=>"ordtype",
//                 "bocntr"=>"bocntr",
//             ),
//             $joinArray
//         );
        $soNewCriteria             = (array) $criteria;
        unset($soNewCriteria['ordtype']);
        unset($soNewCriteria['bocntr']);
        $soNewCriteria['sitetype'] = $criteria['user1'];
        unset($soNewCriteria['user1']);
        //unset($soNewCriteria['startdate']);
        $newRecs                   = $this->db->findWhere("salesordersnew", $soNewCriteria);
        $extraRecs                 = array();
        foreach ($newRecs->data as $newRow) {
            $key             = $newRow->ordnbr; //.$newRow->ordtype.$newRow->bocntr;
            $extraRecs[$key] = $newRow;
        }
        // Build Objects
        $hdrArray = array();
        foreach ($stmt as $row) {
            $ordnbr = $row->ordnbr_h;
            $key    = $ordnbr . $row->ordtype_h . $row->bocntr_h;
            if (!isset($hdrArray[$key])) {
                // Add the row
                $hdrArray[$key]            = $this->extractHeaderRecord($row);
                $hdrArray[$key]->emaillist = '';
                $hdrArray[$key]->export    = 'N';
                if (isset($extraRecs[$ordnbr])) {
                    $hdrArray[$key]->emaillist = $extraRecs[$ordnbr]->emaillist;
                    $hdrArray[$key]->export    = $extraRecs[$ordnbr]->export;
                }
                $hdrArray[$key]->detail = array();
            }
            $hdrArray[$key]->detail[] = $this->extractDetailRecord($row);
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
        foreach ($insertValues->detail as $dtlRow) {
            $dtlInsert = new StdClass();
            foreach ($this->sodet->getColumnList() as $colName) {
                $field = $this->getMappedField($colName, $this->dtlInsFieldMap);
                if (in_array($field, $this->dtlFields)) {
                    // Check for a numerical field
                    if (in_array($field, $this->numericalFields) && $dtlRow->$field == '') {
                        $dtlRow->$field = 0;
                        file_put_contents(__DIR__."/probs.txt", var_export($dtlRow, true), FILE_APPEND);
                    }
                    $dtlInsert->$colName = $dtlRow->$field;
                }
                else {
                    // check fields from header
                    if (in_array($colName, array("ordnbr", "ordtype", "bocntr", "custid"))) {
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
        foreach ($this->salesorder->getColumnList() as $colName) {
            $field = $this->getMappedField($colName, $this->hdrFieldsMap);
            if (in_array($field, $this->hdrFields)) {
                $insObj->$colName = $insertValues->$field;
            }
        }
        $this->salesorder->insert($insObj);
        $this->clearReadOnly($insertValues);
        $this->insertDetailRecords($insertValues);
        $newInsertValues = clone($insertValues);
        unset($newInsertValues->perent);
        try {
            $this->db->insertObject("salesordersnew", $newInsertValues);
        }
        catch (Exception $e) {
            file_put_contents("sonew_exception_log.log", $e->getMessage());
        }
        // Handle the salestax
        $taxValues       = (object) array(
                "ordnbr"  => $insertValues->ordnbr,
                "ordtype" => $insertValues->ordtype,
                "bocntr"  => $insertValues->bocntr,
                "custid"  => $insertValues->custid
        );
        $this->db->insertObject("salesordertax", $taxValues);
        return array($insertValues);
    }

    public function delete($values) {
        checkObjectOrArray($values);
        $values          = (array) $values;
        $keys            = array();
        $keys['ordnbr']  = $values['ordnbr'];
        $keys['ordtype'] = $values['ordtype'];
        $keys['bocntr']  = $values['bocntr'];
        foreach ($keys as $field => $value) {
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
        $newRec     = (object) $newRec;
        $updateList = array();
        foreach ($this->salesorder->getColumnList() as $columnName) {
            if (in_array($columnName, $this->readOnlyHeaderFields)) {
                continue;
            }
            if (in_array($columnName, $this->noUpdateFields)) {
                continue;
            }
            $fieldName = $this->getMappedField($columnName, $this->hdrFieldsMap);
            if (isset($newRec->$fieldName) && $oldRec->$fieldName != $newRec->$fieldName) {
                $updateList[$columnName] = $newRec->$fieldName;
            }
        }
        $keys   = array(
            "ordnbr"  => $oldRec->ordnbr,
            "ordtype" => $oldRec->ordtype,
            "bocntr"  => $oldRec->bocntr,
        );
        $retVal = $this->salesorder->update($keys, $updateList);
        if ($retVal === true) {
            $logObj       = (object) $updateList;
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
        for ($ndx = 0; $ndx < count($oldOrder->detail); $ndx++) {
            $linenbr                       = $oldOrder->detail[$ndx]->linenbr;
            $oldDtlArray[$linenbr]         = $oldOrder->detail[$ndx];
            $oldDtlArray[$linenbr]->custid = $oldOrder->custid;
        }
        $insertObject         = clone ($oldOrder);
        $insertObject->detail = array();
        $logArray             = array();
        foreach ($newOrder['detail'] as $detailRow) {
            // Check for an insert first
            $linenbr = $detailRow->linenbr;
            if (!isset($oldDtlArray[$linenbr])) {
                // This is an insert
                $insertObject->detail[] = (object) $detailRow;
                $insertObject->custid   = $this->setUpdateDetailCustomer($oldOrder, $newOrder);
                continue;
            }
            // Add the customer, a common field from the header
            $detailRow->custid = $this->setUpdateDetailCustomer($oldOrder, $newOrder);
            $updateArray       = array();
            foreach ($this->sodet->getColumnList() as $columnName) {
                if (in_array($columnName, $this->noUpdateFields)) {
                    continue;
                }
                $field = $this->getMappedField($columnName, $this->dtlInsFieldMap);
                if (isset($detailRow->$field) && $detailRow->$field != $oldDtlArray[$linenbr]->$field) {
                    $updateArray[$columnName] = $detailRow->$field;
                }
            }
            $keys = array(
                "ordnbr"  => $oldOrder->ordnbr,
                "ordtype" => $oldOrder->ordtype,
                "bocntr"  => $oldOrder->bocntr,
                "linenbr" => $linenbr
            );
            // ToDo: Logging changes to records
            if (count($updateArray) !== 0) {
                $logObject             = (object) $updateArray;
                $logObject->origInvtid = $oldDtlArray[$linenbr]->invtid;
                $logObject->changeType = "update";
                $logObject->keys       = $keys;
                $logArray[]            = $logObject;
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
        $ordnbr      = $params['ordnbr'];
        // Try an open order first
        $curOrderRes = $this->findWhere(array("ordnbr" => $ordnbr, "openso" => "Y"));
        if (count($curOrderRes) < 1 && $params['override'] == '1') {
            $soHdr = new GenericPVSWTable("salesord");
            $rs    = $soHdr->findWhere(array("ordnbr" => $ordnbr));
            $maxBO = -1;
            foreach ($rs as $row) {
                if ($row->bocntr > $maxBO) {
                    $maxBO = $row->bocntr;
                }
            }
            if ($maxBO < 0) {
                throw new Exception("Can't find this order $ordnbr");
            }
            unset($soHdr);
            $curOrderRes = $this->findWhere(array("ordnbr" => $ordnbr, "bocntr" => $maxBO));
            unset($params['override']);
        }
        if (count($curOrderRes) < 1) {
            throw new Exception("Can't get copy of open order for order # $ordnbr");
        }
        $oldOrder            = $curOrderRes[0];
        // Find the fields that changed
        $solParams           = $params;
        $this->clearReadOnly($oldOrder);
        $this->clearReadOnly($solParams);
        unset($solParams['emaillist']);
        unset($solParams['export']);
        $hdrChanges          = $this->updateHeader(clone $oldOrder, $solParams);
        $dtlChanges          = $this->updateDetail(clone $oldOrder, $solParams);
        $logObject           = new stdClass();
        $logObject->username = $updUser;
        $logObject->header   = $hdrChanges;
        $logObject->detail   = $dtlChanges;
        $tmpFile             = tempnam(__DIR__, "slslog");
        if ($tmpFile === false) {
            $tmpFile = __DIR__ . "/slslog" . date("his");
        }
        file_put_contents($tmpFile, serialize($logObject)."\n", FILE_APPEND);
        pclose(popen("start /d\"" . __DIR__ . "\" php.exe " . __DIR__ . "/salesorderlogger.php $tmpFile > NUL:", "r"));
        unset($params['perent']);
        unset($params['nbrprts']);
        unset($params['override']);
        unset($params['invcnbr']);
        unset($params['invctot']);
        unset($params['ourponbr']);
        $this->clearReadOnly($params);
        try {
            $this->db->updateObject("salesordersnew", (object) $params);
        }
        catch (Exception $e) {
            // @TODO: FOLLOW THIS UP!! FOR NOW JUST SAVING THE EXCEPTION!!
            file_put_contents("sonew_exception_log.log", $e->getMessage());
        }
        // Go get the new version of the object and return it
        return $this->findWhere(array("ordnbr" => $ordnbr, "ordtype" => $oldOrder->ordtype, "bocntr" => $oldOrder->bocntr));
    }

}
