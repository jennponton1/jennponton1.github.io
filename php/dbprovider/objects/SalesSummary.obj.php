<?php

require_once "basetable.class.php";

class SalesSummary {
    public function findOpen() {
        throw new Exception("You must provide criteria");
    }

    protected function buildWhere($criteria) {
        $map = SqlBuilder::createMap();
        $crit = (array) $criteria;
        $begFound = isset($crit['begper']);
        $endFound = isset($crit['endper']);
        if ($begFound && !$endFound) {
            throw new Exception("You must include and end date if you include a beginning date");
        }
        if (!$begFound && $endFound) {
            throw new Exception("You must include a beginning date if you include an ending date");
        }
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                    "field"=>"siteid",
                    "column"=>"siteid"
                ),
                array(
                    "field"=>"invtid",
                    "column"=>"s.invtid",
                    "op"=>"LIKE",
                ),
                array(
                    "field"=>"custid",
                    "column"=>"s.custid",
                    "op"=>"LIKE",
                ),
                array(
                    'field'=>'perpost',
                    'column'=>'perpost'
                ),
                array(
                    "field"=>"begper",
                    "column"=>"perpost",
                    "op"=>"GE"
                ),
                array(
                    "field"=>"endper",
                    "column"=>"perpost",
                    "op"=>"LE"
                ),
                array(
                    "field"=>"prodcat",
                    "column"=>"s.prodcat",
                    "op"=>"LIKE",
                ),
                array(
                    "field"=>"slsperid",
                    "column"=>"s.slsperid",
                    "op"=>"EQ",
                ),
            )
        );
        if (!$begFound && !$endFound && !isset($crit['perpost'])) {
            throw new Exception("You MUST provide a range of months");
        }
        $where = SqlBuilder::buildSql($crit, $map);
        //$sql = str_replace("/**/", $where, $this->searchSql);
        //$sql = $sql . $this->joinClause;
        $sql = $where;
        // throw new Exception("sql is $sql");
        return $sql;
    }

    public function findWhere($criteria) {
        $slsSum = new GenericMySqlTable("slssum");
        $sql = $this->buildWhere($criteria);
        $where = "where s.custid=c.custid and s.invtid=i.invtid ";
        if ($sql != "") {
            $where .= " and $sql ";
        }
        $query = "select s.*, c.lastname, i.descr From slssum s, cust c, invent i
            $where";
        $result = $slsSum->directQuery($query);

        $dataSet = array();
        foreach($result as $row) {
            $dataSet[] = $row;
        }
        return $dataSet;
    }
}
