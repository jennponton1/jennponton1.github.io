<?php

require_once "basetable.class.php";

class DeletedInventory {
    protected $invTable;

    public function __construct() {
        $this->invTable = new GenericMySqlTable("invntory", "deleted");
    }

    public function findOpen() {
        return $this->findWhere(array("invtid"=>"%"));
    }

    public function findWhere($crit) {
        $crit = (array) $crit;
        $res = $this->invTable->findWhere($crit);
        $retAr = array();
        foreach($res as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }

    public function insert($obj) {
        $obj = (array) $obj;
        //$orig = (array) clone((object) $obj);
        $map = array(
            "wdtype"=>"",
            "classid"=>"classid",
            "invtid"=>"invtid",
            "stkitem"=>"stkitem",
            "descr"=>"descr",
            "woodid"=>"user1",
            "trtid"=>"user2",
            "bf"=>"CONV",
            "sf"=>"CONV",
            "bndl"=>"CONV",
            "cuft"=>"CONV",
            "ea"=>"CONV",
            "chemcat"=>"",
            "chemcatsub"=>""

        );
        $invObj = array();
        $convObj = array();
        foreach($map as $field => $column) {
            if ($column != "") {
                if ($column == "CONV") {
                    $convObj[$field] = $obj[$field];
                }
                else {
                    $invObj[$column] = $obj[$field];
                }
            }
            unset($obj[$field]);
        }
        $this->invTable->insert($invObj);
        $convObj['invtid'] = $invObj['invtid'];
        $convTable = new GenericMySqlTable("htinconv", "deleted");
        $convTable->insert($convObj);
    }
}
