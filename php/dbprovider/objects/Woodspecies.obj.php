<?php

require_once "basetable.class.php";

class Woodspecies {

    public function findOpen() {
        $sql = "select distinct wl.species from Woodlookup wl
                where wl.species not in ('','all') order by wl.species";
        $woodLU = new GenericMySqlTable("woodlookup");
        $stmt = $woodLU->directQuery($sql);
        return $stmt->fetchAll();
    }

    public function findWhere() {
        return $this->findOpen();
    }

}
