<?php

require_once 'basetable.class.php';

class HistVMILevels {
    public function __construct() {
        //parent::__construct();
        $this->baseSql = "select hvl from Dwh\\Hist_vmilevels hvl ";
    }

    public function findOpen() {
        return $this->findWhere(array("siteid"=>"%"));
    }

    public function findWhere($params) {
        $vmiHist = new GenericMySqlTable("hist_vmilevels");
        $stmt = $vmiHist->findWhere($params);
        return $stmt->fetchAll();
    }
}
