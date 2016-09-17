<?php

require_once "basetable.class.php";

class QuoteSetup {
    public function findOpen() {
        $tbl = new GenericMySqlTable("qtsetup", "Quotes");
        $res = $tbl->findWhere(array("setupid"=>"%"));
        $data = array();
        foreach($res as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function findWhere() {
        return $this->findOpen();
    }

}
