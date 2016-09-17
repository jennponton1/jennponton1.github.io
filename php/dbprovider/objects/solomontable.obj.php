<?php

require_once "basetable.class.php";

class SolomonTable {

    public function findOpen(){
        throw new Exception("This method is not available for this object");
    }

    public function findWhere($params) {
        // Get the table name first
        if (!is_array($params) && !isset($params['table'])) {
            throw new Exception("You must pass a table name as parameter table to this function");
        }
        $table = new GenericPVSWTable($params['table']);
        unset($params['table']);
        $queryString = "";
        foreach($params as $key => $value) {
            $op = "=";
            if (strpos($value, '%') !== false) {
                $op = 'like';
            }
            $queryString = appendFieldList("$key $op '$value'", $queryString, " and ");
        }
        if ($queryString == '') {
            $resSet = $table->findWhere();
        }
        else {
            $resSet = $table->query($queryString);
        }
        $retSet = array();
        foreach($resSet as $row) {
            $retSet[] = $row;
        }
        return $retSet;
    }
}
