<?php

require_once "basetable.class.php";

class VMIHistoricReceipts {
    
    public function __construct() {
    }
    
    public function findOpen() {
        throw new Exception("Can't handle open");
    }
    
    public function findWhere($crit) {
        $crit = (array) $crit;
        $siteid = "";
        $where = "h.ordnbr = 'VMI' ";
        $values = array();
        if (isset($crit['siteid'])) {
            $siteid = $crit['siteid'];
            $values[] = $siteid;
            $where .= " and h.siteid = ? ";
        }
        if (isset($crit['whsedate'])) {
            $values[] = $crit['whsedate'];
            $where .= " and h.rcptdate >= ? ";
        }
        $tmp = new GenericMySqlTable("wkend_table");
        $sqlString = "select (select min(whsedate) from wkend_table where whsedate >= rcptdate) as whsedate,
                        invtid, siteid, sum(qty) as qtyonhand
                        From rectick h
                        where $where
                        group by siteid, invtid,  (select min(whsedate) from wkend_table where whsedate >= rcptdate) ";
        $data = $tmp->directQuery($sqlString, $values);
        $detArray = array();
        foreach($data as $row) {
            $detArray[]  = $row;
        }
        return $detArray;
    }
    
}
