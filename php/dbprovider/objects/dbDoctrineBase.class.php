<?php

/**
 * Description of dbDcctrineBase
 *
 * @author randallkelley
 */
require_once "htwdoctrine/htwdoctrine.inc.php";

class DBDoctrineBase {

    public $eMgr;

    public function __construct($dsn = "dwh") {
        $this->eMgr = setupORM($dsn);
    }

    public function __destruct() {

    }

    protected function runQuery($stmt = null, $parms = null) {
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

    public function insertEntity($entity) {
        $this->eMgr->persist($entity);
        $this->eMgr->flush();
    }

    public function findOpen() {
        if (property_exists($this, "openSql")) {
            $sql = $this->openSql;
            $query = $this->eMgr->createQuery($sql);
            $results = $query->getResult();
            return $results;
        }
        throw new Exception("You must implement this at the class level");
    }

    public function findWhere($critAr = "") {
        // Check for a getWhereSql method
        if (method_exists($this, "getWhereSql")) {
            $sql = $this->getWhereSql($critAr);
            $query = $this->eMgr->createQuery($sql);
            $results = $query->getArrayResult();
            return $results;
        }
        throw new Exception("You must implement this at the class level");
    }

    public function constructDataset() {
        throw new Exception("You must implement this at the class level");
    }

}
