<?php

class FSCAuditSummary extends DBDoctrineBase {

    public function __construct($dsn = "dwh") {
        parent::__construct($dsn);
        $this->genericSql = "
            select
                siteid,
                concat(substring(h.invtid,1,1),substring(h.invtid,5,99)) as woodid,
                trantype,
                sum((if(drcr='C',-1,1))*qty*cnvFact) as pcs
            From inventoryhistory h, invent i
            where perpost between ? and ? and
                h.invtid like '____F%' and
                whseloc not like 'TS%' and
                whseloc not like 'VM%' and
                whseloc not like 'INS%'and
                h.invtid=i.invtid and
                i.descr like '%FSC%' 
                
            group by
                siteid,
                concat(substring(invtid,1,1),substring(invtid,5,99)),
                trantype
            having sum((if(drcr='C',-1,1))*qty*cnvFact)  <> 0";
        $rsm = new Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult("siteid", "siteid");
        $rsm->addScalarResult("woodid", "woodid");
        $rsm->addScalarResult("trantype", "trantype");
        $rsm->addScalarResult("pcs", "pcs");
        $this->query = $this->eMgr->createNativeQuery($this->genericSql, $rsm);
        
    }

    public function findOpen() {
        throw new Exception("This object does not implement findOpen");
    }

    public function findWhere($criteria = "") {
        if (!isset($criteria['beginning']) || !isset($criteria['ending'])) {
            throw new Exception("You must include a beginning and ending period for this object");
        }
        $this->query->setParameter(1, $criteria["beginning"]);
        $this->query->setParameter(2, $criteria["ending"]);
        $results = $this->query->getResult();
        return $results;
        
    }

}
