<?php

require_once "basetable.class.php";

class MSAreas {
    public function __construct() {

    }

    public function findWhere() {
        throw new Exception("This object does not support criteria");
    }

    public function findOpen() {
        $tbl = new GenericMySqlTable("stock_dist");
        $stmt = $tbl->findWhere(array("area"=>"%"));
        $det = array();
        foreach($stmt as $row) {
            if (!in_array($row->area, $det)) {
                $det[] = $row->area;
            }
        }
        sort($det);
        $retAr = array();
        foreach($det as $area) {
            $retAr[] = (object) array("area"=>$area);
        }
        return $retAr;
    }
}
