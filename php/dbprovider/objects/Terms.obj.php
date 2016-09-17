<?php

require_once "basetable.class.php";

class Terms {
    
    protected $fieldList = array(
        "termsid",
        "descr",
        "discintrv",
        "discpct",
        "disctype",
        "dueintrv",
        "duetype"
    );
    protected $termTbl;

    public function __construct() {
        $this->termTbl = new GenericPVSWTable("terms");

    }
    
    protected function runQuery($params) {
        $stmt = $this->termTbl->findWhere($params);
        $dataset = array();
        foreach($stmt as $row) {
            $item = new StdClass();
            foreach($this->fieldList as $field) {
                $item->$field = $row->$field;
            }
            $dataset[] = $item;
        }
        return $dataset;
    }
    
    public function findOpen() {
        return $this->runQuery();
    }

    public function findWhere($params) {
        if (!is_array($params)) {
            throw new Exception("You must include an array as the parameter of this function (find_where)");
        }
        return $this->runQuery($params);
    }
}
