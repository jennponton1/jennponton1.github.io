<?php

require_once __DIR__."/ExpressionHandlers.inc.php";
require_once __DIR__."/JoinBuilders.inc.php";
require_once __DIR__."/QueryConstructor.class.php";
require_once __DIR__."/utilityfunctions.inc.php";


class BaseTableClass {

    protected $tableName;
    protected $pdoDb;
    protected $colList;
    protected $exclVars;
    protected $fieldQuote;

    public function __construct() {
        $this->fieldQuote = "";
        if (!isset($this->tableName)) {
            $this->tableName = strtolower(get_class($this));
        }
        $this->pdoDb = null;
        $this->exclVars = null;
        $this->colList = null;
    }

    protected function getColumns() {
        throw new Exception("You must declare this in your subclass");
    }

    public function getColumnList() {
        if ($this->colList === null) {
            $this->getColumns();
        }
        return $this->colList;
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function __call($name, $arguments) {
        $name = trim(strtolower($name));
        $this->getColumns();
        switch ($name) {
            case "findwhere":
                $fieldArgs = array_keys($arguments[0]);
                $valArgs = array_values($arguments[0]);
                return $this->findWhere($fieldArgs, $valArgs, @$arguments[1]);
                break;
            case "query":
                return $this->$name($arguments[0]);
                break;
            default:
                throw new Exception("Unknown Method $name");
        }
    }

    protected function runQuery($sql, $values) {
        try {
            $stmt = $this->pdoDb->prepare($sql);
        } catch (Exception $e) {
            $string = "Failed during query preparation: $sql " .
                    var_export($values, true) .
                    "<br>" .
                    $e->getMessage();
            throw new Exception($string);
        }
        if ($stmt === false) {
            throw new Exception("Error during prepare: $sql");
        }
        try {
            $res = $stmt->execute($values);
        } catch (Exception $e) {
            $string = "Failed during query execution: $sql " .
                    var_export($values, true) .
                    "<br>" .
                    $e->getMessage();
            throw new Exception($string);
        }
        if ($res === false) {
            throw new Exception("Error during query ");
        }
        return $stmt;
    }

    public function directQuery($sqlString, $values = null) {
        return $this->runQuery($sqlString, $values);
    }

    protected function query($criteriaStr = "") {
        if ($criteriaStr === "") {
            throw new Exception("Empty Query String!!!");
        }
        $parsedQuery = ExpressionParser::parse($criteriaStr);
        return $this->runQuery(
            "select * From $this->tableName where $parsedQuery->fieldList",
            $parsedQuery->valueList
        );
    }

    public function buildWhere($fields, &$values, $parameterized = true) {
        $where = "";
        foreach ($fields as $ndx => $field) {
            $operator = QueryConstructor::getOperator($values[$ndx]);
            if (substr($field, strlen($field) - 1, 1) === '!') {
                $field = substr($field, 0, strlen($field) - 1);
                $operator = QueryConstructor::negateOperator($operator);
            }
            if ($where != '') {
                $where .= ' and ';
            }
            if ($parameterized) {
                $queryVal = "?";
            }
            else {
                if ($operator == "IN") {
                    $queryVal = $values[$ndx];
                }
                else {
                    $queryVal =  $this->pdoDb->quote($values[$ndx]);
                    if (!$queryVal) {
                        $queryVal = "'".str_replace("'", "''", $values[$ndx])."'";
                    }
                }
            }
            $where .= $this->fieldQuote.$field.$this->fieldQuote." $operator $queryVal";
        }
        return $where;
    }

    /**
     *
     * @param  $$fields -- criteria fields
     * @param  $values -- values of criteria fields
     * Arguments will be an array of column and values, e.g.
     *  array("ordnbr","T12345");
     */
    protected function findWhere($fields, $values, $orderBy = '') {
        $sql = "select * From $this->tableName ";
        $where = $this->buildWhere($fields, $values);
        if ($where !== '') {
            $sql = $sql . " where $where ";
        }
        if ($orderBy != "") {
            $sql .= " order by $orderBy";
        }
        return $this->runQuery($sql, $values);
    }

    // @TODO: Check later to see if we can consolidate some of these methods
    protected function validateArgument($arguments) {
        // force an object into an array
        $tmpArguments = (array) $arguments;
        foreach ($this->exclVars as $excluded) {
            unset($tmpArguments[$excluded]);
        }
        $arguments = $tmpArguments;
        // verify that we have an array
        if (!is_array($arguments)) {
            throw new Exception("You must pass an array or object to this method");
        }
        return $arguments;
    }

    public function insert($arguments = null) {
        if ($arguments === null) {
            $arguments = $this;
        }
        $arguments = $this->validateArgument($arguments);
        $this->getColumns();
        // build the insert
        $fieldList = "";
        $parmList = "";
        $valueList = array();
        $fieldAr = array();
        foreach ($arguments as $field => $value) {
            if (!in_array($field, $this->colList)) {
                throw new Exception("Trying to insert using an unknown column: $field");
            }
            $fieldList = appendFieldList($this->fieldQuote.$field.$this->fieldQuote, $fieldList);
            $parmList = appendFieldList("?", $parmList);
            $fieldAr[] = $field;
            $valueList[] = $value;
        }
        $sql = "insert into $this->tableName ($fieldList) ";
        $sql .= "values($parmList)";
        $stmt = $this->pdoDb->prepare($sql);
        if ($stmt === false) {
            throw new Exception("failed during insert $sql");
        }
        $stmt->execute($valueList);
        return array_combine($fieldAr, $valueList);
    }

    public function delete($arguments = null) {
        if ($arguments === null) {
            $arguments = $this;
        }
        $arguments = $this->validateArgument($arguments);
        $this->getColumns();
        $fieldList = "";
        $valueList = array();
        foreach ($arguments as $field => $value) {
            if (!in_array($field, $this->colList)) {
                throw new Exception("Trying to delete using an unknown column: $field");
            }
            $fieldList = appendFieldList("$field = ?", $fieldList, ' and ');
            $valueList[] = $value;
        }
        $sql = "delete from $this->tableName  ";
        $sql .= "where $fieldList";
        $stmt = $this->pdoDb->prepare($sql);
        if ($stmt === false) {
            throw new Exception("failed during insert $sql ");
        }
        $res = $stmt->execute($valueList);
        return $res;
    }

    public function update($keys, $arguments) {
        checkObjectOrArray($keys);
        checkObjectOrArray($arguments);
        $keys = (array) $keys;
        $arguments = (array) $arguments;
        if (count($keys) == 0) {
            throw new Exception("You may not pass an empty array for the update keys");
        }
        $items = $this->findWhere(array_keys($keys), array_values($keys));
        $item = $items->fetch();
        if ($item === false) {
            throw new Exception("Can't find record to be updated");
        }
        if (count($arguments) == 0) {
            return $item;
        }
        $sql = "update " . $this->tableName;
        $setList = "";
        $valueArray = array();
        foreach ($arguments as $field => $value) {
            $setList = appendFieldList(
                " ".$this->fieldQuote."$field".$this->fieldQuote." = ? ",
                $setList,
                ","
            );
            $valueArray[] = $value;
        }
        $sql .= " set " . $setList;
        $where = $this->buildWhere(array_keys($keys), array_values($keys));
        $valueArray = array_merge($valueArray, array_values($keys));
        $sql .= "where " . $where;
        $stmt = $this->pdoDb->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Update failed during prepare: $sql<br>");
        }
        $res = $stmt->execute($valueArray);
        return $res;
    }

    /*
      protected function validateJoinArguments($joinTable, $links) {
      if ($joinTable === null) {
      throw new Exception("You must pass a table object to this method");
      }
      checkObjectOrArray($links);
      $links = (array) $links;
      if (get_parent_class($this) != get_parent_class($joinTable)) {
      throw new Exception("You must pass a table object of the same type as this table to this method");
      }
      } */

    /**
     *
     * @param $joinTable Table to be joined to this one: MUST BE SAME TABLE CLASS
     * @param $links array of headerField->joinField
     * @param $criteria array consisting of header=>query and join->query,
     *          e.g.  "header"=>"field1 = '1' and field2= 0"
     * @param type $arguments
     * @throws Exception
     */
    public function join($joinTable, $links, $criteria) {
        //$this->validateJoinArguments($joinTable, $links);
        // OK, so at this point we have a two tables and a set of join field
        // Build the column list
        $fieldList = "";
        $headerCols = $this->getColumnList();
        foreach ($joinTable->getColumnList() as $field) {
            if (in_array($field, array_values($links))) {
                continue;
            }
            $suffix = "";
            if (in_array($field, $headerCols)) {
                $suffix = " as " . $field . "_2";
            }
            $fieldList = appendFieldList("j2." . $field . $suffix, $fieldList, ",");
        }

        // Build the main sql statement
        $sql = "select j1.*, $fieldList from " . $this->tableName . " j1, " . $joinTable->getTableName() . " j2 ";

        // Build the join clause, assuming an inner join
        // the primary table (This one) will be j1 and the joined table will be j2
        $linkClause = "";
        foreach ($links as $header => $join) {
            $linkClause = appendFieldList("j1.$header = j2.$join ", $linkClause, " and ");
        }

        // Now check for any criteria
        $headerClause = "";
        $detailClause = "";
        $values = array();
        if ($criteria !== null && is_array($criteria)) {
            if (isset($criteria['header'])) {
                // Handle Header
                $headerObject = ExpressionParser::parse($criteria['header'], "j1");
                // Finally --
                $headerClause = $headerObject->fieldList . " and ";
                $values = array_merge($values, $headerObject->valueList);
            }
            if (isset($criteria['join'])) {
                // Handle sub/detail
                $detailObject = ExpressionParser::parse($criteria['join'], "j2");
                // Finally
                $detailClause = " and " . $detailObject->fieldList;
                $values = array_merge($values, $detailObject->valueList);
            }
        }

        $finalSql = $sql . " where " . $headerClause . " " . $linkClause . " " . $detailClause;
        return $this->runQuery($finalSql, $values);
    }
}
