<?php

require_once "basetable.class.php";

class Quotenumber {
    public function __construct() {
        // Thanks for making me
    }

    public function findOpen() {
        return $this->findWhere();
    }

    public function constructDataset() {
        $ds = array();
        $count = 0;
        foreach($this->currentStmt as $row) {
            $obj = new stdClass();
            $obj->ordnbr = $row['lastordnbr'];
            $ds[$count] = $obj;
        }
        return $ds;
    }

    public function findWhere() {
        // Parms are ignored
        $qtTable = new GenericMySqlTable("qtsetup", "quotes");
        $rs = $qtTable->findWhere(array("setupid"=>'Qt'));
        $dataSet = array();
        foreach($rs as $item) {
            $dataSet[] = $item;
        }
        return $dataSet;
    }

    public function insert() {
        // actually, just getting a new number
        // At each step check for all ok -- probably need to set this up to fail on
        // ANYTHING
        $qtSetup = new GenericMySqlTable("qtsetup", "quotes");
        $result = $qtSetup->directQuery("call getnextquotenumber()", null);
        $retAr = array();
        foreach($result as $item) {
            $retAr[] = $item;
        }
        return $retAr;

    }


}
