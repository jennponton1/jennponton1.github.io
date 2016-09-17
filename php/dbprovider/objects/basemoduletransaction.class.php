<?php

require_once "basetable.class.php";

class BaseModuleTransactionClass {
    protected $module = "";
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp",
        "DIL"=>"adodillard",
        "CONSOL"=>"adoconsol",
    );
    public function __construct($module = null) {
        if ($module === null) {
            throw new Exception("You must specify a module!");
        }
        if (!in_array($module, array("IN","AR","AP","GL"))) {
            throw new Exception("Unknown module $module!");
        }
        $this->module = $module;
    }

    public function findOpen() {
        throw new Exception("This module does not have a find open! Please use findWhere");
    }

    protected function getTable(&$params) {
        $dsn = "CEN";
        if (isset($params['dsn'])) {
            $dsn = strtoupper($params['dsn']);
        }
        if (!isset($this->dsnMap[$dsn])) {
            throw new Exception("Unknown DSN! #$dsn");
        }
        unset($params['dsn']);
        $table = new GenericPVSWTable(strtolower($this->module."tran"), $this->dsnMap[$dsn]);
        return $table;
    }

    public function findWhere($params) {
        $params = (array) $params;
        // Get the table
        $table = $this->getTable($params);
        $res = $table->findWhere($params);
        return $res->fetchAll();
    }

    public function update($params) {
        $params = (array) $params;
        // Get the table
        $table = $this->getTable($params);
        // Extract potential keys from the parameters
        $keyFields = array(
            "refnbr",
            "perpost",
            "batnbr",
        );
        $keys = array();
        foreach($keyFields as $key) {
            if (isset($params[$key])) {
                $keys[$key] = $params[$key];
                unset($params[$key]);
            }
        }
        if (count($keys) < 1) {
            throw new Exception("You must pass at least one key field (refnbr, perpost or batnbr");
        }
        $table->update($keys, $params);
        return $this->findWhere($keys);
    }

}
