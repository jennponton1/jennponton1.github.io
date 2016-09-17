<?php


class VmiItemHistory extends DBDoctrineBase {
    public function __construct() {
        $this->baseSql  = "Select vih from Dwh\\HistLocation vih where vih.whseloc like 'VM%' ";
        parent::__construct();
    }
    
    public function findOpen() {
        // Assume the last history date
        $sqlDate = date("Y-m-d", strtotime("-7 days"));
        $sql = $this->baseSql." and vih.whsedate >= '$sqlDate' ";
        $location = $this->eMgr->createQuery($sql)->getArrayResult();
        return $location;
    }
    
    public function getWhereSql($critAr = "") {
        SqlBuilder::checkNull($critAr, "Criteria");
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"invtid",
                "column"=>"vih.invtid",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"siteid",
                "column"=>"vih.siteid",
                "op"=>"EQ"
                ),
                array(
                "field"=>"whsedate",
                "column"=>"vih.whsedate",
                "op"=>"GE"
                ),
            )
        );
        $where = SqlBuilder::buildSql($critAr, $map);
        $sql = $this->baseSql." and $where";
        return $sql;
    }
}
