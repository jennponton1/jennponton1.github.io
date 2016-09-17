<?php

require_once "basetable.class.php";

class APVoucher {
    protected $dsn;
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );
    protected $voucher;
    protected $aptran;
    public function __construct() {
        $this->dsn = "";
    }

    public function findOpen() {
        throw new Exception("Find Open does not currently work for this object");
    }

    protected function openTables() {
        if ($this->dsn == ""){
            throw new Exception("No DSN Has been specified");
        }
        $this->voucher = new GenericPVSWTable('apdoc', $this->dsn);
        $this->aptran = new GenericPVSWTable('aptran', $this->dsn);
    }

    protected function buildObject($data, $alias) {
        $obj = new StdClass();
        foreach($data as $field => $val) {
            $tmpAr = explode("_", $field);
            if ($tmpAr[1] == $alias) {
                $fieldName = $tmpAr[0];
                $obj->$fieldName = $val;
            }
        }
        return $obj;
    }

    public function constructDataset($stmt) {
        $dSet = array();
        foreach ($stmt as $row) {
            // build the key
            $key = $row->refnbr_v.$row->doctype_v.$row->batnbr_v.$row->perpost_v;
            if (!isset($dSet[$key])) {
                $dSet[$key] = $this->buildObject($row, "v");
                $dSet[$key]->detail = array();
            }
            $dSet[$key]->detail[] = $this->buildObject($row, "d");
        }
        ksort($dSet);

        return array_values($dSet);
    }

    protected function getDSN($parms) {
        if (!isset($parms['dsn'])) {
            throw new Exception("You must pass a DSN for this object!!");
        }
        $dsn = $this->dsnMap[strtoupper($parms['dsn'])];
        if ($dsn == null) {
            throw new Exception("Unknown DSN");
        }
        $this->dsn = $dsn;
        unset($parms['dsn']);
        return (object) array("parms"=>$parms, "dsn"=>$dsn);
    }


    public function findWhere($parms) {
        $tmpAr = $this->getDSN((array) $parms);
        $this->openTables();
        $parms = (array) $tmpAr->parms;
        $where = $this->voucher->buildWhere(array_keys($parms), array_values($parms), false);
        $stmt = $this->voucher->multiJoin(
            "v",
            array(
                'd'=>"aptran"
            ),
            array(
                new JoinLink("OJ", "v.refnbr", "d.refnbr"),
                new JoinLink("OJ", "v.doctype", "d.doctype"),
                new JoinLink("OJ", "v.perpost", "d.perpost"),
                new JoinLink("OJ", "v.batnbr", "d.batnbr"),
            ),
            array(
                "header"=>array("query"=>$where, "alias"=>"v")
            )
        );
        return $this->constructDataset($stmt);
        //$where = SqlBuilder::
    }

    public function yfindWhere($parms) {
        $stmt = $this->voucher->findWhere($parms);
        $dataset = array();
        foreach($stmt as $row) {
            $newObj = clone $row;
            $dtlStmt = $this->aptran->findWhere(array("refnbr"=>$row->refnbr, "doctype"=>$row->doctype));
            $newObj->detail = array();
            foreach($dtlStmt as $dtlRow) {
                $newObj->detail[] = $dtlRow;

            }
            $dataset[] = $newObj;
        }
        return $dataset;
    }

    public function update($updObject) {
        $tmpObj = $this->getDSN((array) $updObject);
        $this->openTables();
        $updObject = (array) $tmpObj->parms;
        $reqFields = array(
            "refnbr",
            "batnbr",
            "doctype",
            "perpost"
        );
        $ok = true;
        $updKeys = array();
        foreach($reqFields as $field) {
            if (!isset($updObject[$field])) {
                $ok = false;
                break;
            }
            $updKeys[$field] = $updObject[$field];
            unset($updObject[$field]);
        }
        if (!$ok) {
            throw new Exception("You must include a reference #, batch #, doctype and perpost to update");
        }
        $dtlArray = array();
        if (isset($updObject['detail'])) {
            $dtlArray = array_merge($updObject['detail']);
            unset($updObject['detail']);
        }
        // At this point, there should be an array of changes to the APDoc object
        // and an array of updates to detail items
        if (count($dtlArray) != 0) {
            // handle the update of the detail items
            foreach($dtlArray as $dtlItem) {
                $dtlItem = (array) $dtlItem;
                // Also have to have a key element of some sort -- preferably a line id
                if (!isset($dtlItem['lineid'])) {
                    throw new Exception("Detail item must have a lineid to be updated");
                }
                $dtlKeys = array_merge($updKeys);
                $dtlKeys['lineid'] = $dtlItem['lineid'];
                unset($dtlItem['lineid']);
                $this->aptran->update($dtlKeys, $dtlItem);

            }
        }
        if (count($updObject) != 0) {
            // handle the update to the main object
            //throw new Exception(var_export($updObject, true));
            $this->voucher->update($updKeys, $updObject);
        }
        // return the updated object
        $updKeys['dsn'] = array_search($this->dsn, $this->dsnMap);
        return $this->findWhere($updKeys);
    }

    public function bulkUpdate($keys, $updValues) {
        $tmpObj = $this->getDSN((array) $keys);
        //$keys = $tmpObj->parms;
        $this->openTables();
        $this->voucher->update($tmpObj->parms, $updValues);
        return $this->findWhere($keys);
    }

    // TODO -- insert
    public function insert($insObject) {
        throw new Exception("This won't work yet ".var_export($insObject, true));
    }
}
