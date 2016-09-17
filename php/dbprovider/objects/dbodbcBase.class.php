<?php

/**
 * Description of dbodbcBase
 *
 * @author randallkelley
 */
require_once "odbcentitiesv2.inc.php";

class DBOdbcBase extends PDONewODBCModelClass {

    protected $object = '';

    public function __construct($dsn = "") {
        parent::__construct($dsn);
    }
    
    protected function appendField($list, $field) {
        if ($list != "") {
            $list .= ", ";
        }
        $list .= $field;
        return $list;
    }
    
    public function runQuery($stmt = null, $parms = null) {
        $idval = "";
        if ($stmt === false) {
            // There was an error -- get the error information
            $erInfo = $this->pdoDb->errorInfo();
            $erStr = var_export($erInfo, true);
            throw new Exception("There was an error with the last query!  Error info is $erStr<br>");
        }
        if ($stmt == null || $parms == null) {
            throw new Exception("You must pass both a statment and a value to the find method!");
        }
        if (is_array($parms)) {
            $res = $stmt->execute(($idval));
        }
        else {
            $res = $stmt->execute(array($idval));
        }
        if ($res === false) {
            throw Exception("The query has failed with the following errors: ".$stmt->errorInfo());
        }
        $this->currentStmt = $stmt;
        $this->currentPosition = 0;
        $this->lastFetchedRow = null;
        $this->currentStmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this->currentStmt;
    }

    public function findOpen() {
        $this->runQuery($this->openStmt, " ");
        $dataset = $this->constructDataset();
        return $dataset;
    }

    public function findWhere($critAr = "") {
        if (method_exists($this, "getWhereSql")) {
            $sql = $this->getWhereSql($critAr);
            $stmt = $this->pdoDb->prepare($sql);
            $dataSet = $this->runQuery($stmt, " ");
            $retSet = $this->constructDataset($dataSet);
            return $retSet;
        }
        throw new Exception("You must implement this at the class level");
    }

    public function constructDataset() {
        throw new Exception("You must implement this at the class level");
    }

}
