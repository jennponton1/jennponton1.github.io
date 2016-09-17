<?php

class Ranking extends dbDoctrineBase {
    protected $rsm;
    protected $genericSql;
    
    public function __construct() {
        parent::__construct("Quotes");
        $this->genericSql = "select 
            q.custid, q.invtid, q.trt, q.billunits, q.linetot, i.descr 
            from quotes.Ranking q, dwh.invent i 
            where q.invtid=i.invtid 
             /**/ order by q.linetot desc";
        $this->rsm = new Doctrine\ORM\Query\ResultSetMapping();
        $this->rsm->addScalarResult("custid", "custid");
        $this->rsm->addScalarResult("invtid", "invtid");
        $this->rsm->addScalarResult("trt", "trt");
        $this->rsm->addScalarResult("billunits", "billunits");
        $this->rsm->addScalarResult("linetot", "linetot");
        $this->rsm->addScalarResult("descr", "descr");
    }

    public function findOpen() {
        //        $query = $this->eMgr->createQuery(str_replace("/**/", "", $this->genericSql))
        //                ->getArrayResult();
        $sql = str_replace("/**/", "", $this->genericSql);
        $query = $this->eMgr->createNativeQuery($sql, $this->rsm);
        return $query;
    }
    
    public function findWhere($critAr = "") {
        SqlBuilder::checkNull($critAr, "Critieria");
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"custid",
                "column"=>"q.custid",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"trt",
                "column"=>"q.trt",
                "op"=>"LIKE"
                ),
            )
        );
        $where = SqlBuilder::buildSql($critAr, $map);
        if ($where != "") {
            $where = " and $where";
        }
        $sql = str_replace("/**/", $where, $this->genericSql);
        $query = $this->eMgr->createNativeQuery($sql, $this->rsm);
        $res = $query->getResult();
        $dataset = array();
        foreach($res as $row) {
            $dataset[] = $row;
        }
        return $dataset;
    }

}
