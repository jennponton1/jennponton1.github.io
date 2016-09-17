<?php

require_once "odbcentitiesv2.inc.php";
require_once "basetable.class.php";

class Stockitemprices {
    protected $wdCache;
    protected $wdLUTable;
    protected $colMap = array(
        "price_w"=>"wprice",
        "price_t"=>"tprice",
    );
    public function __construct() {
        $this->wdCache = array();
        $this->wdLUTable = null;

    }

    protected function getWoodId($woodid = null) {
        if ($woodid == null) {
            throw new Exception("You must call this method with a woodid");
        }
        if (isset($this->wdCache[$woodid])) {
            return $this->wdCache[$woodid];
        }
        if ($this->wdLUTable == null) {
            $this->wdLUTable = new GenericMySqlTable("woodlookup");
        }
        $res = $this->wdLUTable->findWhere(array("woodid"=>$woodid));
        $ds = array();
        foreach($res as $row) {
            $ds[] = $row;
        }
        if (count($ds) < 1) {
            return false;
        }
        $this->wdCache[$woodid] = $ds[0];
        return $ds[0];
    }


    public function getWhereSql($critAr = "") {
        SqlBuilder::checkNull($critAr, "Find criteria");
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field" => "invtid",
                "column" => "invtid",
                "op" => "LIKE"
                ),
                array(
                "field" => "siteid",
                "column" => "siteid",
                "op" => "LIKE"
                ),
                array(
                'field' => 'trtid',
                'column' => "t.trtid",
                "op" => "LIKE"
                ),
                array(
                'field' => 'trt',
                'column' => " substring(i.invtid,2,3) ",
                "op" => "LIKE%"
                ),

            )
        );
        $whereString = SqlBuilder::buildSql($critAr, $map);
        $sql = $whereString; //str_replace("/**/", $whereString, $this->genericSql);
        return $sql;
    }

    public function findOpen() {
        return $this->findWhere(array("siteid"=>"%"));
    }

    protected function buildDataRow($dataRow) {
        $row = (array) $dataRow;
        $obj = new StdClass();
        foreach($row as $fld => $value) {
            $fldName = $fld;
            if (isset($this->colMap[$fld])) {
                $fldName = $this->colMap[$fld];
            }
            else {
                // string alias
                $fldName = strstr($fld, "_", true);
            }
            $obj->$fldName = $value;
        }
        return $obj;
    }

    public function findWhere($params) {
        $criteria = (array) $params;
        $stklvl = new GenericPVSWTable("htstklvl");
        $sql = $this->getWhereSql($criteria);
        $rs = $stklvl->multiJoin(
            "stk",
            array(
                new JoinTable(
                    "i",
                    "invntory",
                    array("user1","user2", "classid", "descr")
                ),
                new JoinTable(
                    "w",
                    "htwdprc",
                    array("woodid", "price")
                ),
                new JoinTable(
                    "t",
                    "httrprc",
                    array("trtid", "price")
                ),
                new JoinTable(
                    "pr",
                    "htinprod",
                    array("chemcat", "chemcatsub")
                ),
            ),
            array(
                new JoinLink("IJ", "stk.invtid", "i.invtid"),
                new JoinLink("IJ", "i.user1", "w.woodid"),
                new JoinLink("IJ", "stk.siteid", "w.siteid"),
                new JoinLink("IJ", "i.user2", "t.trtid"),
                new JoinLink("IJ", "stk.siteid", "t.siteid"),
                new JoinLink("IJ", "i.classid", "pr.prodcat"),
            ),
            array(
                "header"=>array("query"=>$sql, "alias"=>"stk")
            )
        );
        //$rs = $stklvl->findWhere($criteria);
        $ds = array();

        foreach($rs as $row) {
            $wd = $this->getWoodId($row->woodid_w);
            if ($wd === false) {
                $wd = (object) array(
                    "grade"=>"",
                    "wooddesc"=>"",
                    "species"=>"",
                    "prefix"=>"",
                    "d1d2desc"=>"",
                    "lendesc"=>""
                );
            }
            $newRow = $this->buildDataRow($row);
            $newRow->species = $wd->species;
            $newRow->d1d2desc = $wd->d1d2desc;
            $newRow->prefix = $wd->prefix;
            $newRow->lendesc = $wd->lendesc;
            $newRow->grade = $wd->grade;
            $newRow->wooddesc = $wd->wooddesc;
            $ds[] = $newRow;
        }
        return $ds;

    }

}
