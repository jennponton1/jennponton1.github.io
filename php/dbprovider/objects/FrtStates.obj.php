<?php

require_once "basetable.class.php";

class FrtStates {

    public function __construct() {
        $this->sql = "select distinct f.state from Freightrates f order by f.state";
    }

    public function findWhere($critAr = "") {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array to this function");
        }
        return $this->findOpen();
    }

    public function findOpen() {
        $tbl = new GenericMySqlTable("freightrates");
        $res = $tbl->directQuery($this->sql);
        $results = $res->fetchAll();
        return $results;
    }

}
