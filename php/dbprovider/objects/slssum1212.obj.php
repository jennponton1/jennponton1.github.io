<?php

class PeriodAgg {

    public $lbr;
    public $ply;
    public $fsc;
    public $nonfsc;
    public $pgd;
    public $pgdfsc;
    public $pgdnonfsc;
    public $xfx;
    public $xfxfsc;
    public $xfxnonfsc;
    public $pres;
    public $presfsc;
    public $presnonfsc;
    public $raw;
    public $rawfsc;
    public $rawnonfsc;
    public $tot;
    public $totfsc;
    public $totnonfsc;
    public $period;
    public $calperiod;

    public function __construct($period = '') {
        $this->lbr = 0;
        $this->ply = 0;
        $this->fsc = 0;
        $this->nonfsc = 0;
        $this->pgd = 0;
        $this->pgdfsc = 0;
        $this->pgdnonfsc = 0;
        $this->xfx = 0;
        $this->xfxfsc = 0;
        $this->xfxnonfsc = 0;
        $this->pres = 0;
        $this->presfsc = 0;
        $this->presnonfsc = 0;
        $this->raw = 0;
        $this->rawfsc = 0;
        $this->rawnonfsc = 0;
        $this->tot = 0;
        $this->totfsc = 0;
        $this->totnonfsc = 0;
        $this->period = $period;
        $this->calperiod = calendarPeriod($period);
    }
}

function calendarPeriod($period) {
    $month = substr($period, 4, 2);
    $year = substr($period, 0, 4);
    // Convert to a calendar date
    // add 3 to the month;
    $month += 3;
    if ($month > 12) {
        $month = $month - 12;
        if ($month >= 1 && $month <= 3) {
            $year++;
        }
    }
    $ret = date("M Y", strtotime("$month/10/$year"));
    return $ret;
}

class Slssum1212 extends dbDoctrineBase {

    public function __construct() {
        parent::__construct();
    }

    public function findWhere($critAr = "") {
        try {
            $categoryMap = array(
                "PGD"=>"pgd",
                "XFX"=>"xfx",
                "RAW"=>"raw",
                "DRY"=>"raw",
                "ACQ"=>"pres",
                "MCQ"=>"pres",
                "CCAW"=>"pres",
                "CCAK"=>"pres",
                "COP8"=>"pres",
                "CUNA"=>"pres",
            );
            // get Customer ID
            $custid = $critAr['custid'];
            SqlBuilder::checkNull($custid, "Customer Id");
            //  get current accounting month
            require_once "dbprovider/dbprovider.inc.php";
            $dbTmp = new DbProvider();
            $dataSet = $dbTmp->findOpen("acctperiods");
            SqlBuilder::checkNull($dataSet->data, "AcctPeriods Data");
            $pernbr = $dataSet->data[0]->pernbr;
            SqlBuilder::checkNull($pernbr, "Period Number");
            // From this determine our 24 months
            $perNdxArray = array();
            $periodArray = array();
            $year = substr($pernbr, 0, 4);
            $month = substr($pernbr, 4, 2);
            $resultSet = array();
            for ($i = 1; $i <= 24; $i++) {
                $monStr = str_repeat("0", max(0, 2 - strlen($month))) . $month;
                $period = new stdClass();
                $period->period = "$year$monStr";
                $periodArray[24 - $i] = $period;
                $perNdxArray[$period->period] = 24 - $i;
                $resultSet[24 - $i] = new PeriodAgg($period->period);
                $month--;
                if ($month == 0) {
                    $month = 12;
                    $year--;
                }
            }
            ksort($perNdxArray);
            ksort($resultSet);
            // Now query data for the given customer between the specified dates
            $query = "select s.perpost, s.prodcat,
                      if( i.descr like '%FSC%','FSC','') as fsc,
                      sum(s.bfship) as bftot
                      from Slssum s, Invent i
                      where s.custid = '$custid' and
                      s.perpost between '" . $periodArray[0]->period . "' and '" . $periodArray[23]->period . "'" .
                    " and s.invtid=i.invtId
                       group by s.perpost, s.prodcat, if( i.descr like '%FSC%','FSC','') ";
            $rsm = new Doctrine\ORM\Query\ResultSetMapping();
            $rsm->addScalarResult("perpost", "perpost");
            $rsm->addScalarResult("prodcat", "prodcat");
            $rsm->addScalarResult("fsc", "fsc");
            $rsm->addScalarResult("bftot", "bftot");
            $nqSmt = $this->eMgr->createNativeQuery($query, $rsm);
            $slsRes = $nqSmt->getArrayResult();
            foreach ($slsRes as $row) {
                $ndx = $perNdxArray[$row['perpost']];
                $obj = $resultSet[$ndx];
                $bfamt = $row['bftot'];
                $obj->tot += $bfamt;
                $isFSC = false;
                $fscVarStr = "nonfsc";
                if ($row['fsc'] == 'FSC') {
                    $isFSC = true;
                    $fscVarStr = "fsc";
                }
                $obj->$fscVarStr += $bfamt;
                $fldName = "tot$fscVarStr";
                $obj->$fldName += $bfamt;
                $prod = $row['prodcat'];
                if (isset($categoryMap[$prod])) {
                    $fldName = $categoryMap[$prod];
                    $obj->$fldName += $bfamt;
                    $fldName = $fldName.$fscVarStr;
                    $obj->$fldName += $bfamt;
                }
                $resultSet[$ndx] = $obj;
            }
            $dataSet = new stdClass();
            $dataSet->totalset = $resultSet;
            $dataSet->cy = array_slice($resultSet, 12, 12);
            $dataSet->py = array_slice($resultSet, 0, 12);
            $dataSet->periods = $periodArray;
            return $dataSet;
        } catch (Exception $e) {
            echo "EXCEPTION!!! : " . $e->getMessage();
        }
    }

}
