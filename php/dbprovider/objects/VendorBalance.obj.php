<?php

require_once "basetable.class.php";

class Vendorbalance {
    protected $dsn;
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );

    protected $fieldList = array(
        'vendid',
        'refnbr',
        'doctype',
        'docdate',
        'lastname',
        'invcnbr',
        'duedate',
        'status',
        'paydate',
        'docbalance',
        'invcdate',
        'opendoc',
        'batnbr',
        'perpost',
        'origamt',

    );

    public function __construct() {
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
                   a.paydate, a.docbal * (a.doctype='AD' ?? -1 :: 1) as docbalance,
                   a.origamt
                From apdoc a, vendor v
                where
                   /**/
                   a.vendid=v.vendid(+)
                order by a.vendid";
        //  and a.docbal <> 0 and a.rlsed = 'Y'
        $this->genericSql = $sql;
        $this->openSql = str_replace("/**/", "", $sql);
    }

    public function constructDataset($stmt = null) {
        if ($stmt == null) {
            $stmt = $this;
        }
        $ret = array();
        $dtl = array();
        $last = "";
        $lastName = "";
        foreach ($stmt as $item) {
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
            $dtlItem = array();
            foreach($this->fieldList as $field) {
                $dtlItem[$field] = $item->$field;
            }
            $dtl[] = (object) $dtlItem;
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

    public function findOpen() {
        throw new Exception("Find Open does not work for this object");
    }

    public function findWhere($params) {
        $apdoc = false;
        if (isset($params['dsn'])) {
            $dsnParm = strtoupper($params['dsn']);
            $connDsn = $this->dsnMap[$dsnParm];
            if ($connDsn == "") {
                throw new Exception("You must pass a DSN to this object");
            }
            unset($params['dsn']);
            $apdoc =new GenericPVSWTable('vendor', $connDsn);
        }
        else {
            throw new Exception("You must pass a DSN to fix this function");
        }
        if ($apdoc == false) {
            throw new Exception("Failed getting DSN and connection ".var_export($connDsn, true));
        }
        $where = $this->getWhereSql($params);
        $stmt = $apdoc->directQuery($where);
        return $this->constructDataset($stmt);
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
                "field"=>"doctype",
                "column"=>"a.doctype"
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
                "column"=>"a.invcnbr",
                "op"=>"LIKE",
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

}
