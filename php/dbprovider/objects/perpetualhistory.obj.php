<?php

require_once 'basetable.class.php';

class PerpetualHistory {

    protected $hdrFields = array(
        "invtid",
        "siteid",
        "qtyonhand",
        "whseloc",
        "lotser",
    );
    protected $sqlMaps = array(
        "header"=> array(
            array(
                "field"  => "invtid",
                "column" => "invtid",
                "op"     => "LIKE"
            ),
            array(
                "field"  => "whseloc",
                "column" => "whseloc",
                "op"     => "LIKE"
            ),
            array(
                "field"  => "siteid",
                "column" => "siteid",
                "op"     => "LIKE"
            ),
        ),
        "detail"=>array(
            array(
                "field"  => "descr",
                "column" => "descr",
                "op"     => "LIKE"
            ),
        )
    );
    protected $perpTable = null;
    protected $periodFld = null;

    public function findOpen() {
        throw new Exception("You must pass a period to this object");
    }

    protected function buildArray($parms, $which) {
        $tmpAr = array();
        foreach ($parms as $parm => $val) {
            if (in_array($parm, $this->hdrFields)) {
                if ($which == "header") {
                    $tmpAr[$parm] = $val;
                }
                continue;
            }
            if (substr($parm, 0, 2) == "fz") {
                if ($which == "header") {
                    $tmpAr[$parm] = $val;
                }
                continue;
            }
            if ($which != "header") {
                $tmpAr[$parm] = $val;
            }
        }
        return $tmpAr;
    }

    protected function getQuery($parms, $which) {
        if ($this->perpTable === null) {
            throw new Exception("You must setup the table first");
        }
        $tmpAr = $this->buildArray($parms, $which);
        $map   = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            $this->sqlMaps[$which]
        );
        $where = " " . SqlBuilder::buildSql($tmpAr, $map);
        return $where;
    }

    protected function initializeQuery(&$params) {
        $this->periodFld = "fz" . $params['period'];
        $this->sqlMaps['header'][] = array(
            "field"  => $this->periodFld,
            "column" => $this->periodFld,
            "op"     => "EQ"
        );
        unset($params['period']);
        if (isset($params['qtyonhand'])) {
            $params[$this->periodFld] = $params['qtyonhand'];
            unset($params['qtyonhand']);
        }
        if (isset($params['qtyonhand!'])) {
            $params[$this->periodFld . "!"] = $params['qtyonhand!'];
            unset($params['qtyonhand!']);
        }
    }

    public function findWhere($params) {
        if (!isset($params['period'])) {
            throw new Exception("You must pass a period to this object");
        }
        $this->initializeQuery($params);
        $table = $this->periodFld;
        $this->perpTable = new GenericMySqlTable($this->periodFld);
        $invent          = new GenericMySqlTable("invent");
        $hdrWhere        = $this->getQuery($params, "header");
        $dtlWhere        = $this->getQuery($params, "detail");
        $res             = $this->perpTable->join(
            $invent,
            array("invtid" => "invtid"),
            array("header" => $hdrWhere, "detail" => $dtlWhere)
        );
        $retAr           = array();
        foreach ($res as $row) {
            $row->qtyonhand = $row->$table;
            unset($row->$table);
            $key            = $row->siteid . $row->invtid . $row->lotser . $row->whseloc;
            $retAr[$key]    = $row;
        }
        ksort($retAr);
        return array_values($retAr);
    }
}
