<?php

require_once "basetable.class.php";
require_once "acctperiods.obj.php";

class MSASumm {
    protected $curPeriod;
    protected $cyStart;
    protected $lastPeriod;
    protected $pyStart;

    public function __construct() {
        $acct = new AcctPeriods();
        $tmp =  $acct->findOpen();
        $this->curPeriod = $tmp[0]->pernbr;
        $this->cyStart = $this->calcOneYearAgo($this->calcNextMonth($this->curPeriod));
        $this->lastPeriod = $this->calcOneYearAgo($this->curPeriod);
        $this->pyStart = $this->calcOneYearAgo($this->calcNextMonth($this->lastPeriod));
    }

    protected function calcNextMonth($per) {
        $year = substr($per, 0, 4);
        $month = substr($per, 4);
        $month++;
        if ($month > 12) {
            $year++;
            $month = 1;
        }
        if ($month < 10) {
            $month = "0$month";
        }
        $retPer = $year.$month;
        return $retPer;
    }

    protected function calcOneYearAgo($per) {
        $year = substr($per, 0, 4);
        $year--;
        $retPer = $year.substr($per, 4, 2);
        return $retPer;
    }

    public function findOpen() {
        // what is the current period
        $msaTable = new GenericMySqlTable("stock_dist");
        $sql = "select  d.area,
            sum(if(s.perpost between '$this->cyStart' and '$this->curPeriod', (bfship), 0)) as cy,
            sum(if(s.perpost between '$this->pyStart' and '$this->lastPeriod', bfship, 0))  as py,
            sum(if(s.perpost between '$this->cyStart' and '$this->curPeriod', (bfship), 0))-
            sum(if(s.perpost between '$this->pyStart' and '$this->lastPeriod', bfship, 0))  as var,
            (
                sum(if(s.perpost between '$this->cyStart' and '$this->curPeriod', (bfship), 0)) -
                sum(if(s.perpost between '$this->pyStart' and '$this->lastPeriod', bfship, 0)) ) /
            sum(if(s.perpost between '$this->pyStart' and '$this->lastPeriod', bfship, 0))*100  as varpct

            From slsdet s, stock_dist d
           where s.perpost between '$this->pyStart' and '$this->curPeriod' and
           s.custid=d.custid and
           s.prodcat in ('PGD','XFX')
           group by d.area";
        $stmt = $msaTable->directQuery($sql, array());
        $det = array();
        foreach($stmt as $row) {
            $det[] = $row;
        }
        return $det;
    }

    public function findWhere($critAr) {
        // this only works if an MSA was included
        $critAr = (array) $critAr;
        if (!isset($critAr['msa'])) {
            throw new Exception("You MUST specify an MSA");
        }
        $sdist = new GenericMySqlTable("stock_dist");
        $sql = "
            select
                d.area,
                upper(s.custid) as custid,
                s.perpost,
                if(s.perpost between '$this->cyStart' and '$this->curPeriod', 'CY', 'PY') as year,
                sum(bfship) as bf
            From slsdet s, stock_dist d
           where d.area = '".$critAr['msa']."' and s.perpost between '$this->pyStart' and '$this->curPeriod' and
           s.custid=d.custid and
           s.prodcat in ('PGD','XFX')
           group by d.area, upper(s.custid), perpost";
        $stmt = $sdist->directQuery($sql, array());
        $det = array();
        $custList = array();
        foreach($stmt as $row) {
            $det[$row->custid.$row->perpost] = $row;
            if (!isset($custList[$row->custid])) {
                $custList[$row->custid] = $row->area;
            }
        }
        // before returning, check for missing periods for each customer..
        foreach($custList as $custid => $area) {
            for($per = $this->pyStart; $per <= $this->curPeriod; $per = $this->calcNextMonth($per)) {
                if (!isset($det[$custid.$per])) {
                    $det[$custid.$per] = (object) array(
                        "area"=>$area,
                        "custid"=>$custid,
                        "perpost"=>$per,
                        "year"=> $per <= $this->lastPeriod ? "PY" : "CY",
                        "bf"=> "0"
                    );
                }
            }
        }
        ksort($det);
        return array_values($det);
        //throw new Exception("Not yet ready $sql");
    }
}
