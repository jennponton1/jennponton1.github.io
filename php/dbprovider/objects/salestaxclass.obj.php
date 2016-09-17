<?php

require_once "basetable.class.php";

class SalesTaxClass {
    public function findOpen() {
        return $this->findWhere(array("taxid"=>"%"));
    }

    public function findWhere($parms) {
        $staxTable = new GenericPVSWTable("stax");
        $res = array();
        foreach($staxTable->findWhere($parms) as $row) {
            $res[] = $row;
        }
        return $res;
    }
}