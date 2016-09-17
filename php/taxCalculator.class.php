<?php

require_once "dbprovider/dbprovider.inc.php";

class TaxCalculator {
    protected static $dbP = null;
    protected static $taxCache = null;

    protected static function loadTaxClasses() {
        if (self::$taxCache != null) {
            return;
        }
        self::setDBProvider();
        $taxTbl = self::$dbP->findOpen("salestaxclass");
        foreach($taxTbl->data as $row) {
            if ($row->taxid == null) {
                continue;
            }
            self::$taxCache[$row->taxid] = $row;
        }
    }

    protected static function setDBProvider() {
        if (self::$dbP == null) {
            self::$dbP = new dbProvider();
        }
    }

    protected static function getOrderSTax($order) {
        self::setDBProvider();
        $ordSTaxList = self::$dbP->findWhere(
            "salesordertax",
            array(
                "refnbr"=>$order->ordnbr,
                "taxtype"=>"O",
            )
        );
        $indexedList= array();
        if (count($ordSTaxList->data) < 1) {
            return 0;
        }
        foreach($ordSTaxList->data[0]->detail as $row) {
            $indexedList[$row->lineid] = $row;
        }
        return $indexedList;
    }

    protected static function calculateOrderTaxDetails($orderData) {
        $taxAr = array();
        $indexedList = self::getOrderSTax($orderData);
        // Load the taxcache
        self::loadTaxClasses();
        foreach($orderData->detail as $dtlRow) {
            if ($dtlRow->taxflag != 'T') {
                continue;
            }
            // Find this row's lineid in the indexed list
            if (!isset($indexedList[$dtlRow->lineid])) {
                throw new Exception("Failure to match up detail row and sales tax record");
            }
            $stRec = $indexedList[$dtlRow->lineid];
            // Get my tax classes
            for ($cntr = 1; $cntr <= 4; $cntr++) {
                $fldName = "tax".$cntr;
                if ($stRec->$fldName != null) {
                    $taxObj =  array(
                        "class"=>$stRec->$fldName,
                        "descr"=>self::$taxCache[$stRec->$fldName]->descr,
                        "taxrate"=>self::$taxCache[$stRec->$fldName]->taxrate,
                        "taxbase"=>$dtlRow->extpriceinvc,
                    );
                    $taxObj['taxamt'] = round($taxObj['taxbase'] * $taxObj['taxrate'], 0)/100;
                    $taxAr[] =$taxObj;
                }
            }
        }
        return $taxAr;
    }

    public static function calculateTaxFromOrder($orderData) {
        self::setDBProvider();
        $taxAr = self::calculateOrderTaxDetails($orderData);
        // We've built a detail record; Build an aggregate
        $aggAr = array();
        $totalTax = 0;
        foreach($taxAr as $lineAr) {
            $taxClass = $lineAr['class'];
            if (!isset($aggAr[$taxClass])) {
                $aggObj = array(
                    "class"=>$taxClass,
                    "descr"=>$lineAr['descr'],
                    "taxbase"=>0,
                    "taxrate"=>$lineAr['taxrate'],
                    "taxamt"=>0,
                );
                $aggAr[$taxClass] = $aggObj;
            }
            $aggAr[$taxClass]['taxbase'] += $lineAr['taxbase'];
            $aggAr[$taxClass]['taxamt'] += $lineAr['taxamt'];
            $totalBase += $lineAr['taxbase'];
            $totalTax += $lineAr['taxamt'];
        }
        $aggAr['Total'] = array(
            "class"=>"Total",
            "descr"=>"Total Tax",
            "taxbase"=>$totalBase,
            "taxamt"=>$totalTax,
        );
        return $aggAr;
    }
}
