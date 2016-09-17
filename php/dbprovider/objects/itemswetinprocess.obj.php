<?php

class Itemswetinprocess extends dbodbcBase {

    public function __construct() {
        parent::__construct();
        $sqlGetOrderItems = "select
                                h.ordnbr, d.siteid, d.invtid,  d.descr, l.whseloc  , l.qtyonhand as pcs , h.custid
                              from salesord h, sodet d, htlocdet l
                               where  h.openso='Y' and h.ordnbr=d.ordnbr and
                               h.ordtype=d.ordtype and
                               h.bocntr=d.bocntr and d.invtid like '_%' and
                               /*SITE*/
                               not ( invtid+siteid in (select invtid+siteid from htstklvl)  and
                               whseloc='STK' ) and
                               d.invtid=l.invtid and 
                               d.siteid=l.siteid and d.ordnbr=l.ordnbr and 
                               l.whseloc in ('WIP','TSW') and
                               l.qtyonhand <> 0
                              order by ordnbr, invtid";
        $sqlGetVMI = "select
                               'VMI' as ordnbr,
                               siteid,
                               invtid,
                               i.descr,
                               whseloc,
                               qtyonhand as pcs,
                               '00' as custid
                              from location l, invntory i
                              where
                               /*SITE*/
                               qtyonhand <> 0 and
                               whseloc = 'VMW' and
                               l.invtid=i.invtid(+)";
        $sqlGetBCItems = "select
                                'STOCK' as ordnbr,
                                siteid,
                                invtid,
                                i.descr,
                               whseloc,
                               qtyonhand as pcs,
                               '00' as custid
                              from location l, invntory i
                              where
                               /*SITE*/
                               qtyonhand <> 0 and
                               l.invtid+siteid in 
                                 (select invtid+siteid from htstklvl) and
                               whseloc='WIP' and
                               l.invtid=i.invtid(+)";
        $this->genericSql = " $sqlGetOrderItems
                              UNION
                              $sqlGetVMI
                              UNION
                              $sqlGetBCItems ";
        $this->openSql = str_replace("/*SITE*/", "", $this->genericSql);
        $this->openSql = str_replace("\n", " ", $this->openSql);
        while (strpos($this->openSql, "  ") !== false) {
            $this->openSql = str_replace("  ", " ", $this->openSql);
        }
        $this->openStmt = $this->pdoDb->prepare($this->openSql);
    }

    public function constructDataset($stmt) {
        $ret = array();
        if ($stmt === null) {
            $stmt = $this->currentStmt;
        }
        foreach ($stmt as $row) {
            $newRow = array();
            $newRow['ordNbr'] =$row['ordnbr'];
            $newRow['siteId'] =$row['siteid'];
            $newRow['invtId'] =$row['invtid'];
            $newRow['descr'] =$row['descr'];
            $newRow['whseLoc'] =$row['whseloc'];
            $newRow['qty'] =$row['pcs'];
            $newRow['custId'] =$row['custid'];
            $ret[] = $newRow;
        }
        return $ret;
    }

    public function findWhere($parms = "") {
        if (!is_array($parms)) {
            throw new Exception("You must pass an array to the findWhere method");
        }
        // The only thing we can deal with on this is the siteid...
        $sql = $this->openSql;
        foreach ($parms as $key => $val) {
            switch ($key) {
                case "siteid":
                    $sql = str_replace("/*SITE*/", "siteid = '$val' and ", $this->genericSql);
                    break;
                default:
                    throw new Exception("Not implemented yet $key");
            }
        }
        $stmt = $this->pdoDb->prepare($sql);
        $ds = $this->runQuery($stmt, " ");
        $ret = $this->constructDataset($ds);
        return $ret;
    }

    /** @Id @Column */
    public $invtid;

    /** @Id @Column */
    public $siteid;

}
