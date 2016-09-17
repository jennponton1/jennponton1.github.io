<?php

require_once "basetable.class.php";
require_once "GenericSolModuleSetup.class.php";

class GLSetup extends GenericSolModuleSetup {
    public function findWhere($criteria) {
        return parent::findWhere($criteria, "GL");
    }

    public function update($values) {
        return parent::update($values, "GL");
    }
}
