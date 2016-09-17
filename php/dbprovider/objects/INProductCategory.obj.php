<?php


require_once "basetable.class.php";

class INProductCategory {
    protected $fieldMap = array(
        "prodCat",
        "chemCat",
        "chemCatSub",
        "cat1",
        "cat2",
        "packaging",
        "retention",
        "handling",
        "labor",
        "drying",
    );
    public function __construct() {
        $this->htinprod= new GenericMySqlTable("htinprod");
    }

    public function findOpen() {
        return $this->findWhere(array("prodcat"=>"%"));
    }

    public function findWhere($parms) {
        $ds = $this->htinprod->findWhere($parms);
        $dataset = array();
        foreach($ds as $row) {
            $item = new stdClass();
            foreach ($this->fieldMap as $field) {
                $dbName = strtolower($field);
                $item->$field = $row->$dbName;
            }
            $dataset[] = $item;
        }
        return $dataset;
    }

}
