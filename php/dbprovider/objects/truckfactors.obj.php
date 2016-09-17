<?php

require_once 'basetable.class.php';

class Truckfactors {
    public function findOpen() {
        throw new Exception("Too many open items");
    }

    public function findWhere($parms = "") {
        $trkTbl = new GenericMySqlTable("trkfcts");
        $stmt = $trkTbl->findWhere($parms);
        $retArray = array_map(
            function($el) {
                $newEl = new StdClass();
                $newEl->siteId = $el->siteid;
                $newEl->invtId = $el->invtid;
                $newEl->inFact = $el->infact;
                $newEl->outFact = $el->outfact;
                return $newEl;
            },
            $stmt->fetchAll()
        );
        return $retArray;
   }
}
