<?php

class GenericSolModuleSetup {
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp",
        "DIL"=>"adodillard",
        "CONS"=>"adoconsol",
    );

    public function findOpen() {
        $this->findWhere(null);
    }

    protected function getDSN($criteria) {
        $criteria = (array) $criteria;
        $dsn = strtoupper($criteria['dsn']);
        if (!isset($this->dsnMap[$dsn])) {
            $dsn = null;
        }
        if ($criteria !== null && is_array($criteria) && $dsn != "") {
            return $this->dsnMap[$dsn];
        }
        throw new Exception("You must pass a DSN for this object! ".var_export($dsn, true));
    }

    public function findWhere($criteria = null, $module = 'XX') {
        $dsn = $this->getDSN($criteria);
        $table = new GenericPVSWTable($module."setup", $dsn);
        $rec = $table->findWhere(array("pernbr"=>"%"));
        $retAr = array();
        foreach($rec as $row) {
            $retAr[] = $row;
        }
        return $retAr;

    }

    public function update($values = null, $module = "XX") {
        $values = (array) $values;
        $origDSN = $values['dsn'];
        $dsn = $this->getDSN($values);
        // clear dsn from values
        unset($values['dsn']);
        $table = new GenericPVSWTable($module."setup", $dsn);
        $keyAr = array("setupid"=>$module);
        $table->update($keyAr, $values);
        $keyAr['dsn'] = $origDSN;
        return $this->findWhere($keyAr, $module);
    }


}
