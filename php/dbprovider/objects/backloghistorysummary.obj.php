<?php

require_once "basetable.class.php";

class BacklogHistorySummary {

    public function findOpen() {
        // find the last whse week
        $dow = date("w");
        $wkstart = date("Y-m-d", strtotime($dow." days ago"));
        return $this->findWhere(array("whsedate"=>$wkstart));
    }

    public function findWhere($params) {
        $blHistory = new GenericMySqlTable("hist_sobl");
        $fields = array_keys((array) $params);
        $values = array_values((array) $params);
        $where = $blHistory->buildWhere($fields, $values);
        $sql = "select siteid, sitetype, s.prodcat, chemcat, whsedate, sum(bf) as bfsumm from hist_sobl s, htinprod p
            where $where and s.prodcat=p.prodcat
                group by siteid, sitetype, prodcat, whsedate
            ";
        $sql = "
            select siteid, chemcat, whsedate, sum(bf) as bfsumm from hist_sobl s, htinprod p
            where $where and s.prodcat=p.prodcat
                group by siteid, chemcat, whsedate
            ";
        $res = $blHistory->directQuery($sql, $values);
        return $res->fetchAll();
    }
}
