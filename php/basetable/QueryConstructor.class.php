<?php

class QueryConstructor {

    public static function buildInValues($inArray) {
        $tmpStr = "";
        $valStr = "";
        foreach($inArray as $item) {
            if ($valStr != "") {
                $valStr .= ",";
            }
            $tmpStr = "'$item'";
            $valStr .= $tmpStr;
        }
        return $valStr;
    }

    public static function negateOperator($operator) {
        switch ($operator) {
            case "=":
                $operator = "<>";
                break;
            case "LIKE":
                $operator = "NOT LIKE";
                break;
            default:
                throw new Exception("Unknown operator in findWhere");
        }
        return $operator;
    }



    public static function getOperator(&$value) {
        $operator = "=";
        if (is_array($value)) {
            $tmpStr = key($value);
            if ($tmpStr == "0") {
                $operator = "IN";
                $valStr = self::buildInValues($value);
                $value = "($valStr)";
                return $operator;
            }
            /* this is an object -- we assume we get
            *  an object styled as follows:
             *   { 'op'=>'an operator', 'value'=>"the value"}
             */
            if (!isset($value['op'])) {
                throw new Exception("Operator expected and not found!");
            }
            if (!isset($value['value'])) {
                throw new Exception("Object must have a value assigned!");
            }
            $operatorMap = array(
                "GT"=>">",
                "GE"=>">=",
                "LT"=>"<",
                "LE"=>"<=",
                "NE"=>"<>",
            );
            if (!isset($operatorMap[$value['op']])) {
                throw new Exception("Unknown operator ".$value['op']);
            }
            $operator = $operatorMap[$value['op']];
            $value = $value['value'];
            return $operator;
        }
        if (strpos($value, "%") !== false) {
            $operator = "LIKE";
        }
        return $operator;
    }
}
