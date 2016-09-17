<?php

class SqlBuilder {

    public function __construct() {

    }

    public static function createMap() {
        return array();
    }

    public static function addMapItem(&$map, $options) {
        $optAr = $options;
        if (!is_array(current($options))) {
            // we will do this for each element of the array
            $optAr = array($options);
        }
        foreach ($optAr as $option) {
            $option = json_decode(json_encode($option));
            $key = strtolower($option->field);
            $mapEl = new stdClass();
            $mapEl->column = $option->column;
            if (isset($option->op)) {
                $mapEl->operator = $option->op;
            }
            else {
                $mapEl->operator = "EQ";
            }
            $map[$key] = $mapEl;
        }
    }

    public static function checkNull($var, $fieldName) {
        if ($var === "" || $var === null) {
            throw new Exception("Paramter $fieldName cannot be null or empty!");
        }
    }

    public static function makeArray($var) {
        if (is_array($var)) {
            return $var;
        }
        return array($var);
    }
    
    public static function getOperator($operator, &$value) {
        $tmpClause = "";
        $not = "";
        $notLike = "";
        if (substr($value, 0, 1) == "!") {
            $not = "!";
            $notLike = " NOT ";
            $value = substr($value, 1);
        }
        switch ($operator) {
            case "EQ":
                $tmpClause .= " $not= ";
                break;
            case "GE":
                $tmpClause .= " >= ";
                break;
            case "LE":
                $tmpClause .= " <= ";
                break;
            case "LIKE%":
                $value .= "%";
                // Also apply case for LIKE
            case "LIKE":
                $tmpClause .= "$notLike like ";
                break;
            default:
                throw new Exception("Unknown operator " . $operator);
        }
        return $tmpClause;
    }

    public static function buildSql($parms = "", $map = "") {
        self::checkNull($parms, "Parameters");
        self::checkNull($parms, "Column Map");
        $sqlStr = "";
        foreach ($parms as $key => $val) {
            $key = strtolower($key);
            if (!isset($map[$key])) {
                throw new Exception("$key is not a recognized criteria field!!");
            }
            $val = self::makeArray($val);
            foreach ($val as $value) {
                if ($sqlStr != "") {
                    $sqlStr .= " and ";
                }
                $tmpClause = $map[$key]->column;
                $tmpClause .= self::getOperator($map[$key]->operator, $value);

                
                $tmpClause .= " '$value' ";
                $sqlStr .= $tmpClause;
            }
        }

        return $sqlStr;
    }

}
