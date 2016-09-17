<?php
require_once "basetable.class.php";
class CustInfo extends dbDoctrineBase {

    public function __construct() {
        parent::__construct();
    }

    protected function getDefaultSite($custid) {
        $sls = new GenericMySqlTable("slsdet");
        $query = "select d.custid, d.siteid, count(distinct d.ordnbr), sum(bfship)
            from slsdet d, slshdr h
            where h.weekended >= date_sub(current_date(), interval 6 month) and
            h.custid like '$custid' and
            h.ordnbr=d.ordnbr and
            h.ordtype=d.ordtype and h.bocntr=d.bocntr and h.perclosed=d.perpost
            group by custid, siteid
            order by  custid, sum(bfship) desc
            limit 1";
        $reSet = $sls->directQuery($query, array())->fetchAll();
        $siteid = "";
        if (count($reSet) > 0) {
            $siteid = $reSet[0]->siteid;
        }
        return $siteid;
    }

    protected function getMSA($custid) {
        // get MSA
        $sdTable = new GenericMySqlTable("stock_dist");
        $res = $sdTable->findWhere(array("custid"=>$custid));
        $msa = "";
        if ($res) {
            $rec = $res->fetchObject();
            if ($rec) {
                $msa = $rec->area;
            }
        }
        return $msa;
    }

    public function findWhere($parms = "") {
        $custid = $parms['custid'];
        if ($custid == "") {
            throw new Exception("You must include a customer id");
        }
        // Get the customer Info using the Customer Object
        require_once dirname(__FILE__) . "/customer.obj.php";
        $custObj = new Customer();
        $custRS = $custObj->findWhere($parms);
        $cust = array();
        $acctTable = new GenericMySqlTable("accounts_cstm", "crm");
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult("lastdate", "lastdate");
        $rsm->addScalarResult("earlydate", "earlydate");
        $totBFrsm = new Doctrine\ORM\Query\ResultSetMapping();
        $totBFrsm->addScalarResult("totbf", "totbf");
        foreach($custRS as $custRec) {
            $custid = $custRec->custid;
            $query = "select max(orddate) as lastdate, min(orddate) as earlydate from dwh.soblhdr
                where custid='$custid'
                UNION
                select max(orddate),min(orddate) from dwh.ordhdr
                where custid='$custid'
                UNION
                select max(orddate),min(orddate) from dwh.slshdr
                where custid='$custid'

                order by 1 desc";
            $stmt = $this->eMgr->createNativeQuery($query, $rsm);
            $rs = $stmt->getResult();
            $lastOrd = "No orders found";
            $earlyDate = "No orders found";
            if (count($rs) >= 1) {
                $lastOrd = Date("m/d/Y", strtotime($rs[0]['lastdate']));
                $firstOrd = strtotime(Date("m/d/Y"));
                foreach ($rs as $row) {
                    if (strtotime($row['earlydate']) < $firstOrd) {
                        if (Date("m/d/Y", strtotime($row['earlydate'])) != '12/31/1969') {
                            $firstOrd = strtotime($row['earlydate']);
                        }
                    }
                }
                $earlyDate = Date("m/d/Y", $firstOrd);
            }
            $custAr = (array) $custRec;
            $custAr['lastord'] = $lastOrd;
            $custAr['earlyord'] = $earlyDate;

            $crmid = '';
            $crmData = $acctTable->findWhere(array("custid_c"=> $custid));
            $row = $crmData->fetch();
            if ($row) {
                $crmid = $row->id_c;
            }
            $custAr['crmid'] = $crmid;
            $totBFQry = $this->eMgr->createNativeQuery(
                "select sum(bf) as totbf from Sobldet where custid='$custid' ",
                $totBFrsm
            );
            $res = $totBFQry->getResult();
            $totBf = 0;
            if (count($res) >= 1)  {
                $totBf = $res[0]['totbf'];
                if ($totBf === null) {
                    $totBf = 0;
                }
            }
            $custAr['totopenbf'] = $totBf;
            $custAr['msa'] = $this->getMSA($custid);
            $custAr['primarysite'] = $this->getDefaultSite($custid);

            $cust[] = $custAr;
        }
        // Get Last Order Date
        return $cust;
    }

}
