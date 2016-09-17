<?php

require_once "basetable.class.php";

class AcctPeriods {

    public function findOpen() {
        return $this->findWhere(array("date"=>date("Y-m-d")));
    }

    public function findWhere($parms) {
        if (!isset($parms['date'])) {
            throw new Exception("you must pass a date to this object!");
        }
        $tbl = new GenericMySqlTable("acctperiods");
        $dateStr = date("Y-m-d", strtotime($parms['date']));
        $sql = " select * from acctperiods
                 where perend >= '$dateStr' having pernbr = min(pernbr)
                 ";
        $stmt = $tbl->directQuery($sql);
        $retArray = $stmt->fetchAll();
        if (count($retArray) == 0) {
            throw new Exception("Period not found!");
        }
        return $retArray;
    }
}
