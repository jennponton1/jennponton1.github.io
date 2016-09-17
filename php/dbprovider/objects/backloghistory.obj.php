<?php

require_once "basetable.class.php";

class BacklogHistory {
    public function findOpen() {
        // find the last whse week
        $dow = date("w");
        $wkstart = date("Y-m-d", strtotime($dow." days ago"));
        return $this->findWhere(array("whsedate"=>$wkstart));
    }

    public function findWhere($params) {
        $blHistory = new GenericMySqlTable("hist_sobl");
        $res = $blHistory->findWhere($params);
        return $res->fetchAll();
    }
}
