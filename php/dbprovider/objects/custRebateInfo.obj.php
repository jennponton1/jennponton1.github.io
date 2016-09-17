<?php

class CustRebateInfo extends dbDoctrineBase {

    public function __construct() {
        parent::__construct();
    }

    public function findWhere($critAr = "") {
        try {
            // get Customer ID
            $custid = $critAr['custid'];
            if ($custid == "") {
                throw new Exception("You must include a customer id for this routine");
            }
            $query = "select
                s.custid,
                r.year,
                r.basegoal,
                r.period,
                 sum(bfship) as totship,
             sum(bfship) / r.basegoal * 100 as pct
             From rebate_goals r left outer join  slssum s on (
              r.custid = s.custid and
              perpost between case period
              when 1 then concat( cast( year-1  as character), '10')
              when 2 then concat( cast( year  as character), '01')
              when 3 then concat( cast( year  as character), '04')
              when 4 then concat( cast( year  as character), '07')
             end  and
             case period
              when 1 then concat( cast( year-1  as character), '12')
              when 2 then concat( cast( year  as character), '03')
              when 3 then concat( cast( year  as character), '06')
              when 4 then concat( cast( year  as character), '09')
             end and
              prodcat in (
              select chemcat from rebate_prods  x
                where x.planid=r.planid
             ))
             where

               r.custid='$custid' and r.planid='FRT' and
              ( (year=year(curdate())  and period <=  ceil(  month(curdate()) / 3 ) )  or
               (year=year(  date_sub(curdate(),interval 1 year))  and period >  ceil(  month(curdate()) / 3 )      )
              )


             group by r.year, r.period
             order by r.year desc, r.period desc
             ";

            $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
            $rsm->addScalarResult("custid", "custid");
            $rsm->addScalarResult("year", "year");
            $rsm->addScalarResult("period", "period");
            $rsm->addScalarResult("basegoal", "basegoal");
            $rsm->addScalarResult("totship", "totship");
            $rsm->addScalarResult("pct", "pct");
            $stmt = $this->eMgr->createNativeQuery($query, $rsm);
            $rs = $stmt->getResult();
            return $rs;
        } catch (Exception $e) {
            throw new Exception("EXCEPTION!!! : " . $e->getMessage());
        }
    }

}
