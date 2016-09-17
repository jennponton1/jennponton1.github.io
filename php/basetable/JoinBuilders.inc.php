<?php

class JoinLink {

    protected $type;
    protected $link1;
    protected $link2;

    public function __construct($type, $link1, $link2) {
        $this->type = $type;
        $this->link1 = $link1;
        $this->link2 = $link2;
    }

    public function __set($name, $value) {
        if ($value === null) {
            throw new Exception("Field $name cannot be null!");
        }
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
}

class JoinTable {

    protected $tablename;
    protected $fieldlist;
    protected $alias;

    public function __set($name, $value) {
        if ($value === null && $name != "fieldlist") {
            throw new Exception("Field $name cannot be null!");
        }
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __construct($alias, $tablename, $fieldlist = null) {
        $this->tablename = $tablename;
        $this->fieldlist = $fieldlist;
        $this->alias = $alias;
    }
}

class JoinBuilder {
}

class PVSWJoinBuilder extends JoinBuilder {

    public static function buildFieldList($tableAr, $dsn = "adohtwsol") {
        $fieldList = "";
        foreach ($tableAr as $alias => $table) {
            if (is_object($table)) {
                if ($table->fieldlist === null) {
                    $tmpTable = new GenericPVSWTable($table->tablename, $dsn);
                    $fieldListAr = $tmpTable->getColumnList();
                }
                else {
                    $fieldListAr = $table->fieldlist;
                }
                foreach ($fieldListAr as $field) {
                    $fieldList = appendFieldList("$table->alias.\"$field\" as $field" . "_$table->alias", $fieldList);
                }
            } else {
                $tmpTb = new GenericPVSWTable($table, $dsn);
                foreach ($tmpTb->getColumnList() as $columns) {
                    $fieldList = appendFieldList("$alias.\"$columns\" as $columns" . "_$alias", $fieldList);
                }
                unset($tmpTb);
            }
        }
        return $fieldList;
    }

    public static function buildTableList($tableAr) {
        $tableList = "";
        foreach ($tableAr as $alias => $table) {
            if (is_object($table)) {
                // Handle a JoinTable entry
                $tableList = appendFieldList("$table->tablename $table->alias", $tableList);
            } else {
                $tableList = appendFieldList("$table $alias", $tableList);
            }
        }
        return $tableList;
    }

    public static function buildJoinList($links) {
        $joinList = "";
        foreach ($links as $link => $rel) {
            if (is_object($rel)) {
                $joinType = $rel->type;
                if ($joinType == 'OJ') {
                    $joinType = "(+)";
                } else {
                    $joinType = "";
                }
                $link = $rel->link1;
                $rel = $rel->link2;
            } else {
                $joinType = '(+)';
                if (is_array($rel)) {
                    /* /* if this an array, then
                     * what got passed was an array of the form
                     * $item[$type]= array([$link][$rel])
                     * where $item[$type] is the join type
                     */
                    if ($link == 'OJ') {
                        $joinType = "(+)";
                    } else {
                        $joinType = "";
                    }
                    $link = key($rel);
                    $rel = $rel[$link];
                }
            }
            $joinList = appendFieldList("$link = $rel" . $joinType, $joinList, ' and ');
        }
        return $joinList;
    }
}

class MySqlJoinBuilder extends JoinBuilder {

    public static function buildFieldList($tableAr) {
        $fieldList = "";
        foreach ($tableAr as $alias => $table) {
            if (is_object($table)) {
                if ($table->fieldlist === null) {
                    $tmpTable = new GenericMySqlTable($table->tablename);
                    $fieldListAr = $tmpTable->getColumnList();
                }
                else {
                    $fieldListAr = $table->fieldlist;
                }
                foreach ($fieldListAr as $field) {
                    $fieldList = appendFieldList("$table->alias.$field as $field" . "_$table->alias", $fieldList);
                }
            } else {
                $tmpTb = new GenericMySqlTable($table);
                foreach ($tmpTb->getColumnList() as $columns) {
                    $fieldList = appendFieldList("$alias.$columns as $columns" . "_$alias", $fieldList);
                }
                unset($tmpTb);
            }
        }
        return $fieldList;
    }

    public static function buildTableList($tableAr) {
        $tableList = "";
        foreach ($tableAr as $alias => $table) {
            if (is_object($table)) {
                // Handle a JoinTable entry
                $tableList = appendFieldList("$table->tablename $table->alias", $tableList);
            } else {
                $tableList = appendFieldList("$table $alias", $tableList);
            }
        }
        return $tableList;
    }

    public static function buildJoinList($links) {
        $joinList = "";
        foreach ($links as $link => $rel) {
            if (is_object($rel)) {
                $joinType = $rel->type;
                if ($joinType == 'OJ') {
                    $joinType = "(+)";
                } else {
                    $joinType = "";
                }
                $link = $rel->link1;
                $rel = $rel->link2;
            } else {
                $joinType = '(+)';
                if (is_array($rel)) {
                    /* /* if this an array, then
                     * what got passed was an array of the form
                     * $item[$type]= array([$link][$rel])
                     * where $item[$type] is the join type
                     */
                    if ($link == 'OJ') {
                        $joinType = "(+)";
                    } else {
                        $joinType = "";
                    }
                    $link = key($rel);
                    $rel = $rel[$link];
                }
            }
            $joinList = appendFieldList("$link = $rel" . $joinType, $joinList, ' and ');
        }
        return $joinList;
    }
}
