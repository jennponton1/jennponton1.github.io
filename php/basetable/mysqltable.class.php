<?php

class BaseMySqlTableClass extends BaseTableClass {

    public function __construct($dsn = "dwh", $host = "127.0.0.1") {
        parent::__construct($dsn);
        $this->pdoDb = new PDO("mysql:host=$host;dbname=$dsn", "root");
        $this->pdoDb ->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $this->pdoDb ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->pdoDb ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->exclVars = array_keys(get_object_vars($this));
        $this->colList = null;
    }

    protected function getColumns() {
        if ($this->colList !== null) {
            return;
        }
        $this->colList = array();
        $sql = 'show columns from '.$this->tableName;
        $tmpStmt = $this->pdoDb->prepare($sql);
        $tmpStmt->execute(array($this->tableName));
        foreach ($tmpStmt as $row) {
            $this->colList[] = trim(strtolower($row->field));
        }
    }

    public function getLastInsertID() {
        return $this->pdoDb->lastInsertId();
    }

    public function multiJoin($alias, $tables, $links, $criteria) {
        $fieldList = "";
        $tableArray = array_merge(
            array($alias => $this->tableName),
            $tables
        );
        $tableList = MySQLJoinBuilder::buildTableList($tableArray);
        $fieldList = MySQLJoinBuilder::buildFieldList($tableArray);
        $joinList = MySQLJoinBuilder::buildJoinList($links);
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
        $whereClause = $headerCriteria;

        $whereClause = appendFieldList($joinList, $whereClause, ' and ');
        if ($queryCriteria != "") {
            $whereClause = appendFieldList($queryCriteria, $whereClause, ' and ');
        }

        $sql = " select $fieldList from $tableList where $whereClause ";
        //throw new Exception("Yarkfing<br> $sql ".var_export($valueArray, true));
        $stmt = $this->pdoDb->prepare($sql);
        $stmt->execute($valueArray);
        return $stmt;
    }
}

class GenericMySqlTable extends BaseMySqlTableClass {
    public function __construct($tableName, $dsn = "dwh", $host = "127.0.0.1") {
        $this->tableName = $tableName;
        parent::__construct($dsn, $host);
    }
}
