<?php

class SalesordersNew extends DBDoctrineBase {

    protected $baseSql;

    public function __construct() {
        parent::__construct();
        $this->baseSql = "select nsh from Dwh\\Salesorderheader nsh ";
    }

    public function getWhereSql($critAr = "") {
        $map = SqlBuilder::createMap();
        if (isset($critAr['invcnbr'])) {
            unset($critAr['invcnbr']);
        }
        SqlBuilder::addMapItem(
            $map,
            array(
            array(
                "field" => "ordnbr",
                "column" => "nsh.ordnbr"
            ),
            array(
                "field" => "custid",
                "column" => "nsh.custid"
            ),
            array(
                "field" => "openso",
                "column" => "nsh.openso"
            ),
            array(
                "field" => "orddate",
                "column" => "nsh.orddate",
                "op" => "GE"
            ),
            array(
                "field" => "perclosed",
                "column" => "nsh.perclosed",
            ),
            array(
                "field" => "sitetype",
                "column" => "nsh.slstype",
                "op" => "GE"
            ),
            array(
                "field" => "startdate",
                "column" => "nsh.orddate",
                "op" => "GE"
            ),

                )
        );
        $where = SqlBuilder::buildSql($critAr, $map);
        $sql = $this->baseSql . " where $where";
        return $sql;
    }

    public function update($params) {
        // check to see if the item is there yet
        $params = (array) $params;
        $ordTable = $this->eMgr->getRepository("Dwh\\Salesorderheader");
        $ord = $ordTable->findBy(array("ordnbr"=>$params['ordnbr']));
        if (count($ord) == 0) {
            return $this->insert((object) $params);
        }
        else {
            $order = $ord[0];
            // Update it
            //$ordnbr = $params['ordnbr'];
            //$bocntr= $params['bocntr'];
            //$ordtype = $params['ordtype'];
            unset($params['ordnbr']);
            unset($params['ordtype']);
            unset($params['bocntr']);
            // Unused fields from legacy system
            unset($params['status']);
            unset($params['linecntr']);
            unset($params['sitetype']);
            // eventually need to handle this
            unset($params['detail']);
            foreach($params as $ndx => $value) {
                $order->$ndx = $value;
            }
            $this->eMgr->flush();
            $retItem = json_decode($order->toJSON());
            return array($retItem);
        }
    }

    public function findOpen() {
        $sql = $this->baseSql . " where nsh.openso='Y' ";
        $dataSet = $this->eMgr->createQuery($sql)->getArrayResult();
        return $dataSet;
    }

    private function setIfNull($obj, $field, $defVal = "") {
        if (!is_object($obj) || !isset($obj->$field) || ($obj->$field === null)) {
            $val = $defVal;
        }
        else {
            $val = $obj->$field;
        }
        return $val;
    }

    public function insert($obj) {
        $insert = new Dwh\Salesorderheader();
        $insert->id = 0;
        $insert->openso = 'Y';
        $insert->lastrevisiondate = date("Y-m-d H:i:s");
        $insert->version = 1;
        $insert->ordnbr = $obj->ordnbr;
        $insert->custid = $obj->custid;
        $insert->orddate = $obj->orddate;
        $insert->shipdate = $obj->shipdate;
        $insert->siteid = $obj->siteid;
        $insert->slstype = $obj->slstype;
        $insert->slsperid = $obj->slsperid;
        $insert->terms = $obj->terms;
        $insert->fob = $obj->fob;
        $insert->shipvia = $obj->shipvia;
        $insert->custordnbr = $obj->custordnbr;

        $insert->shipaddressid = $obj->shipaddressid;
        $insert->shipfirstname = $obj->shipfirstname;
        $insert->shiplastname = $obj->shiplastname;
        $insert->shipaddr1 = $obj->shipaddr1;
        $insert->shipaddr2 = $obj->shipaddr2;
        $insert->shipcity = $obj->shipcity;
        $insert->shipstate = $obj->shipstate;
        $insert->shipzip = $obj->shipzip;

        $insert->export = $this->setIfNull($obj, export, "N");
        $insert->emaillist = $this->setIfNull($obj, "emaillist");
        $insert->notes = $this->setIfNull($obj, "notes");
        $insert->ordtot = $this->setIfNull($obj, "ordtot", 0);
        $this->eMgr->persist($insert);
        $this->eMgr->flush();
        $detailAr = array();
        // Now work on the detail items
        foreach ($obj->detail as $item) {
            $dtlInsert = new Dwh\Salesorderdetail();
            $this->eMgr->detach($dtlInsert);
            $dtlInsert->id = 0;
            $dtlInsert->version = 1;
            $dtlInsert->lastrevisiondate = date('Y-m-d H:i:s');

            $dtlInsert->order_id = $insert->id;
            $dtlInsert->ordnbr = $obj->ordnbr;
            $dtlInsert->siteid = $insert->siteid;
            $dtlInsert->whseloc = $insert->slstype;
            $dtlInsert->custid = $insert->custid;
            $dtlInsert->cnvfact = $item->cnvfact;
            $dtlInsert->unitdescr = "";
            if (isset($item->unitdesc)) {
                $dtlInsert->unitdescr = $item->unitdesc;
            }
            elseif (isset($item->unitdescr)) {
                $dtlInsert->unitdescr = $item->unitdescr;

            }

            $dtlInsert->ordqty = $this->setIfNull($item, "ordqty", 0);
            $dtlInsert->shipqty = 0;
            $dtlInsert->balqty = $dtlInsert->ordqty;
            $dtlInsert->linenbr = $item->linenbr;

            $dtlInsert->invtid = $item->invtid;
            $dtlInsert->slsprice = $item->slsprice;
            $dtlInsert->wood = $this->setIfNull($item, 'wood', 0);
            $dtlInsert->treat = $this->setIfNull($item, 'treat', 0);
            $dtlInsert->freight = $this->setIfNull($item, 'freight', 0);
            $dtlInsert->misc = $this->setIfNull($item, 'misc', 0);
            $dtlInsert->trtadj = $this->setIfNull($item, 'trtadj', 0);
            $dtlInsert->lotsernbr = $insert->slstype == "STK" ? '00' : $insert->custid;
            $dtlInsert->othadj = $this->setIfNull($item, 'othadj', 0);
            $dtlInsert->descr = $item->descr;

            $this->eMgr->persist($dtlInsert);
            $this->eMgr->flush();
            $detailAr[] = $dtlInsert;
        }
        return $insert;
    }

    public function delete($criteria = "") {
        // get the objects to be removed
        $sql = $this->getWhereSql($criteria);
        $items = $this->eMgr->createQuery($sql)->getResult();
        foreach ($items as $item) {
            if (is_array($item)) {
                $id = $item['id'];
            }
            else {
                $id = $item->id;
            }
            $hdrTable = $this->eMgr->getRepository("Dwh\\salesorderheader");
            $newObj = $hdrTable->find($id);
            $this->eMgr->remove($newObj);
            $this->eMgr->flush();
            $dtlTable = $this->eMgr->getRepository("Dwh\\salesorderdetail");
            $details = $dtlTable->findBy(array("order_id"=>$id));
            foreach($details as $item) {
                $this->eMgr->remove($item);
                $this->eMgr->flush();
            }
        }
    }
}
