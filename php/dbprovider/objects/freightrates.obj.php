<?php

require_once 'basetable.class.php';

class Freightrates {
    public function findOpen() {
        return $this->findWhere(array("city"=>"%"));
    }

    public function findWhere($params) {
        $frTable = new GenericMySqlTable("freightrates");
        $stmt = $frTable->findWhere($params);
        return $stmt->fetchAll();
    }
}
