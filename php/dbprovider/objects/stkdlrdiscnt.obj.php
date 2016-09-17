<?php

class Stkdlrdiscnt extends dbDoctrineBase {

    public function __construct() {
        parent::__construct("Quotes");
    }

    public function findOpen() {
        $query = $this->eMgr->createQuery("select sd from Quotes\\Sddiscnt sd")
                ->getArrayResult();
        return $query;
    }

    public function findWhere($critAr = "") {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array to this function");
        }
        $whereString = "";
        foreach ($critAr as $key => $val) {
            if ($whereString != "") {
                $whereString .= " and ";
            }
            switch ($key) {
                case "custid":
                    $whereString .= " sd.custid = '$val' ";
                    break;
                case "siteid":
                case "site":
                    $whereString .= " sd.site = '$val' ";
                    break;
                default:
                    throw new Exception("Not implemented");
            }
        }
        if ($whereString != "") {
            $whereString = " where $whereString ";
        }
        $sql = "select sd from Quotes\Sddiscnt sd $whereString ";
        $query = $this->eMgr->createQuery($sql);
        $results = $query->getArrayResult();
        return $results;
    }

}
