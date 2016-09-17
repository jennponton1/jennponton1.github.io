<?php

require_once "basetable.class.php";
require_once __DIR__."/inventoryonhand.obj.php";

class INSInventoryOnHand extends InventoryOnHand {

    public function __construct($dsn = "adohtwsol") {
        parent::__construct($dsn);
    }

    public function constructDataset($stmt) {
        $ds = parent::constructDataset($stmt);
        $tbl = new GenericMysqlTable("insorderdet");
        $tmpDS = $tbl->findWhere(array("lotsernbr"=>"%"))->fetchAll();
        $lsnList = array();
        foreach($tmpDS as $row) {
            $key = $row->lotsernbr;
            $lsnList[$key] = $row;
        }
        $resSet = array();
        foreach($ds as $row) {
            $key = $row->lotsernbr;
            $row->orddate = "";
            $row->slsperid = "";
            $row->custordnbr = "";
            if (isset($lsnList[$key])) {
                $row->orddate = $lsnList[$key]->orddate;
                $row->slsperid = $lsnList[$key]->slsperid;
                $row->custordnbr = $lsnList[$key]->custordnbr;
                //$row->orddate = $lsnList[$key]->orddate;
            }
            $resSet[] = $row;
        }
        //throw new Exception(var_export($lsnList, true));
        return $resSet;
    }

    public function findOpen() {
        $stmt = $this->findWhere(array("qtyonhand!"=>"0", "whseloc"=>"INS"));
        return $this->constructDataset($stmt);
    }

    public function findWhere($params) {
        $params = (array) $params;
        $params['whseloc'] = 'INS';
        return parent::findWhere($params);
    }
}
