<?php

require_once "htwdoctrine/htwdoctrine.inc.php";

class RecTick extends dbDoctrineBase {
    protected $baseSql;
    
    public function __construct() {
        $this->baseSql = "select r from Dwh\\Rectick r ";
        parent::__construct();
    }

    public function find($idval = "") {
        $query = $this->eMgr->createQuery($this->baseSql." where r.rcptnbr='$idval' ");
        $list = $query->getArrayResult();
        return $list;
    }
    
    public function getWhereSql($parms = "") {
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"ponbr",
                "column"=>"r.ponbr"
                ),
                array(
                "field"=>"siteid",
                "column"=>"r.siteid"
                ),
                array(
                "field"=>"rcptdate",
                "column"=>"r.rcptnbr",
                "op"=>"GE"
                ),
                array(
                "field"=>"dest",
                "column"=>"r.dest"
                ),
                array(
                "field"=>"rcptnbr",
                "column"=>"r.rcptnbr",
                "op"=>"LIKE"
                ),
            )
        );
        $where = SqlBuilder::buildSql($parms, $map);
        $sql = $this->baseSql."  where $where";
        return $sql;
    }


    public function findOpen() {
        $dateStr = date("Y-m-d", strtotime("-7 days"));
        $query = $this->eMgr->createQuery($this->baseSql."  where r.rcptdate >= '$dateStr' ");
        $list = $query->getArrayResult();
        return $list;
    }

}
