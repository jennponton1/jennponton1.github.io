<?php

require_once "Batch.obj.php";

class APBatch extends Batch {
    public function __construct() {
        // assume a default DSN
        $dsn = $this->dsnMap['CEN'];
        parent::__construct($dsn);
    }

    public function findOpen() {
        return $this->findWhere(array("module"=>"AP", "status"=>"H"));
    }

    public function findWhere($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'AP';
        return parent::findWhere($parms);
    }

    public function update($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'AP';
        return parent::update($parms);

    }

    public function insert($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'AP';
        return parent::insert($parms);
    }
}
