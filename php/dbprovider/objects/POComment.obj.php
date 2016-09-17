<?php

require_once "basetable.class.php";

class POComment {

    public function __construct() {

    }

    public function find($idval = "") {
        $sql = "select c from Dwh\\POFup c where c.ponbr = '$idval' order by c.ponbr, c.cmtnbr";
        $query = $this->eMgr->createQuery($sql);
        $list = $query->getArrayResult();
        return $list;
    }

    public function findWhere($parms = "") {
        $poFupTbl = new GenericMySqlTable("pofup");
        $stmt = $poFupTbl->findWhere(
            $parms,
            "ponbr, cmtnbr"
        );
        $retArray = $stmt->fetchAll();
        return $retArray;
    }

    public function findOpen() {
        $dateStr = date("Y-m-d", strtotime("-6 months"));
        return $this->findWhere(array("origshipdt"=>array("op"=>"GE","value"=>$dateStr)));
        //$retArray = $stmt->fetchAll();
        //return $retArray;
    }

    public function insert($insValues) {
        // Create an new instance and persist it
        $insValues = (array) $insValues;
        $poFupTbl = new GenericMySqlTable("pofup");
        $dateFields = array(
            "origshipdt",
            "modshipdt",
            "commentdt",
        );
        foreach($dateFields as $field) {
            if (isset($insValues[$field])) {
                $insValues[$field] = date("Y-m-d", strtotime($insValues[$field]));
            }
        }
        $res = $poFupTbl->insert($insValues);
        return $res;
    }
}
