<?php

require_once "basetable.class.php";

class Salesperson {
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp",
        "DIL"=>"adodillard",
    );

    protected function getDSN(&$params) {
        $dsn = $this->dsnMap['CEN'];
        if (isset($params['dsn'])) {
            $dsn = $this->dsnMap[$params['dsn']];
            if ($dsn == "") {
                throw new Exception("Unknown DSN ".$params['dsn']);
            }
            unset($params['dsn']);
        }
        return $dsn;
    }

    public function findOpen() {
        return $this->findWhere(array("slsperid"=>"%"));
    }

    public function constructDataset($stmt) {
        $res = array();
        foreach ($stmt as $item) {
            if (!isset($item->slsperid)) {
                continue;
            }
            $retObj = array();
            $retObj['slsperid'] = $item->slsperid;
            $retObj['lastname'] = $item->lastname;
            $retObj['email'] = $item->user1;
            $res[] = $retObj;
        }
        return $res;
    }

    public function findWhere($critAr = "") {
        $critAr = (array) $critAr;
        if (isset($critAr['email'])) {
            $critAr['user1'] = $critAr['email'];
            unset($critAr['email']);
        }
        $dsn = $this->getDSN($critAr);
        $slsPer = new GenericPVSWTable("salesper", $dsn);
        $stmt = $slsPer->findWhere($critAr);
        $dataset = $this->constructDataset($stmt);
        return $dataset;
    }

    public function bulkUpdate($keys, $values) {
        $tmpDsn = $keys['dsn'];
        $dsn = $this->getDSN($keys);
        $tbl = new GenericPVSWTable("salesper", $dsn);
        $tbl->update($keys, $values);
        if ($tmpDsn != "") {
            $keys['dsn'] = $tmpDsn;
        }
        return $this->findWhere($keys);
    }

}
