<?php

class StkGenNotes extends dbDoctrineBase {

    public function __construct($db = "dwh") {
        parent::__construct($db);
    }

    public function findOpen() {
        $retObj = $this->eMgr->createQuery("select s from Dwh\\StkGenNotes s")->getArrayResult();
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
                default:
                    throw new Exception("Not yet implemented $key");
            }
        } // foreach
        if ($critStr != "") {
            $critStr = " where $critStr ";
        }
        $retObj = $this->eMgr->createQuery("select s from Dwh\\StkGenNotes s $critStr")->getArrayResult();
        return $retObj;
    }

    public function insert($insValues) {
        // Create an new instance and persist it
        $stkGenNotes            = new Dwh\StkGenNotes();
        $stkGenNotes->id        = 0;
        $stkGenNotes->stackerId = $insValues->stackerId;
        $stkGenNotes->siteId    = $insValues->siteId;
        $stkGenNotes->notes     = $insValues->notes;

        $this->insertEntity($stkGenNotes);
        // Query for the just saved item
        $retAr = array(json_decode($stkGenNotes->toJSON()));
        return $retAr;
    }

    public function update($updValues) {
        // get this object from the repository
        $stkGenNotes        = $this->eMgr
            ->getRepository("Dwh\\StkGenNotes")
            ->find($updValues->id);
        $stkGenNotes->notes = $updValues->notes;
        $this->eMgr->flush();
        return $stkGenNotes;
    }

    public function delete($updValues) {
        // get this object from the repository
        $stkGenNotes = $this->eMgr
            ->getRepository("Dwh\\StkGenNotes")
            ->find($updValues->id);
        $this->eMgr->remove($stkGenNotes);
        $this->eMgr->flush();
        return $stkGenNotes;
    }

}
