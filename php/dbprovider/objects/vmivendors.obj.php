<?php

require_once "htwdoctrine/htwdoctrine.inc.php";

class Vmivendors extends dbDoctrineBase {

    public function __construct() {
        parent::__construct();
    }

    public function find($idval = "") {
        $query = $this->eMgr->createQuery("select v from Dwh\\Vmivendors v where v.invtid = '$idval' ");
        $list = $query->getArrayResult();
        return $list;
    }

    public function findWhere($parms = "") {
        $critStr = "";
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field" => "siteid",
                "column" => "v.siteid",
                "op" => "LIKE"
                ),
                array(
                "field" => "vendid",
                "column" => "v.vendid",
                "op" => "LIKE"
                )
            )
        );
        $critStr = SqlBuilder::buildSql($parms, $map);
        $newSql = "select v from Dwh\\Vmivendors v where $critStr";
        $query = $this->eMgr->createQuery($newSql);
        $list = $query->getArrayResult();
        return $list;
    }

    public function findOpen() {
        $query = $this->eMgr->createQuery("select v from Dwh\\Vmivendors v order by v.siteid, v.vendid");
        $list = $query->getArrayResult();
        return $list;
    }

    public function delete($values) {
        $vendid = $values->vendid;
        $siteid = $values->siteid;
        if ($vendid == "" || $siteid == "") {
            throw new Exception("You must include both a vendid and a siteid");
        }
        $el = $this->eMgr->getRepository("Dwh\\Vmivendors");
        $vendList = $el->findBy(array("vendid" => $vendid, "siteid" => $siteid));
        if ($vendList == null) {
            throw new Exception("Could not find vendor $vendid for site $siteid");
        }
        $vend = $vendList[0];
        try {
            $this->eMgr->remove($vend);
            $this->eMgr->flush();
            return $values;
        } catch (Exception $e) {
            $x = $e->getMessage();
            throw new Exception("Error during delete with following message: $x");
        }
    }

    public function insert($values) {
        $vend = new Dwh\Vmivendors;
        $vend->siteid = $values->siteid;
        $vend->wdtype = $values->wdtype;
        $vend->vendid = $values->vendid;
        $this->insertEntity($vend);
        return $vend;
    }

}
