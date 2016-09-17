<?php

require_once "basetable.class.php";

class SaleslogHistory {
    protected $baseSql;
    public function __construct() {
        // nothing really to do...
        $this->baseSql = "select * from slslogevent where /**/ 
            UNION 
            select * From slslogevent where mainid in (
            select id from slslogevent where /**/ )
            order by id";
    }
    
    public function findOpen() {
        throw new Exception("This object requires an order # ");
    }
    
    public function findWhere($parms = array()) {
        $parms = (array) $parms;
        if (!isset($parms['ordnbr'])) {
            throw new Exception("This object requires an order # ".var_export($parms, true));
        }
        $ordnbr = "%".$parms['ordnbr']."%";
        $logTbl = new GenericMySqlTable("slslogevent");
        $sql = str_replace("/**/", " itemkeys like ? ", $this->baseSql);
        $resStmt = $logTbl->directQuery($sql, array($ordnbr, $ordnbr));
        $retAr = array();
        foreach($resStmt as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }
}
