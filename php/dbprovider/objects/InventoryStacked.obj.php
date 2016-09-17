<?php


class InventoryStacked extends DBDoctrineBase {
    public function __construct($dsn = "dwh") {
        parent::__construct($dsn);
    }
    
    public function findOpen() {
        throw new Exception("This object does not support findOpen.  Please use findWhere");
    }
    
    protected function getWhereSql($critAr = "") {
        throw new Exception("This object is currently a black hole.  You can add to it, but never read");
        $whereString = "";
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field" => "state",
                "column" => "f.state",
                "op" => "LIKE"
                ),
                array(
                "field" => "siteid",
                "column" => "f.siteid",
                "op" => "LIKE"
                ),
                array(
                "field" => "city",
                "column" => "f.city",
                "op" => "LIKE"
                )
            )
        );
        $whereString = SqlBuilder::buildSql($critAr, $map);
        $whereString = " where $whereString ";
        $sql = "";
        return $sql;
    }
    
    public function insert($insValues) {
        // Create an new instance and persist it
        $stackerTrans = new Dwh\StackedHdr();
        // $stackerTrans->id = 0;
        $stackerTrans->stackerId = $insValues->stackerId;
        $stackerTrans->shift = $insValues->shift;
        $stackerTrans->operator = $insValues->operator;
        $stackerTrans->tranDate = date("Y-m-d", strtotime($insValues->tranDate));
        // @TODO -- SITEID
        $stackerTrans->direction = "onsticks";
        $this->eMgr->persist($stackerTrans);
        $this->eMgr->flush();
        $detail = array();
        foreach($insValues->detail as $insDetail) {
            $stkDetRec = new Dwh\StackedDet();
            $stkDetRec->id = 0;
            $stkDetRec->hdrId = $stackerTrans->id;
            $stkDetRec->invtId = $insDetail->invtId;
            $stkDetRec->pieces = $insDetail->pieces;
            $stkDetRec->layers = $insDetail->layers;
            $this->eMgr->persist($stkDetRec);
            $this->eMgr->flush();
            $detail[] = json_decode($stkDetRec->toJSON());
        }
        $tmpObj = json_decode($stackerTrans->toJSON());
        
        $tmpObj->detail = $detail;
        
        return $tmpObj;
    }
            
}
