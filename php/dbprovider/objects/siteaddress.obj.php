<?php

require_once "basetable.class.php";

class Siteaddress {
    protected $siteaddress;
    public function __construct() {
        $this->siteaddress = new GenericMySqlTable("siteaddress");
    }
    public function findOpen() {
        return $this->findWhere(array("siteid"=>"%"));
    }
    public function findWhere($parms) {
        $ds = $this->siteaddress->findWhere($parms);
        $dataset = array();
        foreach($ds as $row) {
            $dataset[] = $row;
        }
        return $dataset;
        
    }
}
