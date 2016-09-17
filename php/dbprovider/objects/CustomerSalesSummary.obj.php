<?php

require_once "basetable.class.php";

class CustomerSalesSummary {

    protected function failNoCustomer() {
        throw new Exception("You must pass a customer ID to this object");

    }
    public function findOpen() {
        $this->failNoCustomer();
    }

    protected function getDefaultStart() {
        require_once "dbprovider/objects/acctperiods.obj.php";
        $acct = new AcctPeriods();
        $startDate = Date("Y-m-d", strtotime("-6 months"));
        $acctDS = $acct->findWhere(array("date"=>$startDate));
        if (count($acctDS) == 0) {
            throw new Exception("No date period found!!!");
        }
        $perStart = $acctDS[0]->pernbr;
        return $perStart;
    }

    protected function getDefaultEnd() {
        require_once "dbprovider/objects/acctperiods.obj.php";
        $acct = new AcctPeriods();
        $acctDS = $acct->findOpen();
        if (count($acctDS) == 0) {
            throw new Exception("No date period found!!!");
        }
        $perEnd = $acctDS[0]->pernbr;
        return $perEnd;
    }

    public function findWhere($params) {
        $criteria = (array) $params;
        if (!isset($criteria['custid'])) {
            $this->failNoCustomer();
        }
        $custid = $criteria['custid'];
        if (!isset($criteria['begper'])) {
            $begPer = $this->getDefaultStart();
        }
        else {
            $begPer = $criteria['begper'];
        }
        if (!isset($criteria['endper'])) {
            $endPer = $this->getDefaultEnd();
        }
        else {
            $endPer = $criteria['endper'];
        }
        // get An Array of periods
        $perArray = array();
        $count = 0;
        $prodCat = "";
        $prodField = "";
        $prodWhere = "";
        if (isset($criteria['prodcat'])) {
            $prodCat = $criteria['prodcat'];
            $prodField = ", prodcat";
            $prodWhere = " and prodcat = '$prodCat' ";
        }
        for ($ndx = $begPer; $ndx <= $endPer;) {
            $perArray[$ndx] = (object) array("custid"=>"$custid","bf"=>0,"prodcat"=>"$prodCat","perpost"=>"$ndx");
            $year = substr($ndx, 0, 4);
            $month = substr($ndx, 4, 2);
            switch ($month) {
                case '12':
                    $month = '01';
                    $year++;
                    break;
                case '11':
                case '10':
                    $month++;
                    break;
                default:
                    $month = $month*1.0 + 1;
                    $month = "0$month";
            }
            $count++;
            if ($count > 100) {
                throw new Exception("Failing on period increment $ndx $count ".var_export($perArray, true));
            }
            $ndx = $year.$month;
        }
        $tbl = new GenericMySqlTable();
        $sql = "Select custid $prodField,  perpost, sum(bfship) as sumTotal From slssum
            where custid = '$custid' and perpost between '$begPer' and '$endPer' $prodWhere
            group by custid $prodField, perpost
            ";
        $stmt = $tbl->directQuery($sql);
        $retAr = array();
        foreach($stmt as $row) {
            $obj = $perArray[$row->perpost];
            $obj->custid = $row->custid;
            $obj->bf = $row->sumtotal;
            $obj->prodcat= $prodCat;
            $obj->perpost = $row->perpost;
        }
        ksort($perArray);
        return array_values($perArray);
    }
}
