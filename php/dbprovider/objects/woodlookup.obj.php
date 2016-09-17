<?php

require_once 'basetable.class.php';

class Woodlookup {

    public function findOpen() {
        throw new Exception("Too many items for findOpen!!");
    }

    public function findWhere($parms = "") {
        $wlTable = new GenericMySqlTable("woodlookup");
        $stmt = $wlTable->findWhere($parms);
        return $stmt->fetchAll();
    }
}
