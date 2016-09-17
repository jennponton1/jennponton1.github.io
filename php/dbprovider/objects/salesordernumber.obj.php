<?php


class Salesordernumber extends DBOdbcBase {
    public function __construct() {

        parent::__construct();
        $this->pdoDb->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $this->openSql = "select * From oesetup";
        $this->openStmt = $this->pdoDb->prepare($this->openSql);
    }

    public function findOpen() {
        $this->runQuery($this->openStmt, " ");
        $rs = $this->constructDataset();
        return $rs;
    }

    public function constructDataset() {
        $ds = array();
        $count = 0;
        foreach($this->currentStmt as $row) {
            $obj = new stdClass();
            $obj->ordnbr = $row['lastordnbr'];
            $ds[$count] = $obj;
        }
        return $ds;
    }

    public function findWhere($parms) {
        // Check Parms for ordnbr & Next -- if so, go to insert;
        if (isset($parms['ordnbr']) && strtoupper($parms['ordnbr'])=='NEXT') {
            $item = $this->insert(new stdClass());
            return $item;
        }

        $map = SqlBuilder::createMap();
        SqlBuilder::addMapItem(
            $map,
            array(
                array("field"=>"ordnbr",
                    "column"=>"lastordnbr",
                    "op"=>"LIKE"
                )
            )
        );
        $sql = SqlBuilder::buildSql($parms, $map);
        $sql = $this->openSql . " where $sql";
        return $sql;
    }

    public function insert() {
        // actually, just getting a new number
        // At each step check for all ok -- probably need to set this up to fail on
        // ANYTHING
        $this->pdoDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdoDb->exec("START TRANSACTION");
        // read the table
        $rs = $this->findOpen();
        if (count($rs) < 1) {
            throw new Exception("Failed to read order #");
        }
        $ordnbr = (double) $rs[0]->ordnbr;
        if ($ordnbr <= 0) {
            throw new Exception("Failed to read order #");
        }
        $ordnbr++;
        $sql = "update oesetup set lastordnbr = '$ordnbr' ";
        $this->pdoDb->exec($sql);
        $sql = "commit ";
        $this->pdoDb->exec($sql);

        $rs[0]->ordnbr = $ordnbr;
        return $rs;
    }



    /** @Id @Column */
    public $ordnbr;


}
