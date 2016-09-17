<?php

require_once __DIR__."/odbcconnection.class.php";


class BasePVSWTableClass extends BaseTableClass {
    protected $dsn;

    public function __construct($dsn = "adohtwsol") {
        if ($dsn === null) {
            $dsn = "adohtwsol";
        }
        parent::__construct($dsn);
        $this->dsn = $dsn;
        $this->fieldQuote = '"';
        $this->pdoDb = ODBCConnection::getConnection($dsn);
        $this->exclVars = array_keys(get_object_vars($this));
        $this->colList = null;
    }

    public function getDSN() {
        return $this->dsn;
    }

    protected function getColumns() {
        if ($this->colList !== null) {
            return;
        }
        $this->colList = array();
        $sql = 'Select * From x$file, x$field where lower(xf$name) = ? and xe$file=xf$id';
        $tmpStmt = $this->pdoDb->prepare($sql);
        $tmpStmt->execute(array($this->tableName));
        $fieldName = 'xe$name';
        $typeField = 'xe$datatype';
        foreach ($tmpStmt as $row) {
            if ($row->$typeField >= 200) {
                continue;
            }
            $this->colList[] = trim(strtolower($row->$fieldName));
        }
    }

    public function multiJoin($alias, $tables, $links, $criteria, $onlyReturnSql = false) {
        $fieldList = "";
        $tableArray = array_merge(
            array($alias => $this->tableName),
            $tables
        );
        $tableList = PVSWJoinBuilder::buildTableList($tableArray);
        $fieldList = PVSWJoinBuilder::buildFieldList($tableArray, $this->getDSN());
        $joinList = PVSWJoinBuilder::buildJoinList($links);
        $valueArray = array();
        $queryCriteria = "";
        $headerCriteria = "";
        if (isset($criteria['header'])) {
            $hdrObject = ExpressionParser::parse($criteria['header']['query'], $criteria['header']['alias']);
            $headerCriteria = $hdrObject->fieldList;
            foreach ($hdrObject->valueList as $item) {
                $valueArray[] = $item;
            }
            unset($criteria['header']);
        }
        foreach ($criteria as $item) {
            $queryCriteria = appendFieldList($item, $queryCriteria, " and ");
        }
        //$whereClause = $headerCriteria;

        $whereClause = appendFieldList($joinList, $headerCriteria, ' and ');
        if ($queryCriteria != "") {
            $whereClause = appendFieldList($queryCriteria, $whereClause, ' and ');
        }

        $sql = " select $fieldList from $tableList where $whereClause ";
        //throw new Exception($sql);
        if ($onlyReturnSql) {
            return (object) array("sql"=>$sql, "values"=>$valueArray);
        }
        try {
            $stmt = $this->pdoDb->prepare($sql);
            $stmt->execute($valueArray);
        }
        catch (Exception $e) {
            throw new Exception('Failed on join '.$e->getMessage()." <br>".$sql);
        }
        return $stmt;
    }
}

class GenericPVSWTable extends BasePVSWTableClass {

    public function __construct($tableName, $dsn = "adohtwsol") {
        $this->tableName = $tableName;
        parent::__construct($dsn);
    }
}
