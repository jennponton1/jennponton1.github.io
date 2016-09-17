<?php

require_once "basetable.class.php";

class Quoteclosereasons {
    protected $closereasons;
    
    public function __construct() {
        $this->closereasons = new GenericMySqlTable("closequote", "quotes");
    }
    
    public function findOpen() {
        return $this->findWhere(array());
    }
    
    public function findWhere($parms) {
        $res = $this->closereasons->findWhere($parms);
        $retAr = array();
        foreach($res as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }
}
