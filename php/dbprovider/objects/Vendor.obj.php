<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "basetable.class.php";

class Vendor {
    protected $dsn;
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );
    protected $fieldList = array(
        'vendid',
        'addr1',
        'addr2',
        'city',
        'state',
        'zip',
        'apacct',
        'apsub',
        'status',
        'begbal',
        'ytdpurch',
        'ytdpymt',
        'ytddisctkn',
        'ytdcradjs',
        'ytddradjs',
        'ptdpurch',
        'ptdpaymt',
        'lastchkdate',
        'terms',
        'lastvodate',
        'paydatedflt',
        'expacct',
        'expsub',
        'vend1099',
        'bkupwthld',
        'tin',
        'cybox01',
        'cybox02',
        'cybox03',
        'cybox04',
        'cybox05',
        'cybox06',
        'cybox07',
        'cybox08',
        'nybox01',
        'nybox02',
        'nybox03',
        'nybox04',
        'nybox05',
        'nybox06',
        'nybox07',
        'nybox08',
        'cybox10',
        'nybox10',
        'cybox11',
        'nybox11',
        'cyinterest',
        'nyinterest',
        'dfltbox',
        'futurebal',
        'qmcreated',
        'user1',
        'user2',
        'user3',
        'user4',
        'lastname',
        'firstname',
        'addrid',
        'tax1',
        'tax2',
        'tax3',
        'tax4',
        'taxdflt',
        'taxpost',
        'taxregnbr',
        'taxlocnbr',
        'vendachacct',
        'vendachtype',
        'vendaddtype',
        'vendacct',
    );

    protected $addrFields = array(
        "addrid",
        "lastname",
        "addr1",
        "addr2",
        "city",
        "state",
        "zip",
        "phone",
        "telex",
        "fax",
    );

    protected $sharedFields = array(
        "lastname",
        "addrid",
        "firstname",

    );

    protected $fieldMap = array(
        "vendacct"=>"user1",
        "vendachacct"=>"user2",
        "vendachtype"=>"user3", // = 0 ?? '' :: (h.user3 = 1 ?? 'A' :: cast(h.user3 as zstring(2))) as vendachtype,
        "vendaddtype"=>"user4",
    );

    public function __construct() {
        $this->dsn = null;
    }

    public function findOpen() {
        $earlyDate = date("Y-m-d", strtotime("3 years ago"));
        $dataSet1 = $this->findWhere(array("lastvodate"=>$earlyDate));
        $dataSet2 = $this->findWhere(array("lastvodate"=>array("op"=>"LE","value"=>"1990-01-01")));

        return array_merge($dataSet1, $dataSet2);
    }

    protected function getACHType($value) {
        switch ($value) {
            case 0:
                return '';
                break;
            case 1:
                return 'A';
                break;
            default:
                return '';
        }
    }

    protected function getColumnName($field) {
        if (isset($this->fieldMap[$field])) {
            $column = $this->fieldMap[$field];
        }
        else {
            $column = $field;
        }
        return $column;
    }

    protected function getColumnValue($field, $row) {
        $column = $this->getColumnName($field);
        $value = $row->$column;
        if ($field == 'vendachtype') {
            $value = $this->getACHType($value);
        }
        return $value;
    }

    protected function buildQueryString($params) {
        $criteria = "";
        $ops = array(
            "LE"=>"<=",
            "GE"=>">=",
            "EQ"=>"="
        );
        foreach($params as $key => $value) {
            $critStr = "";
            // is this a mapped field?
            $column = $this->getColumnName($key);
            switch ($key) {
                case "vendid":
                case "lastname": // both vendid and lastname get "like"
                    $operator = " like ";
                    $value = "%$value%";
                    break;
                case "lastvodate":
                    if (is_array($value)) {
                        $operator = $ops[$value['op']];
                        $value = $value['value'];
                    }
                    else {
                        $operator = " >= ";
                    }
                    break;
                case "vendachtype":
                    switch ($value) {
                        case 'A':
                            $newVal = '1';
                            break;
                        default:
                            $newVal = '0';
                    }
                    $value = $newVal;
                    $operator = "=";
                    break;
                default:
                    $operator = "=";
            }
            $critStr = "$column $operator '$value'";
            $criteria = appendFieldList($critStr, $criteria, ' and ');
        }
        return $criteria;
    }

    protected function getDSN($parms) {
        if ($this->dsn !== null) {
            if (isset($parms['dsn'])) {
                unset($parms['dsn']);
            }
            return (object) array("parms"=>$parms, "dsn"=>$this->dsn);
        }
        if (!isset($parms['dsn']) || !isset($this->dsnMap[strtoupper($parms['dsn'])])) {
            $dsn = $this->dsnMap["CEN"];
        }
        else {
            $dsn = $this->dsnMap[strtoupper($parms['dsn'])];
        }
        $this->dsn = $dsn;
        unset($parms['dsn']);
        if (count($parms) < 1) {
            //$earlyDate = date("Y-m-d", strtotime("3 years ago"));
            //$parms["lastvodate"] = $earlyDate;
        }
        return (object) array("parms"=>$parms, "dsn"=>$dsn);
    }

    public function findWhere($params) {
        $tmpObj = $this->getDSN((array) $params);
        if (count($tmpObj->parms) < 1) {
            return $this->findOpen();
        }
        $params = $tmpObj->parms;
        $criteria = "";
        $criteria = $this->buildQueryString($params);
        if ($criteria !== "") {
            $hdrCriteria = array("header"=>$criteria);
        }
        else {
            $hdrCriteria = "";
        }
        $vendTable = new GenericPVSWTable("vendor", $this->dsn);
        $addrTable = new GenericPVSWTable("address", $this->dsn);
        $stmt = $vendTable->join(
            $addrTable,
            array("addrid"=>"addrid"),
            $hdrCriteria
        );
        $returnArray = array();
        foreach($stmt as $row) {
            $item = new StdClass();
            foreach($this->fieldList as $field) {
                $item->$field = $this->getColumnValue($field, $row);
            }
            $returnArray[] = $item;

        }
        return $returnArray;
    }

    protected function splitValues(&$updValues) {
        // split out any address fields that need to be updated
        $addrValues = array();
        foreach($this->addrFields as $field) {
            if (isset($updValues[$field])) {
                $addrValues[$field] = $updValues[$field];
                if (!in_array($field, $this->sharedFields)) {
                    unset($updValues[$field]);
                }
            }
        }
        return array('updValues'=>$updValues, 'addrValues'=>$addrValues);
    }

    public function insert($parms) {
        $criteria = (array) $parms;
        $tmpObj = $this->getDSN($criteria);
        $values = $tmpObj->parms;
        if (!isset($values['vendid'])) {
            throw new Exception("You must include a vendor ID");
        }
        $tmpVals = $this->splitValues($values);
        $addrVals = $tmpVals['addrValues'];
        $vendVals = $tmpVals['updValues'];
        $vendor = new GenericPVSWTable("vendor", $this->dsn);
        $address = new GenericPVSWTable("address", $this->dsn);
        $vendor->insert($vendVals);
        if (isset($values['addrid'])) {
            $address->insert($addrVals);
        }
        return $this->findWhere(array($values['vendid']));
    }

    public function update($criteria) {
        $tmpObj = $this->getDSN((array) $criteria);
        $keyDSN = $this->dsn;
        $updValues = (array) $tmpObj->parms;
        if (!isset($updValues['vendid'])) {
            throw new Exception("You must include a vendor to be update");
        }
        $newValues = $this->splitValues($updValues);
        $updValues = $newValues['updValues'];
        $addrValues = $newValues['addrValues'];
        $address = new GenericPVSWTable("address", $keyDSN);
        // Have to have the addrid before we can update the address
        $vend = $this->findWhere(array("vendid"=>$updValues['vendid']));
        if (count($vend) < 1) {
            throw new Exception("Couldn't find record for ".$updValues['vendid']);
        }
        $addrid = $vend[0]->addrid;
        $address->update(array("addrid"=>$addrid), $addrValues);
        return $this->bulkUpdate(array("vendid"=>$updValues['vendid'], "dsn"=>$keyDSN), $updValues);
    }

    public function bulkUpdate($keys, $updValues) {
        $dsn = $this->getDSN((array) $keys);
        $keys = (array) ($dsn->parms);
        $vendTable = new GenericPVSWTable("vendor", $this->dsn);
        if ($keys === null) {
            throw new Exception("You must provide a set of keys");
        }
        if ($keys === null) {
            throw new Exception("You must provide a set of values for the update");
        }
        return $vendTable->update($keys, $updValues);
    }

}
