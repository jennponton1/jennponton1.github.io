<?php

require_once "basetable.class.php";

class AsiaCustomer {
    public function findOpen() {
        $table = new GenericMySqlTable("xpcust");
        $res = $table->multiJoin(
            "xp",
            array(
                "c"=>"cust",
            ),
            array(
                new JoinLink("IJ", "xp.custid", "c.custid")
            ),
            array()
        );
        $resDS = array();
        foreach($res as $row) {
            $obj = new StdClass();
            foreach($row as $prop=>$val) {
                $nameAr = explode("_", $prop);
                $field = $nameAr[0];
                if ($nameAr[0] !== "custid") {
                    $obj->$field = $val;
                }
                else {
                    $obj->custid = $val;
                }
            }
            $resDS[] = $obj;
        }
        return $resDS;
    }

    public function findWhere() {
        return $this->findOpen();
    }
}
