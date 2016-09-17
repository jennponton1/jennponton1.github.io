<?php

class InventoryOld extends dbodbcBase {

    private $limit;
    private $start;

    public function __construct() {
        parent::__construct();
        $this->limit = 0;
        $this->start = 0;
        $sql = "select
                   invtid,
                   descr,
                   classid,
                   stkitem,
                   substring(invtid,1,1) as wdtype,
                   user1 as woodid,
                   i.user2 as trtid,
                   c.bf,
                   c.sf,
                   c.bndl,
                   c.cuft,
                   c.ea,
                   p.chemcat,
                   p.chemcatsub

                from invntory i, htinconv c, htinprod p
                where   /**/ and i.invtid=c.invtid(+) and i.classid=p.prodcat(+) order by i.invtid";
        $this->genericSql = $sql;
        $this->openStmtStr = str_replace("/**/", " 1=1  ", $sql);
        $this->searchStmtStr = str_replace("/**/", " i.invtid= ?", $sql);
        $this->allStmtStr = str_replace("/**/", " 1=1 ", $sql);
        $this->updStmt = "";
        $this->insStmt = "";
        $this->searchStmt = $this->pdoDb->prepare($this->searchStmtStr);
        $this->allStmt = $this->pdoDb->prepare($this->allStmtStr);
        $this->openStmt = $this->pdoDb->prepare($this->openStmtStr);
    }

    public function constructDataset() {
        $list = array();
        $count = 0;
        foreach ($this as $obj) {
            if (!isset($obj->invtid)) {
                continue;
            }
            if ($this->limit != 0 && $count >= ($this->limit + $this->start)) {
                break;
            }
            if ($count >= $this->start) {
                $row = array();
                foreach ($this->getFieldList() as $field) {
                    $row[$field] = $obj->$field;
                }
                $list[] = $row;
            }
            $count++;
        }
        return $list;
    }

    public function getCount() {
        $sql = "Select count(*) as items from invntory ";
        $stmt = $this->pdoDb->prepare($sql);
        $this->fieldList = array("items");
        $this->runQuery($stmt, " ");
        $ds = $this->constructDataset();
        return $ds;
    }

    protected function buildOrderSql($params) {
        $orderClause = " i.invtid in
            (select distinct invtid from sodet where ordnbr='".
            $params['ordnbr'].
            "') ";
        $sql = str_replace("/**/", $orderClause, $this->genericSql);
        return $sql;
    }

    protected function buildPurchaseOrderSql($params) {
        $orderClause = " i.invtid in
            (select distinct invtid from purdtl where ponbr='".
            $params['ponbr'].
            "') ";
        $sql = str_replace("/**/", $orderClause, $this->genericSql);
        return $sql;
    }

    protected function buildOpenPOSql() {
        $orderClause = " i.invtid in
            (select  d.invtid from purchord h, purdtl d ".
            "where openpo='Y' and h.status = 'P' and h.ponbr=d.ponbr ".
            ") ";
        $sql = str_replace("/**/", $orderClause, $this->genericSql);
        return $sql;
    }

    protected function buildOpenSOSql() {
        $orderClause = " i.invtid in
            (select invtid from salesord h, sodet d
             where openso='Y' and h.status <> 'C' and h.ordnbr=d.ordnbr and
             h.ordtype=d.ordtype and h.bocntr=d.bocntr) ";
        $sql = str_replace("/**/", $orderClause, $this->genericSql);
        return $sql;
    }

    protected function buildVMIItems() {
        $orderClause = " i.invtid in
            (select invtid from location
             where whseloc like 'VM%') ";
        $sql = str_replace("/**/", $orderClause, $this->genericSql);
        return $sql;
    }

    public function getWhereSql($params = "") {
        $dispatchArray = array(
            "ordnbr"=>"buildOrderSql",
            "ponbr"=>"buildPurchaseOrderSql",
            "openpos"=>"buildOpenPOSql",
            "opensos"=>"buildOpenSOSql",
            "vmiitems"=>"buildVMIItems",
        );
        foreach($dispatchArray as $parm => $func) {
            if (isset($params[$parm])) {
                $sql = $this->$func($params);
                return $sql;
            }
        }
        SqlBuilder::checkNull($params, "Criteria Fields");
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"invtid",
                "column"=>"i.invtid",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"descr",
                "column"=>"i.descr",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"classid",
                "column"=>"i.classid",
                "op"=>"EQ"
                ),
                array(
                "field"=>"wdtype",
                "column"=>"i.invtid",
                "op"=>"LIKE%"
                ),
                array(
                "field"=>"woodid",
                "column"=>" substring(i.invtid,1,1)+substring(invtid,5,99)  ",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"trtid",
                "column"=>"i.user2",
                "op"=>"LIKE"
                ),
                array(
                "field"=>"stkitem",
                "column"=>"i.stkitem",
                "op"=>"EQ"
                ),
            )
        );
        // Check invtid for array
        $tmpAr = "";
        if (isset($params['invtid']) && is_array($params['invtid'])) {
            $tmpAr = $params['invtid'];
            unset($params['invtid']);
        }
        $where = SqlBuilder::buildSql($params, $map);
        if (is_array($tmpAr)) {
            $tmpString = "";
            foreach($tmpAr as $item) {
                if ($tmpString != "") {
                    $tmpString .= ", ";
                }
                $tmpString .= "'$item'";
            }
            if ($where != "")  {
                $where = "and $where";
            }
            $where = " i.invtid in ($tmpString)  $where";
        }
        $sql = str_replace("/**/", $where, $this->genericSql);
        return $sql;
    }

    public function update($parms) {
        if (!is_object($parms)) {
            throw new Exception("This function must inclue an array!");
        }
        if (!isset($parms->invtid)) {
            throw new Exception("You must include an invtid with this method!");
        }
        $updId = $parms->invtid;
        $updList = "";
        foreach ($parms as $prop => $val) {
            if ($prop != "invtid") {
                if ($updList != "") {
                    $updList = ", ";
                }
                switch ($prop) {
                    case "descr":
                        $updList .= " descr = '" . str_replace("'", "''", $val) . "'";
                        break;
                    default:
                        break;
                }
            } // don't update invtid
        } // foreach property
        if ($updList == "") {
            throw new Exception("Nothing to do!");
        }
        $sql = "update invntory set $updList where invtid='$updId'";
        $stmt = $this->pdoDb->prepare($sql);
        $stmt->execute();
        return "Success";
    }

    /** @Id @Column */
    public $invtid;

    /** @Column */
    public $descr;

    /** @Column */
    public $classid;

    /** @Column */
    public $woodid;

    /** @Column */
    public $trtid;

    /** @Column */
    public $wdtype;

    /** @Column */
    public $stkitem;

    /** @Column */
    public $bf;

    /** @Column */
    public $sf;

    /** @Column */
    public $ea;

    /** @Column */
    public $bndl;

    /** @Column */
    public $cuft;

    /** @Column */
    public $chemcat;

    /** @Column */
    public $chemcatsub;
}
