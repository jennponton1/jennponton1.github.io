<?php

require_once "basetable.class.php";

class StockItems {
    protected $fieldList = array(
        "invtid"=>"stk",
        "siteid"=>"stk",
        "stklvl"=>"stk",
        "descr"=>"i",
        "classid"=>"i",
        "bf"=>"c",
        "sf"=>"c",
        "bndl"=>"c",
        "cuft"=>"c",
        "chemcat"=>"p"
    );
    protected $stklvls;
    
    public function __construct() {
        $this->stklvls = new GenericPVSWTable("htstklvl");
    }
    
    public function findOpen() {
        return $this->findWhere();
    }
    
    protected function parseParms($parms) {
        $hdrQuery = null;
        $dtlQuery = array();
        foreach($parms as $key => $val) {
            switch ($key) {
                case "siteid":
                    $hdrQuery = appendFieldList("siteid = '$val'", $hdrQuery, "and");
                    break;
                case "invtid":
                    $hdrQuery = appendFieldList("invtid = '$val'", $hdrQuery, "and");
                    break;
                
            }
        }
        $query = array("header"=>array("query"=>$hdrQuery, "alias"=>"stk"));
        $query = array_merge($query, $dtlQuery);
        return $query;
    }

    public function findWhere($parms) {
        if ($parms === null) {
            $criteria = null;
        }
        else {
            $criteria = $this->parseParms($parms);
        }
        $stmt = $this->stklvls->multiJoin(
            "stk",
            array(
                new JoinTable("i", "invntory", array("descr","classid")),
                "c"=>"htinconv",
                new JoinTable("p", "htinprod", array("prodcat","chemcat")),
            ),
            array(
                new JoinLink("OJ", "stk.invtid", "i.invtid"),
                new JoinLink("OJ", "stk.invtid", "c.invtid"),
                "OJ"=>array("i.classid"=>"p.prodcat")
            ),
            $criteria
        );
        $dataSet = array();
        foreach($stmt as $row) {
            $item = new stdClass();
            foreach($this->fieldList as $field => $alias) {
                $dsName = $field."_".$alias;
                $item->$field = $row->$dsName;
            }
            $dataSet[] = $item;
        }
        return $dataSet;
    }
}
