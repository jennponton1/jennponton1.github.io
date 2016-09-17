<?php

require_once "htwdoctrine/htwdoctrine.inc.php";

class Vmiitems extends dbDoctrineBase {
    protected $baseQuery = "
    ";
    public function __construct() {
        parent::__construct();
    }

    public function find($idval = "") {
        $query = $this->eMgr->createQuery(
            "select v, c.bndl from Dwh\\Vmilevels v, Dwh\\Htinconv c where v.invtid = '$idval'  and v.invtid=c.invtid"
        );
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
                ),
                array(
                "field" => "invtid",
                "column" => "v.invtid",
                "op" => "LIKE"
                )
            )
        );
        $critStr = SqlBuilder::buildSql($parms, $map);
        $newSql = "select v.siteid,
            v.vendid,
            v.invtid,
            v.desiredlevel,
            c.bndl
            from Dwh\\Vmilevels v, Dwh\\Htinconv c
            where $critStr and
            v.invtid=c.invtId";
        $query = $this->eMgr->createQuery($newSql);
        $list = $query->getArrayResult();
        return $list;
    }

    public function findOpen() {
        $query = $this->eMgr->createQuery(
            "select v.siteid,
            v.vendid,
            v.invtid,
            v.desiredlevel,
            c.bndl from Dwh\\Vmilevels v, Dwh\\Htinconv c
            where v.invtid=c.invtId
            order by v.siteid, v.vendid, v.invtid"
        );
        $list = $query->getArrayResult();
        return $list;
    }

    public function delete($values) {
        $item = $values->invtid;
        $siteid = $values->siteid;
        $vendid = $values->vendid;
        if ($item == "" || $siteid == "" || $vendid == "") {
            throw new Exception("You must include an itemid, a vendid and a siteid");
        }
        $el = $this->eMgr->getRepository("Dwh\\Vmilevels");
        $itemList = $el->findBy(array("invtid" => $item, "siteid" => $siteid, "vendid"=>$vendid));
        if ($itemList == null) {
            throw new Exception("Could not find vendor $item for site $siteid");
        }
        $invtid = $itemList[0];
        try {
            $this->eMgr->remove($invtid);
            $this->eMgr->flush();
            return $values;
        } catch (Exception $e) {
            $x = $e->getMessage();
            throw Exception("Delete failed with the following message: ".$x);
        }
    }

    public function insert($values) {
        $item = new Dwh\Vmilevels;
        $item->siteid = $values->siteid;
        $item->invtid = $values->invtid;
        $item->vendid = $values->vendid;
        $item->desiredlevel = $values->desiredlevel;
        $this->insertEntity($item);
        return $item;
    }

    public function update($values) {
        $values = (array) $values;
        if (!isset($values['siteid']) || !isset($values['vendid']) || !isset($values['invtid'])) {
            throw new Exception("You must include both a site and an item to be updated");
        }
        $itemTable = $this->eMgr->getRepository("Dwh\\Vmilevels");
        $item = $itemTable->findBy(
            array(
                "siteid"=>$values['siteid'],
                "vendid"=>$values['vendid'],
                "invtid"=>$values['invtid']
            )
        );
        $item[0]->desiredlevel = $values['desiredlevel'];
        //throw new Exception(var_export($item, true));
        $this->eMgr->flush();
        return $item;
    }

}
