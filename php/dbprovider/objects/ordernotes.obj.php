<?php

require_once "basetable.class.php";
require_once "salesorder.obj.php";

class OrderNotes {
    protected $salesorder;
    public function __construct() {
        $this->salesorder = new SalesOrder();
    }
    
    protected function reduceDataset($dataset, $site = "") {
        $retArray = array();
        foreach($dataset as $row) {
            $found = false;
            if ($site !== '') {
                if (substr($site, 0, 1) !== substr($row->sitetype, 0, 1)) {
                    continue;
                }
            }
            $newDetail = array();
            foreach($row->detail as $detRow) {
                if ($detRow->invtid == '') {
                    $found = true;
                    $newDetail[] = $detRow;
                }
            }
            if ($found) {
                $row->detail = $newDetail;
                $retArray[] = $row;
            }
        }
        return $retArray;
    }


    public function findOpen() {
        $resSet = $this->salesorder->findWhere(array("openso"=>"Y"));
        return $this->reduceDataset($resSet);
    }
    
    public function findWhere($parms) {
        //$query = ""
        $parms = (array) $parms;
        $site = "";
        $parms['notesonly']=1;
        if (isset($parms['siteid'])) {
            // We will have to run this 2x
            $site = $parms['siteid'];
            unset($parms['siteid']);
        }
        if (!isset($parms['openso'])) {
            $parms['openso'] = 'Y';
        }
        if ($site !== '') {
            $parms['sitetype'] = substr($site, 0, 1)."S";
            $resSet1 = $this->salesorder->findWhere($parms);
            $parms['sitetype'] = substr($site, 0, 1)."T";
            $resSet2 = $this->salesorder->findWhere($parms);
            array_merge($resSet1->data, $resSet2->data);
            $resSet = $resSet1;
        }
        else {
            $resSet = $this->salesorder->findWhere($parms);
        }
        return $this->reduceDataset($resSet, $site);
    }
    
}
