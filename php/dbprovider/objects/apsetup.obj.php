<?php

require_once "basetable.class.php";
require_once "GenericSolModuleSetup.class.php";

class APSetup extends GenericSolModuleSetup {
    public function findWhere($criteria) {
        return parent::findWhere($criteria, "AP");
    }

    public function update($values) {
        return parent::update($values, "AP");
    }


}
