<?php

require_once "basetable.class.php";

class KilnStatus {

    protected $dbConnect;
    protected $baseSql;

    public function __construct() {
        $this->dbConnect = new GenericPVSWTable("htklnhdr");
        $this->loadedSql = "
            select
                h.siteid, h.dt, h.kiln, h.tm, h.chgid,
                d.invtid, d.prodcat, d.whseloc, d.custid, d.ordnbr,
                sum(d.qty) as loadedqty
            from htklnhdr h, htklndet d
            where h.siteid like '%/*SITE*/%' and
             h.dt >= (curdate-21) and
             h.siteid=d.siteid and
             h.chgid=d.chgid
             group by h.siteid, h.dt, h.kiln, h.tm, h.chgid,
                d.invtid, d.prodcat, d.whseloc, d.custid, d.ordnbr
            ";
        $this->unloadedSql = "
            select
                h.siteid, h.dt, h.kiln, h.tm, h.chgid,
                d.invtid,d.ordnbr,
                sum(d.qty) as unloadedqty
            from htklnhdr h, htklnunl d
            where h.siteid like '%/*SITE*/%' and
             h.dt >= (curdate-21) and
             h.siteid=d.siteid and
             h.chgid=d.chgid
             group by h.siteid, h.dt, h.kiln, h.tm, h.chgid,
                d.invtid,d.ordnbr
            ";

    }

    protected function buildKey($row) {
        $key = $row->siteid.$row->chgid.$row->ordnbr;
        return $key;
    }

    protected function checkCriteria($row, $criteria) {
        $limitVar = array(
            "invtid",
            "ordnbr"
        );
        foreach($limitVar as $var) {
            if (isset($criteria[$var]) && $criteria[$var] != $row->$var) {
                return false;
            }
        }
        return true;
    }

    protected function combineDatasets($loadedDS, $unloadedDS, $critAr) {
        $combDS = array();

        foreach($loadedDS as $loadedRow) {
            $key = $this->buildKey($loadedRow);
            if (!$this->checkCriteria($loadedRow, $critAr)) {
                continue;
            }
            if (!isset($combDS[$key])) {
                $combDS[$key] = array();
            }
            if (isset($combDS[$key][$loadedRow->invtid])) {
                $combDS[$key][$loadedRow->invtid]->loaded += $loadedRow->loadedqty;
                $combDS[$key][$loadedRow->invtid]->unloadedqty += 0;
                $combDS[$key][$loadedRow->invtid]->remainder += $loadedRow->loadedqty;
            }
            else {
                $combDS[$key][$loadedRow->invtid] = new stdClass();
                $combDS[$key][$loadedRow->invtid]->siteid = $loadedRow->siteid;
                $combDS[$key][$loadedRow->invtid]->chgid = $loadedRow->chgid;
                $combDS[$key][$loadedRow->invtid]->kiln = $loadedRow->kiln;
                $combDS[$key][$loadedRow->invtid]->dt = $loadedRow->dt;
                $combDS[$key][$loadedRow->invtid]->invtid = $loadedRow->invtid;
                $combDS[$key][$loadedRow->invtid]->whseloc = $loadedRow->whseloc;
                $combDS[$key][$loadedRow->invtid]->custid = $loadedRow->custid;
                $combDS[$key][$loadedRow->invtid]->ordnbr = $loadedRow->ordnbr;
                $combDS[$key][$loadedRow->invtid]->loaded = $loadedRow->loadedqty;
                $combDS[$key][$loadedRow->invtid]->unloadedqty = 0;
                $combDS[$key][$loadedRow->invtid]->remainder = $loadedRow->loadedqty;
            }
        }
        foreach($unloadedDS as $unloadedRow) {
            if (!$this->checkCriteria($unloadedRow, $critAr)) {
                continue;
            }
            $key = $this->buildKey($unloadedRow);
            if (!isset($combDS[$key])) {
                continue;
            }
            $combDS[$key][$unloadedRow->invtid]->unloadedqty += $unloadedRow->unloadedqty;
            $combDS[$key][$unloadedRow->invtid]->remainder -= $unloadedRow->unloadedqty;
        }
        ksort($combDS);
        $retAr = array_reduce(
            $combDS,
            function ($ret, $el) {
                foreach($el as $item) {
                    if ($item->remainder != 0) {
                        $ret[] = $item;
                    }
                }
                return $ret;
            },
            array()
        );
        return $retAr;
    }


    protected function constructDataset($stmt) {
        $retAr = array();
        foreach($stmt as $row) {
            //if ($row->remaining != 0) {
                $retAr[] =$row;
            //}
        }
        return $retAr;
    }

    public function findOpen() {
        // Find for all sites:
        $sql = str_replace("/*SITE*/", "%", $this->loadedSql);
        $loadedStmt = $this->dbConnect->directQuery($sql);
        $unloadedStmt = $this->dbConnect->directQuery(str_replace("/*SITE*/", "%", $this->unloadedSql));
        return $this->combineDatasets($loadedStmt, $unloadedStmt, array());
    }

    public function findWhere($parms) {
        $parms = (array) $parms;
        $siteid = $parms['siteid'];
        if ($siteid == "") {
            throw new Exception("You must pass a siteid to this routine");
        }
        $sql = str_replace("/*SITE*/", "$siteid", $this->loadedSql);
        $loadedStmt = $this->dbConnect->directQuery($sql);
        $unloadedStmt = $this->dbConnect->directQuery(str_replace("/*SITE*/", "$siteid", $this->unloadedSql));
        return $this->combineDatasets($loadedStmt, $unloadedStmt, $parms);
        //return $this->constructDataset($loadedStmt);
    }

}
