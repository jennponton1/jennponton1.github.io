<?php

require_once "basetable.class.php";

class Vendorbalance2 { //extends dbodbcBase {

    public function __construct() {
        parent::__construct();
        $sql = "select
                   a.vendid,
                   v.lastname,
                   a.doctype,
                   a.refnbr,
                   a.batnbr,
                   a.perpost,
                   a.docdate,
                   a.opendoc,
                   a.status,
                   a.invcnbr, a.duedate,
                   a.invcdate,
                   a.paydate, a.docbal * (a.doctype='AD' ?? -1 :: 1) as docbalance
                From apdoc a, vendor v
                where
                   /**/
                   a.vendid=v.vendid(+) 
                order by a.vendid";
        //  and a.docbal <> 0 and a.rlsed = 'Y'
        $this->genericSql = $sql;
        $this->openSql = str_replace("/**/", "", $sql);
        $this->openStmt = $this->pdoDb->prepare($this->openSql);
    }

    public function constructDataset() {
        $ret = array();
        $dtl = array();
        $last = "";
        $lastName = "";
        foreach ($this as $item) {
            if ($last != $item->vendid) {
                if ($last != "") {
                    $retObj = new stdClass();
                    $retObj->vendid = $last;
                    $retObj->detail = $dtl;
                    $retObj->lastname = $lastName;
                    $ret[] = $retObj;
                    $dtl = array();
                }
            }
            $dtl[] = $item;
            $last = $item->vendid;
            $lastName = $item->lastname;
        }
        if ($last != "") {
            $retObj = new stdClass();
            $retObj->vendid = $last;
            $retObj->detail = $dtl;
            $retObj->lastname = $lastName;
            $ret[] = $retObj;
            $dtl = array();
        }
        return $ret;
    }
    
    public function getWhereSql($parms) {
        
        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                "field"=>"vendid",
                "column"=>"a.vendid"
                ),
                array(
                "field"=>"refnbr",
                "column"=>"a.refnbr"
                ),
                array(
                "field"=>"docbal",
                "column"=>"a.docbal"
                ),
                array(
                "field"=>"invcnbr",
                "column"=>"a.invcnbr"
                ),
                array(
                "field"=>"docdate",
                "column"=>"a.docdate",
                 "op"=>"GE"
                ),
                array(
                "field"=>"enddate",
                "column"=>"a.docdate",
                 "op"=>"LE"
                ),
                array(
                "field"=>"rlsed",
                "column"=>"a.rlsed"
                ),
                array(
                "field"=>"opendoc",
                "column"=>"a.opendoc"
                ),
                array(
                "field"=>"batnbr",
                "column"=>"a.batnbr"
                ),
                array(
                "field"=>"perpost",
                "column"=>"a.perpost"
                ),
            )
        );
        $parms = (array) $parms;
        if (!isset($parms['docbal'])) {
            //$parms['docbal'] = "0";
        }
        $where = SqlBuilder::buildSql($parms, $map);
        $sql = str_replace("/**/", $where." and ", $this->genericSql);
        return $sql;
    }

    /** @Id @Column */
    public $vendid;

    /** @Id @Column */
    public $refnbr;

    /** @Id @Column */
    public $doctype;

    /** @Column */
    public $docdate;

    /** @Column */
    public $lastname;

    /** @Column */
    public $invcnbr;

    /** @Column */
    public $duedate;

    /** @Column */
    public $status;

    /** @Column */
    public $paydate;

    /** @Column */
    public $docbalance;

    /** @Column */
    public $invcdate;

    /** @Column */
    public $opendoc;
    
    /** @Column */
    public $batnbr;
    
    /** @Column */
    public $perpost;
}
