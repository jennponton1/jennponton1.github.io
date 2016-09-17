<?php

//require_once "htwdoctrine/htwdoctrine.inc.php";
require_once "basetable.class.php";

class QuoteAltAddress {
    protected $altAddr;
    protected $fieldMap = array(
        "altId",
        "custId",
        "shiptofname",
        "shiptolname",
        "shiptoaddr1",
        "shiptoaddr2",
        "shiptocity",
        "shiptostate",
        "shiptozip",
        "shiptophone",
        "shiptofax",
    );
    
    public function __construct() {
        $this->altAddr = new GenericMySqlTable("altaddr", "quotes");
    }
    
    public function findOpen() {
        return $this->findWhere(array());
    }
    
    public function findWhere($parms) {
        if (!is_array($parms)) {
            throw new Exception("You must include criteria form this!");
        }
        $critStr = "";
        foreach ($parms as $key => $val) {
            if ($critStr != "") {
                $critStr .= " and ";
            }
            switch ($key) {
                case "custid":
                    $critStr .= " qa.custId = '$val' ";
                    break;
                case "altid":
                    $critStr .= " qa.altId = '$val' ";
                    break;
                default:
                    throw new Exception("Not yet implemented");
            }
        }
        $rs = $this->altAddr->findWhere($parms);
        $ret = array();
        foreach($rs as $row) {
            $item = new stdClass();
            foreach($this->fieldMap as $field) {
                $dbCol = strtolower($field);
                $item->$field = $row->$dbCol;
            }
            $ret[] = $item;
        }
        return $ret;
    }
    
    public function insert($values) {
        // force all keys to lowercase
        $newValues = array();
        $values = (array) $values;
        foreach($values as $key => $value) {
            $newValues[strtolower($key)] = trim($value);
        }
        // Find the next ID for this customer
        $nextId = 0;
        $sql = "select max(altid*1) as lastid From altaddr where custid=?";
        $idRs = $this->altAddr->directQuery($sql, array($newValues['custid']));
        $row = $idRs->fetch();
        $lastid = $row->lastid;
        if ($lastid === null) {
            $nextId = 1;
        }
        else {
            $nextId = $lastid+1;
        }
        $newValues['altid'] = $nextId;
        $newItem= $this->altAddr->insert($newValues);
        $newItem = (object) $newItem;
        return array($newItem);
    }
    
}
