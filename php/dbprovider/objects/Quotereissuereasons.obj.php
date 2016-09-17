<?php

require_once "basetable.class.php";

class Quotereissuereasons {
    protected $reissuereasons;
    
    public function __construct() {
        $this->reissuereasons = new GenericMySqlTable("reqquote", "quotes");
    }
    
    public function findOpen() {
        return $this->findWhere(array());
    }
    
    public function findWhere($parms) {
        $res = $this->reissuereasons->findWhere($parms);
        $retAr = array();
        foreach($res as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }
}
