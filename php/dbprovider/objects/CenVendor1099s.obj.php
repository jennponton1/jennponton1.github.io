<?php

class CenVendor1099s extends dbodbcBase {

    public function __construct($dsn = "") {
        parent::__construct($dsn);
        $this->genericSql = "select a.vendid, v.lastname, v.addrid,
                                v.Vend1099, dfltbox, tin,

                                d.addr1,
                                d.addr2,
                                d.city,
                                d.state,
                                d.zip,
                                 a.status, sum(a.origamt) as totalpmts
                               From apdoc a, vendor v, address d
                               where a.doctype in ('AC', 'CK','HC','ZC') and
                               a.paydate is null and
                               a.docdate between '01/01//*YR*/' and '12/31//*YR*/' and
                               a.status <> 'V' and a.vendid=v.vendid(+)
                                and v.vend1099 = 'Y'
                                and v.addrid=d.addrid(+)
                               group by a.vendid, a.status,
                                        lastname, addrid, vend1099, dfltbox, tin,
                                        addr1,addr2, city, state, zip
                               order by a.status, a.vendid
            ";
        /** Determine Year for report --
          Assume that if we're in January through March, that we want 1099s for last year
          otherwise, get them for the current year
         */
        $year = date("Y");
        $month = date("m");
        if ($month <= 3) {
            $year = $year - 1;
        }
        $this->openSql = str_replace("/*YR*/", $year, $this->genericSql);
        $this->openStmt = $this->pdoDb->prepare($this->openSql);
    }

    public function constructDataset($stmt) {
        $ret = array();
        foreach ($stmt as $row) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function findOpen() {
        $ds = $this->runQuery($this->openStmt, " ");
        $ret = $this->constructDataset($ds);
        return $ret;
    }

    public function findWhere($parms = "") {
        if (!is_array($parms)) {
            throw new Exception("You must pass an array to the findWhere method");
        }
        // The only thing we can deal with on this is the year...
        $sql = $this->openSql;
        foreach ($parms as $key => $val) {
            switch ($key) {
                case "year":
                    $sql = str_replace("/*YR*/", $val, $this->genericSql);
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
    public $vendid;

    /** @Column */
    public $lastname;

    /** @Column */
    public $addrid;
}
