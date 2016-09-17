<?php

require_once "basetable.class.php";

class Batch {
    protected $dsn;
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );
    protected $batchTable;
    protected $fields = array(
        "jrnltype",
        "ctrltot",
        'drtot',
        "crtot",
        "battype",
        "autorev",
        "nbrcycle",
        "cycle",
        "summpost",
        "descr",
        "relcntr",
        "rlsed",
    );

    public function __construct() {
        // set the default DSN
        $this->dsn = $this->dsnMap['CEN'];
        $this->batchTable = "";
    }

    protected function checkDSN($parms) {
        if ($this->batchTable == "") {
            if (!isset($parms['dsn']) || !isset($this->dsnMap[strtoupper($parms['dsn'])])) {
                $dsn = $this->dsnMap["CEN"];
            }
            else {
                $dsn = $this->dsnMap[strtoupper($parms['dsn'])];
            }
            $this->dsn = $dsn;
        }
        unset($parms['dsn']);
        return (object) array("parms"=>$parms, "dsn"=>$dsn);
    }

    protected function getBatchTable() {
        if ($this->batchTable == "") {
            $this->batchTable = new GenericPVSWTable('batch', $this->dsn);
        }
    }

    public function findWhere($parms) {
        $parms = (array) $parms;
        $tmpObj = $this->checkDSN($parms);
        $parms = $tmpObj->parms;
        $this->getBatchTable($parms);
        $resSet = $this->batchTable->findWhere($parms);
        return $this->constructDataset($resSet);
    }

    public function constructDataset($res) {
        $resArray = array();
        foreach($res as $row) {
            $resArray[] = $row;
        }
        return $resArray;
    }

    public function update($parms) {
        $tmpObj = $this->checkDSN((array) $parms);
        $parms = $tmpObj->parms;
        $this->getBatchTable($parms);
        if (!isset($parms['batnbr']) || !isset($parms['perpost'])) {
            throw new Exception("You must specify a batch number and a period to update!");
        }
        $keyArray =array(
            "batnbr"=>$parms['batnbr'],
            "perpost"=>$parms['perpost'],
            "module"=>$parms['module']
        );

        $dataSet = $this->findWhere($keyArray);
        $batRec =  (array) $dataSet[0];
        $updValues = array();
        foreach($batRec as $field => $val) {
            if (isset($parms[$field]) && $val != $parms[$field]) {
                $updValues[$field] = $parms[$field];
            }
        }
        $this->batchTable->update(
            $keyArray,
            $updValues
        );
        return $this->findWhere($keyArray);
    }

    public function insert($parms) {
        // Start a transaction
        $tmpObj = $this->checkDSN((array) $parms);
        $parms = $tmpObj->parms;
        $this->getBatchTable($parms);
        $this->batchTable->directQuery("start transaction", null);
        $setupTableName = $parms['module']."setup";
        $suStmt = $this->batchTable->directQuery("Select * From $setupTableName", null);
        $setup = $suStmt->fetch();
        $batNbr = $setup->lastbatnbr;
        if ($batNbr == "0" || $batNbr == "") {
            throw new Exception("Failed getting next batch #");
        }
        $batNbr++;
        $batStr = trim("$batNbr");
        while (strlen($batStr) < 6) {
            $batStr = "0".$batStr;
        }
        $this->batchTable->directQuery("update $setupTableName set lastbatnbr='$batStr'", null);
        $insObj = new StdClass();
        $forcedArray = array(
            "batnbr",
            'module',
            'perpost',
            'perent',
            'status',
            'rlsed',
            "jrnltype",
        );
        if (!isset($parms['jrntype'])) {
            $parms['jrnltype'] = $parms['module'];
        }
        $insObj->batnbr = $batStr;
        $insObj->module = $parms['module'];
        $insObj->jrnltype = $parms['jrnltype'];
        $insObj->perpost = $setup->pernbr;
        $insObj->perent = $setup->pernbr;
        $insObj->status = "H";
        $insObj->rlsed = "N";
        foreach($forcedArray as $field) {
            unset($parms[$field]);
        }
        foreach($this->fields as $field) {
            if (isset($parms[$field])) {
                $insObj->$field = $parms[$field];
            }
        }
        $this->batchTable->insert($insObj);

        $finalResult = $this->batchTable->directQuery("commit");
        //$this->batchTable->directQuery("rollback work");
        if ($finalResult === false) {
            throw new Exception("Failed to commit the transaction");
        }
        return array($insObj);
    }

}
