<?php

require_once "basetable.class.php";

class PrintedInvoice {
    public function __construct() {
        ;
    }

    public function findOpen() {
        throw new Exception("findOpen does not work for this object");
    }

    public function findWhere($params) {
        $tbl = new GenericMySqlTable("printedinvoices");
        $cursor = $tbl->findWhere($params);
        $dataSet = array();
        foreach($cursor as $row) {
            $dataSet[] = $row;
        }
        return $dataSet;
    }

    public function insert($val) {
        $tbl = new GenericMySqlTable("printedinvoices");
        $tbl->insert($val);
        return $this->findWhere(array('refnbr'=>$val->refnbr));
    }
}
