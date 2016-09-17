<?php

require_once "basetable.class.php";
require_once "GenericSolModuleSetup.class.php";

class ARSetup extends GenericSolModuleSetup {
    public function findWhere($criteria) {
        return parent::findWhere($criteria, "AR");
    }

    public function update($values) {
        return parent::update($values, "AR");
    }


}
