<?php

class Quotestreatcalc extends dbDoctrineBase {

    public function __construct() {
        parent::__construct("quotes");
        $this->genericSql = "Select tc from Quotes\\Treatcalc tc ";
    }

    public function findOpen() {
        $ret = $this->eMgr->createQuery($this->genericSql)->getArrayResult();
        return $ret;
    }
    
    public function getWhereSql($params = "") {
        SqlBuilder::checkNull($params, "Criteria ");
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"siteid",
                "column"=>"tc.siteid",
                "op"=>"EQ"
                ),
                array(
                "field"=>"prodcat",
                "column"=>"tc.prodcat",
                "op"=>"EQ"
                ),
                array(
                "field"=>"species",
                "column"=>"tc.species",
                "op"=>"EQ"
                ),
                array(
                "field"=>"dim",
                "column"=>"tc.dim",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"finish",
                "column"=>"tc.finish",
                "op"=>"LIKE"
                ),
            )
        );
        $where = SqlBuilder::buildSql($params, $map);
        $sql = $this->genericSql . " where $where";
        return $sql;
    }

}
