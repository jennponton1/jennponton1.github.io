<?php

class ExpressionParser {

    protected static function checkEmptyQuery($str = "") {
        if ($str == "") {
            throw new Exception("Empty Query String!!!");
        }
    }

    protected static function fixAlias($tableAlias = "") {
        if ($tableAlias !== "") {
            $tableAlias = trim($tableAlias) . ".";
        }
        return $tableAlias;
    }

    public static function parse($parseString = "", $tableAlias = "") {
        require_once "phpsqlparse/phpsqlparser.php";
        self::checkEmptyQuery($parseString);
        $tableAlias = self::fixAlias($tableAlias);
        $newParseStr = "select * From tbl where $parseString";
        $newParseStr = str_replace('"', '`', $newParseStr);
        $parser = new PHPSQLParser($newParseStr, true);
        file_put_contents("FILE_LOG.log", "ANOTHER $parseString\n", FILE_APPEND);
        $newStr = "";
        $lastOp = "";
        $values = array();
        foreach($parser->parsed['WHERE'] as $items) {
            // Each pass should get a colref, operator value
            switch($items["expr_type"]) {
                case "operator":
                    $lastOp = $items['base_expr'];
                    $newStr .= " ".$items['base_expr'];
                    break;
                case "colref":
                    $newStr .= " $tableAlias".$items['base_expr'];
                    break;
                case "const":
                    $newStr .= " ? ";
                    $values[] = stripQuotes($items['base_expr']);
                    break;
                case "in-list":
                    if (strtolower($lastOp) != "in")  {
                        throw new Exception(
                            "Out of order on an IN expression <br>$parseString<br>".
                            var_export($parser->parsed['WHERE'], true)
                        );
                    }
                    $newStr .= " (";
                    $count = 0;
                    foreach($items['sub_tree'] as $stItem) {
                        if ($count > 0) {
                            $newStr .= ",";
                        }
                        $newStr .= "?";
                        $values[] = stripQuotes($stItem['base_expr']);
                        $count++;
                    }
                    $newStr .= ") ";
                    break;
                case "function":
                    // attempt to rebuild
                    $origStr = "";
                    if ($items['base_expr'] == 'substring') {
                        foreach($items['sub_tree'] as $subItem) {
                            if ($origStr !== "") {
                                $origStr .= ", ";
                            }
                            $origStr .= $subItem['base_expr']." ";
                        }
                        $origStr = "substring(".$origStr.")";
                    }
                    else {
                        throw new Exception("Unknown function ".var_export($items['base_expr'],true));
                    }
                    $newStr .= $origStr;
                    break;
                default:
                    echo "DONT KNOW WHAT ".$items['expr_type']." is<br>";
                    var_dump($parseString);
                    echo "<hr>";
            }
        }
        $fieldList = str_replace('`', '"', $newStr);
        $valueList = $values;

        $returnObject = new stdClass();
        $returnObject->fieldList = $fieldList;
        $returnObject->valueList = $valueList;
        return $returnObject;

    }
}
