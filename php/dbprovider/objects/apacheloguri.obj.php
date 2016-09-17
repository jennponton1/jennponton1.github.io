<?php

require_once "basetable.class.php";

class Apacheloguri {
    public function findOpen() {
        $dateStr = date("Y-m-d", strtotime("-1 year"));
        return $this->findWhere(array("reqdate"=>array("op"=>"GE", "value"=>$dateStr)));
    }

    public function findWhere($params) {
        $apLog = new GenericMySqlTable("apachelogs", "apachelogs");
        $where = $apLog->buildWhere(array_keys($params), array_values($params), false);
        $stmt = $apLog->directQuery(
            "select distinct uri from apachelogs
            where $where order by uri"
        );
        return $stmt->fetchAll();
    }
}
