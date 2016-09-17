<?php

require_once "basetable.class.php";

class Frtcities {

    public function findOpen() {
        return $this->findWhere(array("siteid"=>"%"));
    }

    public function findWhere($crit) {
        $frtTbl = new GenericMySqlTable("freightrates");
        $where = $frtTbl->buildWhere(array_keys($crit), array_values($crit), false);
        $stmt = $frtTbl->directQuery(
            "select distinct city, state from freightrates
             where $where order by city"
        );
        return $stmt->fetchAll();
    }
}
