<?php

class Intranetmenucategories extends dbDoctrineBase {
    public function __construct($db = "intranet") {
        parent::__construct($db);
    }
    
    public function findOpen() {
        var_dump("hello");
        return $this->eMgr->createQuery("select c from Intranet\\menucategories c order by c.categorysort")
                         ->getArrayResult();
    }
}
