<?php

require_once "basetable.class.php";

class InvoiceNumber {
    protected $arsetup = null;
    public function __construct() {
        $this->arsetup = new GenericPVSWTable("arsetup");
    }

    public function findOpen() {
        $dSet = $this->arsetup->findWhere(array("setupid"=>"AR"));
        $ret = array();
        foreach($dSet as $row) {
            $ret[] = array("invcnbr"=>$row->lastrefnbr);
        }
        return $ret;
    }

    public function findWhere() {
        return $this->findOpen();
    }

    public function insert() {
        // Initialize the column list
        $this->arsetup->getColumnList();
        // @TODO, start a transaction
        $this->arsetup->directQuery("Start transaction");
        // @TODO, get the last order #
        $ds = $this->findOpen();
        $invcnbr = $ds[0]['invcnbr'];
        // @TODO: increment number
        $invcnbr = intval($invcnbr);
        if ($invcnbr == 0) {
            throw new Exception("invalid invoice #");
        }
        $invcnbr++;
        $invcNbrStr = sprintf("%06d", $invcnbr);
        $ds[0]['invcnbr'] = $invcNbrStr;
        // @TODO: save it
        $this->arsetup->update(array("setupid"=>"AR"), array("lastrefnbr"=>$invcNbrStr));
        $this->arsetup->directQuery("commit");
        return $this->findOpen();
        //$this->arsetup->directQuery("rollback ");
        //throw new Exception("Sorry, not ready yet");
    }

}
