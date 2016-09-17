<?php

    // This is currently an empty file
require_once "basetable.class.php";

class InventoryOnHand {
    protected $location;
    protected $nonzero = false;

    public function __construct($dsn = "adohtwsol") {
        $this->location = new GenericPVSWTable("location", $dsn);
    }

    public function constructDataset($stmt = null) {
        $dataSet = array();
        foreach($stmt as $row) {
            if ($this->nonzero) {
                if ($row->qtyonhand_l == 0) {
                    continue;
                }
            }
            // Adjust the row names
            $newRow = new StdClass();
            foreach($row as $field => $val) {
                $strippedField = str_replace("_l", "", $field);
                $strippedField = str_replace("_i", "", $strippedField);
                $newRow->$strippedField = $val;
            }
            //throw new Exception(var_export($row, true)."<hr>".var_export($newRow, true)."<hr>".var_export($stmt, true));
            $dataSet[] = $newRow;
        }
        return $dataSet;
    }

    public function findOpen() {
        $stmt = $this->findWhere(array("qtyonhand!"=>"0"));
        return $this->constructDataset($stmt);
    }

    public function findWhere($params) {
        $params = (array) $params;
        if (isset($params['nonzero'])) {
            if (!isset($params['qtyonhand'])) {
                $params['qtyonhand!'] = "0";
            }
            $this->nonzero = ($params['nonzero'] == 'true');
            unset($params['nonzero']);
        }
        //$stmt = $this->location->findWhere($params);
        $criteria = $this->location->buildWhere(array_keys($params), array_values($params), false);
        $stmt = $this->location->multiJoin(
            "l",
            array(
                new JoinTable("i", "invntory", array("descr"))
            ),
            array(
                new JoinLink("OJ", "l.invtid", "i.invtid"),
            ),
            array("header"=>array("query"=>$criteria, "alias"=>"l"))
        );
        return $this->constructDataset($stmt);
    }
    protected function checkKey($val) {
        if ($val == "") {
            throw Exception("You must include an invtid, siteid, whseloc and lotsernbr");
        }
        return $val;
    }

    public function update($values) {
        // find the keys
        $valAr = (array) $values;
        $keySet = array(
            "invtid"=> $this->checkKey($valAr['invtid']),
            "siteid"=>$this->checkKey($valAr['siteid']),
            "whseloc"=>$this->checkKey($valAr['whseloc']),
            "lotsernbr"=>$this->checkKey($valAr['lotsernbr'])
        );
        $tbl = new GenericPVSWTable("location");
        $tbl->update($keySet, $values);
        return $this->findWhere($keySet);

    }
}
