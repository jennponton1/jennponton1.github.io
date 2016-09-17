<?php

require_once "basetable.class.php";

class Apachelogs {

    public function findOpen() {
        $logTable = new GenericMySqlTable("apachelogs","apachelogs");
        $earlyDate = date("Y-m-d", strtotime("-1 month"));
        $stmt = $logTable->findWhere(
            array("reqdate"=>array("op"=>"GE","value"=>$earlyDate))
        );
        return $stmt->fetchAll();
    }

    public function findWhere($params) {
        $logTable = new GenericMySqlTable("apachelogs","apachelogs");
        $stmt = $logTable->findWhere($params);
        return $stmt->fetchAll();
    }
}
