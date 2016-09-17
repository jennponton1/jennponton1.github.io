<?php

require_once "basetable.class.php";

class Manuloc_old extends dbDoctrineBase {

    public function __construct() {
        parent::__construct("Quotes");
    }

    public function findOpen() {
        $query = $this->eMgr->createQuery("select ml from Quotes\\Manuloc ml")
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
                case "chemcat":
                    $whereString .= " ml.chemcat = '$val' ";
                    break;
                case "siteid":
                    $whereString .= " ml.siteid = '$val' ";
                    break;
                default:
                    throw new Exception("Not implemented");
            }
        }
        if ($whereString != "") {
            $whereString = " where $whereString ";
        }
        $sql = "select ml from Quotes\Manuloc ml $whereString ";
        $query = $this->eMgr->createQuery($sql);
        $results = $query->getArrayResult();
        return $results;
    }

}
