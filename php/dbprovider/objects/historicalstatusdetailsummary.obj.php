<?php

require_once "basetable.class.php";

class HistoricalStatusDetailSummary {
    protected function getWeekended($date) {
        $dow = date("w", strtotime($date));
        $lastDate = Date("Y-m-d", strtotime("$dow days ago", strtotime($date)));
        return $lastDate;
    }
    public function findOpen() {
        $lastDate = $this->getWeekended(Date("m/d/Y", strtotime("6 months ago")));
        return $this->findWhere(array("whsedate"=>array("op"=>"GE","value"=>$lastDate)));
    }

    public function findWhere($params) {
        $criteria = (array) $params;
        $histTable = new GenericMySqlTable("hist_statdetail");
        // whsedate is used as beginning date
        if (!isset($criteria['whsedate'])) {
            // start from 6 months ago to today
            $histDate = $this->getWeekended(Date("m/d/Y", strtotime("6 months ago")));
            $criteria['whsedate'] = array("op"=>"GE", "value"=>$histDate);
        }
        $fields = array_keys($criteria);
        $values= array_values($criteria);
        $where = $histTable->buildWhere($fields, $values);
        $sql = "select whsedate, siteid, chemcat, orderstatus, sum(bf) as bfsumm from hist_statdetail h
            where $where
            group by whsedate, siteid, chemcat, orderstatus
            ";

        $ds = $histTable->directQuery($sql, $values);
        return $ds->fetchAll();
    }
}
