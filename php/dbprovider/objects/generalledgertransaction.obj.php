<?php

require_once "basemoduletransaction.class.php";

class GeneralLedgerTransaction extends BaseModuleTransactionClass {
    public function __construct() {
        $module = "GL";
        parent::__construct($module);
    }

    public function insert($parms) {
        $parmAr = (array) $parms;
        $table = $this->getTable($parmAr);
        return $table->insert($parmAr);
    }
}
