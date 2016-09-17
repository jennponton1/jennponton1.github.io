<?php

class Stackerunposted extends DBDoctrineBase {

    protected $baseSql;

    public function __construct($dsn = "dwh") {
        parent::__construct($dsn);
        $this->baseSql = "select su from Dwh\\Stackerunposted su ";
    }

    public function findOpen() {
        $dataSet = $this->eMgr->createQuery($this->baseSql)->getArrayResult();
        return $dataSet;
    }

    public function getWhereSql($critAr = "") {
        $map   = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                    "field"  => "stackerid",
                    "column" => "su.stackerId"
                ),
                array(
                    "field"  => "siteId",
                    "column" => "su.siteId"
                ),
                array(
                    "field"  => "invtId",
                    "column" => "su.invtId",
                    "op"     => "LIKE"
                ),
                array(
                    "field"  => "shift",
                    "column" => "su.shift",
                    "op"     => "LIKE"
                ),
            )
        );
        $where = SqlBuilder::buildSql($critAr, $map);
        $sql   = $this->baseSql . " where $where";
        return $sql;
    }

    //working on this
    public function update($updValues) {
        // get this object from the repository
        $stckSched            = $this->eMgr
            ->getRepository("Dwh\\Stackerunposted")
            ->find($updValues->id);
        $stckSched->stackerId = $updValues->stackerId;
        $stckSched->siteId    = $updValues->siteId;
        $stckSched->ordNbr    = $updValues->ordNbr;
        $stckSched->invtId    = $updValues->invtId;
        $stckSched->descr     = $updValues->descr;
        $stckSched->custId    = $updValues->custId;
        $stckSched->whseLoc   = $updValues->whseLoc;
        $stckSched->qty       = $updValues->qty;
        $stckSched->priority  = $updValues->priority;
        $stckSched->layers    = $updValues->layers;
        //        $stckSched->staged =    $updValues->staged;
        $stckSched->dtEntered = $updValues->dtEntered;
        $this->eMgr->flush();
        $stckSched            = json_decode($stckSched->toJSON());
        return $stckSched;
    }

    public function insert($obj = "") {
        $insert            = new Dwh\StackerUnposted();
        $insert->id        = 0;
        $insert->stackerId = $obj->stackerId;
        $insert->siteId    = $obj->siteId;
        $insert->ordNbr    = $obj->ordNbr;
        $insert->dtEntered = $obj->dtEntered;
        $insert->invtId    = $obj->invtId;
        $insert->descr     = $obj->descr;
        $insert->shift     = $obj->shift;
        $insert->qty       = $obj->qty;
        $insert->priority  = $obj->priority; //newly added
        $insert->layers    = $obj->layers;
        $insert->whseLoc   = $obj->whseLoc;
        //        $insert->staged = $obj->staged;
        $insert->custId    = $obj->custId;
        $insert->tosPos    = $obj->tosPos;
        $insert->notes     = $obj->notes;
        $insert->dest      = $obj->dest;
        $this->eMgr->persist($insert);
        $this->eMgr->flush();
        $retObj            = json_decode($insert->toJSON());
        return $retObj;
    }

    public function delete($criteria = "") {
        if (is_array($criteria)) {
            $id = $criteria['id'];
        }
        else {
            $id = $criteria->id;
        }
        if ($id === null) {
            throw new Exception("You must pass an ID to this method");
        }
        $entity = $this->eMgr->find("Dwh\\StackerUnposted", $id);
        if ($entity === null) {
            return null;
        }
        $this->eMgr->remove($entity);
        $this->eMgr->flush();
        return array(json_decode($entity->toJSON()));
    }

}
