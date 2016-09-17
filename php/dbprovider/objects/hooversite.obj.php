<?php

class Hooversite extends dbDoctrineBase {

    public function __construct() {
        parent::__construct("dwh");
        $this->genericSql = "select s from Dwh\\SiteAddress s";
    }

    public function findOpen() {
        $ret = $this->eMgr->createQuery($this->genericSql)->getArrayResult();
        return $ret;
    }

    public function findWhere($parms = "") {
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
            "field" => "siteid",
            "column" => "s.siteId",
            "op" => "LIKE"
                )
        );
        $where = SqlBuilder::buildSql($parms, $map);
        $critStr = "where $where";
        $sql = $this->genericSql . " $critStr ";
        $ret = $this->eMgr->createQuery($sql)->getArrayResult();
        return $ret;
    }

}
