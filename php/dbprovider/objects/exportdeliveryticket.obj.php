<?php

require_once "basetable.class.php";

class ExportDeliveryticket {
    public function __construct() {
        ;
    }

    public function findOpen() {
        throw new Exception("findOpen does not work for this object");
    }

    public function findWhere($params) {
        $tbl = new GenericPVSWTable("htxdt");
        $cursor = $tbl->findWhere($params);
        $dataSet = array();
        foreach($cursor as $row) {
            $dataSet[] = $row;
        }
        return $dataSet;
    }
}
