<?php

require_once "basetable.class.php";

class ExportCustomer {
    public function findOpen() {
        $table = new GenericPVSWTable("customer");
        $res = $table->directQuery("Select * From customer where user3 between 2 and 9");
        $resDS = $res->fetchAll();
        return $resDS;
    }

    public function findWhere() {
        return $this->findOpen();
    }
}
