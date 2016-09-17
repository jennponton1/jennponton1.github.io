<?php

require_once "Batch.obj.php";

class INBatch extends Batch {
    
    public function findOpen() {
        return $this->findWhere(array("module"=>"I", "status"=>"H"));
    }
    
    public function findWhere($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'IN';
        return parent::findWhere($parms);
    }
    
    public function update($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'IN';
        return parent::update($parms);
    }
    
    public function insert($parms) {
        $parms = (array) $parms;
        $parms['module'] = 'IN';
        return parent::insert($parms);
    }
}
