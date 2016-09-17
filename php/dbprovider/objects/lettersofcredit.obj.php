<?php

require_once "basetable.class.php";

class LettersofCredit {
    public function findOpen() {
        return $this->findWhere(array("lcnbr"=>"%"));
    }

    public function findWhere($parms) {
        $tbl = new GenericPVSWTable("htlctbl");
        $res = $tbl->findWhere($parms);
        $retArray = array();
        foreach($res as $row) {
            $retArray[] = $row;
        }
        return $retArray;
    }
}
