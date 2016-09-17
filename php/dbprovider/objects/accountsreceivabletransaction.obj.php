<?php

require_once "basemoduletransaction.class.php";

class AccountsReceivableTransaction extends BaseModuleTransactionClass {
    public function __construct() {
        $module = "AR";
        parent::__construct($module);
    }
}
