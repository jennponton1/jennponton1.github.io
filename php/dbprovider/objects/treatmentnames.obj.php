<?php

require_once "basetable.class.php";

class treatmentNames {
    public function findOpen() {
        return $this->findWhere(array("trtid"=>"%"));
    }

    public function findWhere($crit) {
        $tbl = new GenericMySqlTable("treatments");
        $stmt = $tbl->findWhere($crit);
        $ds = array();
        foreach($stmt as $row) {
            $row->name = trim($row->retention." ".$row->descr." ".$row->suffix);
            $ds[] = $row;
        }
        return $ds;
    }
}
