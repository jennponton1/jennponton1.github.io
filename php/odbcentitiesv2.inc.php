<?php

define('DEBUG_MAX', 1000);
define("SOLDSN", "adohtwsol");

abstract class PDOBaseModelClass {

    protected $pdoDb;
    protected $searchStmt;
    protected $allStmt;
    protected $updStmt;
    protected $insStmt;

    public function __construct($configs = '') {
        try {
            //$this->db = new PDO("mysql:dbname=" . MYSQL_DB . ";host=" . MYSQL_HOST, "root");
            if ($configs != '' && is_array($configs)) {
                if (isset($configs['search'])) {
                    $this->searchStmt = $this->pdoDb->prepare($configs['search']);
                } // check for search sql;
                if (isset($configs['all'])) {
                    $this->allStmt = $this->pdoDb->prepare($configs['all']);
                }
                if (isset($configs['updateItem'])) {
                    $this->updStmt = $this->pdoDb->prepare($configs['updateItem']);
                }
                if (isset($configs['insertItem'])) {
                    $this->insStmt = $this->pdoDb->prepare($configs['insertItem']);
                }
            }
        } catch (Exception $e) {
            echo "<br>\n";
            echo "There was an error with the db: " . $e->getMessage();
            echo "<br>\n";
            echo "Stopping";
            die("");
        } // catch
    }

    public function getInfo() {
        $refl = new ReflectionClass($this);

        echo "This object is an instance of " . $refl->getName() . "<br>";
        echo "There are the following properties:<br>";
        $props = $refl->getProperties();
        $count = 0;
        echo "<ul>";
        foreach ($props as $prop) {
            $count++;
            echo "<li>";
            echo $prop->name . " from " . $prop->class;
            echo "</li>";
        }
        echo "</ul>";
        if ($count == 0) {
            echo "There were no properties<br>";
        }
    }
    
    public function getDB() {
        return $this->pdoDb;
    }

// construct;
}


abstract class PDOBaseODBCModelClass extends PDOBaseModelClass {

    public function __construct($configs = '') {
        try {
            $dsn = SOLDSN;
            if (isset($configs['dsn'])) {
                $dsn = $configs['dsn'];
            }
            $this->pdoDb = new PDO("odbc:" . $dsn); //dbname=" . MYSQL_DB . ";host=" . MYSQL_HOST, "root");
            parent::__construct($configs);
            $this->pdoDb->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "<br>\n";
            echo "There was an error with the db: " . $e->getMessage();
            echo "<br>\n";
            //echo "Stopping";
            //die("");
        } // catch
    }

// construct;
  
}

class PDONewODBCModelClass extends PDOBaseODBCModelClass implements Iterator {

    protected $meta;
    protected $tablename;
    protected $fieldList;
    protected $currentStmt;
    protected $currentPosition;
    protected $lastFetchedRow;
    protected $idFieldName;
    protected $ops;

    public function __construct($dsn = "") {
        $this->ops = array("LT"=>"<","GE"=>">=","EQ"=>"=","LE"=>"<=","GT"=>">=","LIKE"=>"like");
        $this->meta = new ReflectionClass($this);
        $this->tablename = $this->meta->getName();
        $this->fieldList = array();
        $list = $this->meta->getProperties();
        $this->idFieldName = null;
        foreach ($list as $prop) {            
            if ($prop->class == $this->meta->getName()) { 
                $docComment = $prop->getDocComment();
                
                $docComment = str_replace("*", "", $docComment);
                $docComment = str_replace("/", "", $docComment);
                $docComment = trim($docComment);
                if (strpos($docComment, "@Id") !== false) {
                    if ($this->idFieldName !== null) {
                        if (!is_array($this->idFieldName)) {
                            $tmp = $this->idFieldName;
                            unset($this->idFieldName);
                            $this->idFieldName = array();
                            $this->idFieldName[] = $tmp;
                            unset($tmp);
                        } // NOT AN ARRAY, fix that!!
                        $this->idFieldName[] = $prop->name;
                    } // id already set, add to the array
                    else {
                        $this->idFieldName = $prop->name;
                    } //id not set, set to single field
                }
                if (strpos($docComment,"@Column") !== false) { 
                    $this->fieldList[] = strtolower($prop->name);
                }
            }
        } // iterating through properties
        if ($this->idFieldName === null) {
            die("No Identifier !! You must specify an ID Field!!");
        }
        $fieldListString = implode(",", $this->fieldList);
        $allSql = "select " . $fieldListString . " From $this->tablename";
        
        if (is_array($this->idFieldName)) { 
            $searchSql = $allSql . " where ";
            $where = "";
            foreach ($this->idFieldName as $field) {
                if ($where != "")  {
                    $where .= " and ";
                }
                $where .= $field . "=?";
            }
            $searchSql .= $where;
            $allSql .= " order by " . implode(",", $this->idFieldName);
        } else {
            $searchSql = $allSql . " where $this->idFieldName=?";
            $allSql .= " order by $this->idFieldName";
        }
        $parmInsString = str_repeat("?,", count($this->fieldList) - 1) . "?";
        $insSql = "insert into $this->tablename ($fieldListString) values($parmInsString)";
        $updSetString = "";
        foreach ($this->fieldList as $field) {
            if ($updSetString != "") {
                $updSetString .= ", ";
            }
            $updSetString .= "$field=?";
        }
        $updSql = "update $this->tablename set $updSetString where $this->idFieldName=?";

        $configs = array(
            "all" => $allSql,
            "insertItem" => $insSql,
            "updateItem" => $updSql,
            "search" => $searchSql,
        );
        if ($dsn != "") {
            $configs['dsn'] = $dsn;
        }
        //var_dump($configs);
        $this->resetCurrentFetchVars();
        parent::__construct($configs);
    }

    protected function resetCurrentFetchVars() {
        $this->currentStmt = null;
        $this->currentPosition = null;
        $this->lastFetchedRow = false;
    }

// construct
   
   public function getFieldList() {
     return $this->fieldList;
   }    

    public function save() {
        $parmList = array();
        foreach ($this->fieldList as $field) {
            $parmList[] = $this->$field;
        }
        $res = $this->insStmt->execute($parmList);
        if ($res === false) {
            var_dump($this->insStmt->errorInfo());
            die("Insert Failed");
        }
    }

    public function update() {
        $parmList = array();
        foreach ($this->fieldList as $field) {
            $parmList[] = $this->$field;
        }
        if ($this->lastFetchedRow !== null && $this->lastFetchedRow !== false) {
            $parmList[] = $this->lastFetchedRow[$this->idFieldName];
        } else {
            die("You haven't fetched a row recently to be updated!!!");
        }
        var_dump($parmList);
        $res = $this->updStmt->execute($parmList);
        if ($res === false) {
            var_dump($this->insStmt->errorInfo());
            die("Update Failed");
        }
    }

    public function findAll() {
        $resultSet = null;
        $resultSet = $this->allStmt->execute();
        if ($resultSet === false) {
            var_dump($this->allStmt->errorInfo());
        }
        $this->allStmt->setFetchMode(PDO::FETCH_ASSOC);
        $this->currentStmt = $this->allStmt;
        $this->currentPosition = 0;
        $this->lastFetchedRow = null;
        return $this->currentStmt;
    }

    public function find($idval="") {
        if ($idval == "") {
            throw new Exception("You must pass a value to the find method!");
        }
        if (is_array($idval)) {
        $res = $this->searchStmt->execute(($idval));
            
        }
        else {
        $res = $this->searchStmt->execute(array($idval));
        }
        if ($res === false) {
            var_dump($this->insStmt->errorInfo());
            die("search Failed");
        }
        $this->currentStmt = $this->searchStmt;
        $this->currentPosition = 0;
        $this->lastFetchedRow = null;
        $this->currentStmt->setFetchMode(PDO::FETCH_ASSOC);
        $retItem = $this->currentStmt->fetch();
        $retObj = null;
        if (is_array($retItem)) {
            $retItem = array_change_key_case($retItem, CASE_LOWER);
            $this->currentPosition++;
            $this->lastFetchedRow = $retItem;
            unset($retObj);
            foreach ($this->fieldList as $field) {
                $retObj->$field = $retItem[$field];
            }
        }
        return $retObj;
    }
    
    public function findWhere($critAr = "" ) {
        if ($critAr == "" ) {
            throw new Exception("You must include criteria for this function!!");
        }
        if (!is_array($critAr) ) {
            throw new Exception("You must include an array for  criteria for this function!!");
        }
        $sql = "select ".implode(",",$this->fieldList)." from ".$this->tablename;
        $sql = str_replace("current", '"current"', $sql);
        $where = "";
        foreach($critAr as $field=>$val) {
            $op = "like";
            if (in_array(  $field, array_keys($this->ops) ) && is_array($val)) {
                $op = $this->ops[$field];
                $field = key($val);
                $val = $val[$field];
            }
            if ($where != "") {
                $where .= " and ";
            }
            if (strtolower($field) == 'current')  {
                $field = "\"$field\"";
            }
            $where .= " $field $op '$val' ";
        }
        $sql .= " where $where";
//        echo "<hr>$sql</hr>";
//        die($sql);
        $this->currentStmt = $this->pdoDb->query($sql);
        $this->currentPosition = 0;
        $this->lastFetchedRow = null;
        $this->currentStmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this->currentStmt;
    }
    
    public function query($sql = "") {
        if ($sql == "") {
            throw new Exception("You must include a SQL Statement!");
        }
        $this->currentStmt = $this->pdoDb->query($sql);
        $this->currentPosition = 0;
        $this->lastFetchedRow = null;
        $this->currentStmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this->currentStmt;
    }

    //Iterator functions
    public function rewind() {
        if ($this->currentPosition != 0) {
            die("I don't do this yet (rewind).  Sorry");
        }
    }

    public function current() {
        if ($this->currentPosition !== null && $this->lastFetchedRow !== false) {
            if ($this->currentPosition == 0) {
                $this->next();
            }
            if ($this->lastFetchedRow === FALSE)
                return false;
//                die("Stopping on false");
            $this->lastFetchedRow = array_change_key_case($this->lastFetchedRow, CASE_LOWER);
            unset($retObj);
            $retObj = new StdClass();
            foreach ($this->fieldList as $field) {
                $retObj->$field = $this->lastFetchedRow[$field];
            }
            $this->currentPosition++;
            return $retObj;
        } else {
            return false;
//            die("I don't do this yet (current).  Sorry");
        }
    }

    public function next() {
        if ($this->currentPosition !== null && $this->lastFetchedRow !== false) {
            $this->currentPosition++;
            $this->lastFetchedRow = $this->currentStmt->fetch();
            if ($this->lastFetchedRow === false) {
                $this->resetCurrentFetchVars();
            }
        } else {
            return false;
//            die("I don't do this yet (next).  Sorry");
        }
    }

    public function key() {
        die("I don't do this yet (key).  Sorry");
    }

    public function valid() {
        if ($this->currentPosition !== null && $this->lastFetchedRow !== false) {
            return true;
        } else {
            return false;
        }

        //die("I don't do this yet (valid).  Sorry");
    }

}