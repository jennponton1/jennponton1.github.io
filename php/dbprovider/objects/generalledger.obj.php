<?php

require_once "basetable.class.php";

class GeneralLedger {
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );
    protected function getDSN(&$params) {
        $dsn = $this->dsnMap['CEN'];
        if (isset($params['dsn'])) {
            $dsn = $this->dsnMap[$params['dsn']];
            if ($dsn == "") {
                throw new Exception("Unknown DSN ".$params['dsn']);
            }
            unset($params['dsn']);
        }
        return $dsn;
    }

    public function findOpen() {
        throw new Exception("You must pass a DSN for this object");
    }

    public function findWhere($parms) {
        $parms = (array) $parms;
        $dsn = $this->getDSN($parms);
        $acctHist = new GenericPVSWTable("accthist", $dsn);
        $stmt = $acctHist->findWhere($parms);
        return $stmt->fetchAll();
    }

    public function bulkUpdate($keys, $parms) {
        $keys = (array) $keys;
        $tmpDsn = $keys['dsn'];
        $dsn = $this->getDSN($keys);
        $acctHist = new GenericPVSWTable("accthist", $dsn);
        $acctHist->update($keys, $parms);
        if ($tmpDsn != "") {
            $keys['dsn'] = $tmpDsn;
        }
        return $this->findWhere($keys);
    }

    public function closeMonth($parms) {
        $parms = (array) $parms;
        $dsn = $this->getDSN($parms);
        // Need the current period
        $setup = new GenericPVSWTable("glsetup", $dsn);
        $acctHist = new GenericPVSWTable("acchist", $dsn);
        $perData = $setup->findWhere(array("setupid"=>"GL"))->fetchAll();
        $period = $perData[0]->pernbr;
        if ($period == "") {
            throw new Exception("Couldn't get the current period");
        }
        $fiscyr = substr($period, 0, 4);
        $month = substr($period, 4, 2);
        if ($month == '12') {
            throw new Exception("We can't handle year end yet");
        }
        $nextMonth = $month + 1;
        if ($nextMonth < 10) {
            $nextMonth = "0$nextMonth";
        }
        unset($setup);
        $sql = "update accthist set ytdbal$nextMonth = ytdbal$month where fiscyr='$fiscyr' ";
        $acctHist->directQuery($sql);
        return array();
    }

}
