<?php

require_once "basetable.class.php";

class Manuloc {

    public function __construct() {
        //parent::__construct("Quotes");
    }

    public function findOpen() {
        return $this->findWhere(array("chemcat"=>"%"));
    }

    public function findWhere($critAr = "") {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array to this function");
        }
        $tbl = new GenericMySqlTable("manuloc", "quotes");
        $stmt = $tbl->findWhere($critAr);
        $retArray = $stmt->fetchAll();
        return $retArray;
    }

}
