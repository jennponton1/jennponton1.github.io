<?php

require_once "basetable.class.php";
require_once "GenericSolModuleSetup.class.php";

class INSetup extends GenericSolModuleSetup {
    public function findWhere($criteria) {
        return parent::findWhere($criteria, "IN");
    }

    public function update($values) {
        return parent::update($values, "IN");
    }

}
