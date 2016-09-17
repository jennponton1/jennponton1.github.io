<?php

require_once "basetable.class.php";

class StockingDistributor {

    public function findOpen() {
        return $this->findWhere(array("custid"=>"%"));
    }

    public function findWhere($criteria) {
        $criteria = (array) $criteria;
        $tbl = new GenericMySqlTable("stock_dist");
        $where = $tbl->buildWhere(array_keys($criteria), array_values($criteria), false);
        $stmt = $tbl->multiJoin(
            "s",
            array(
                new JoinTable("c", "cust", array("lastname"))
            ),
            array(
                new JoinLink("IJ", "s.custid", "c.custid")
            ),
            array(
                "header"=>array("query"=>$where, "alias"=>"s")
                )
        );
        $dataSet =  $stmt->fetchAll();
        $retAr = array();
        foreach($dataSet as $row) {
            $obj = new stdClass();
            foreach($row as $field=>$value) {
                $objField = substr($field, 0, strlen($field)-2);
                $obj->$objField = $value;
            }
            $retAr[] = $obj;
        }
        return $retAr;
    }

    public function insert($values) {
        $values = (array) $values;
        $insObj = new StdClass();
        if (!isset($values['custid'])) {
            throw new Exception("You MUST Include a customer id for this object");
        }
        if (!isset($values['area'])) {
            throw new Exception("You MUST Include a MSA Area for this object");
        }
        $insObj->custid = $values['custid'];
        $insObj->area = $values['area'];
        $tbl = new GenericMySqlTable("stock_dist");
        $res = $tbl->insert($insObj);
        return $res;
    }

    public function delete($values) {
        $values = (array) $values;
        $delObj = new StdClass();
        if (!isset($values['custid'])) {
            throw new Exception("You MUST Include a customer id for this object");
        }
        $insObj->custid = $values['custid'];
        $tbl = new GenericMySqlTable("stock_dist");
        $res = $tbl->delete($insObj);
        return $res;
    }
}
