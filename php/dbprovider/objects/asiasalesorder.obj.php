<?php

require_once "basetable.class.php";
require_once "salesorder.obj.php";
require_once "customer.obj.php";

class AsiaSalesorder {
    public function __construct() {
        ;
    }
    
    protected function limitDataset($resSet) {
        //$cust = new GenericPVSWTable("customer");
        $cust = new GenericMySqlTable("xpcust");
        $expCusts = $cust->findWhere(array("custid"=>"%"));
        $expCustList = array();
        foreach($expCusts as $custRow) {
            $expCustList[$custRow->custid] = $custRow->custid;
        }
        $retAr = array();
        foreach($resSet as $ord) {
            // Is customer # an export customer?
            if (!isset($expCustList[$ord->custid])) {
                continue;
            }
            $retAr[] = $ord;
        }
        return $retAr;
    }
    
    public function findOpen() {
        $so = new SalesOrder();
        $soList = $so->findOpen();
        // Check custordnbr for an export order
        $retAr = $this->limitDataset($soList);
        return $retAr;
    }
    
    public function findWhere($crit) {
        $so = new SalesOrder();
        $soList = $so->findWhere($crit);
        // Check custordnbr for an export order
        $retAr = $this->limitDataset($soList);
        return $retAr;
    }
}
