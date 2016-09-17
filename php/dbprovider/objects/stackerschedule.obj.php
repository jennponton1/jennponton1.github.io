<?php

class Stackerschedule extends dbDoctrineBase {

    public function __construct($db = "dwh") {
        parent::__construct($db);
    }

    public function findOpen() {
        $retObj = $this->eMgr->createQuery("select s from Dwh\\Stackerschedule s")->getArrayResult();
        return $retObj;
    }

    public function findWhere($critAr = '') {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array of criteria to this function");
        }
        $critStr = "";
        foreach ($critAr as $key => $val) {
            if ($critStr != "") {
                $critStr .= " and ";
            }
            $key = strtolower($key);
            switch ($key) {
                case "siteid":
                    $critStr .= " s.siteId = '$val' ";
                    break;
                case "stackerid":
                    $critStr .= " s.stackerId = '$val' ";
                    break;
                case "rel":
                    $critStr .= " s.rel = '$val' ";
                    break;
                default:
                    throw new Exception("Not yet implemented $key");
            }
        } // foreach
        if ($critStr != "") {
            $critStr = " where $critStr ";
        }
        $retObj = $this->eMgr->createQuery("select s from Dwh\\Stackerschedule s $critStr")->getArrayResult();
        return $retObj;
    }

    public function insert($insValues) {
        // Create an new instance and persist it
        $stckSched            = new Dwh\Stackerschedule();
        $stckSched->id        = 0;
        $stckSched->stackerId = $insValues->stackerId;
        $stckSched->siteId    = $insValues->siteId;
        $stckSched->ordNbr    = $insValues->ordNbr;
        $stckSched->invtId    = $insValues->invtId;
        $stckSched->descr     = $insValues->descr;
        $stckSched->custId    = $insValues->custId;
        $stckSched->whseLoc   = $insValues->whseLoc;
        $stckSched->qty       = $insValues->qty;
        $stckSched->priority  = $insValues->priority;
        $stckSched->staged    = 0;
        $stckSched->notes     = $insValues->notes;
        $stckSched->dest      = '';
        $stckSched->rel       = $insValues->rel;
        $stckSched->tosPos    = $insValues->tosPos;

        $this->insertEntity($stckSched);
        // Query for the just saved item
        $retAr = json_decode($stckSched->toJSON());
        return $retAr;
    }

    public function update($updValues) {
        // get this object from the repository
        $stckSched            = $this->eMgr
            ->getRepository("Dwh\\Stackerschedule")
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
        $stckSched->staged    = $updValues->staged;  // newly added by rarnold
        $stckSched->dest      = $updValues->dest;      // newly added by rarnold 8/9/13
        $stckSched->notes     = $updValues->notes;    // newly added by rarnold 8/9/13
        $stckSched->rel       = $updValues->rel; // newly added by rarnold 3/13/13
        $stckSched->tosPos    = $updValues->tosPos; // newly added by rarnold 8/23/13
        $this->eMgr->flush();
        $stckSched            = json_decode($stckSched->toJSON());
        return $stckSched;
    }

    public function delete($updValues) {
        // get this object from the repository
        $stckSched = $this->eMgr
            ->getRepository("Dwh\\Stackerschedule")
            ->find($updValues->id);
        $this->eMgr->remove($stckSched);
        $this->eMgr->flush();
        return $stckSched;
    }

}
