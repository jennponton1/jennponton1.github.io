<?php

require_once "basetable.class.php";

class HistoricalStatusDetail {
    public function findOpen() {
        $dow= date("w");
        $lastDate = Date("Y-m-d", strtotime("$dow days ago"));
        return $this->findWhere(array("whsedate"=>$lastDate));
    }

    public function findWhere($params) {
        $criteria = (array) $params;
        $histTable = new GenericMySqlTable("hist_statdetail");
        $ds = $histTable->findWhere($criteria);
        return $ds->fetchAll();
    }
}
