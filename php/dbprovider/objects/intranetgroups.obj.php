<?php


class Intranetgroups extends dbDoctrineBase {
    public function __construct($dsn = "intranet") {
        parent::__construct($dsn);
    }
    
    public function findOpen() {
        $list = $this->eMgr->createQuery("select g from Intranet\\Groups g order by g.groupid")
                          ->getArrayResult();
        return $list;
        
    }
}
