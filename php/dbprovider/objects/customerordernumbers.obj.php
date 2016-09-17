<?php

require_once "basetable.class.php";

class CustomerOrderNumbers {
    public function __construct() {

    }

    public function findOpen() {
        throw new Exception("You must pass a customer id");
    }

    public function findWhere($parms) {
        $parms = (array) $parms;
        // Only real parameter is custid
        if (!isset($parms['custid']) && !isset($parms['ordnbr'])) {
            throw new Exception("This object requires a customer id or an order #");
        }
        $custid = '%';
        $ordnbr = '%';
        if (isset($parms['custid'])) {
            $custid = $parms['custid'];
        }
        if (isset($parms['ordnbr'])) {
            $ordnbr= $parms['ordnbr'];
        }

        $sql = "select distinct custid, ordnbr, ordtype, orddate from slshdr
            where ordtype not in ('BO') and custid like '$custid' and ordnbr like '$ordnbr'
            UNION
            select distinct custid, ordnbr, ordtype, orddate from soblhdr
            where ordtype not in ('BO') and custid like '$custid' and ordnbr like '$ordnbr'
            order by 4,2";
        $table = new GenericMySqlTable("slshdr");
        $stmt = $table->directQuery($sql);
        $res = $stmt->fetchAll();
        return $res;
    }
}
