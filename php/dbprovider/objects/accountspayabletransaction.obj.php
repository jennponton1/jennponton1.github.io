<?php

require_once "basemoduletransaction.class.php";

class AccountsPayableTransaction extends BaseModuleTransactionClass {
    public function __construct() {
        $module = "AP";
        parent::__construct($module);
    }
}
