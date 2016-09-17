<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define("APP_CLASS_DESCENDANT", true);
require_once "htwApp.class.php";
if (!defined("NOFRAMEWORK")){
    require_once "htframework.inc.php";
}

function clean_dump($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

class myController extends htwAppController {
    protected $appInstance;

    public function __construct($varname, $parent_instance = '') {
        parent::__construct($varname);
        $this->appInstance = null;
        if ($parent_instance == "") {
            throw new Exception("You must include a parent app instance!!!", 0);
        }
        else {
            $this->appInstance = $parent_instance;
        }
    }

    public function dispatch() {
        if (isset($this->dispatchArray[$this->action])) {
            $methodName = $this->dispatchArray[$this->action];
            $this->appInstance->$methodName();
        }
        else {
            throw new Exception('Unknown Action');
        }
    }
}

class myAppClass extends htwAppClass {

    public function __construct() {
        parent::__construct();
        $this->appController = new myController("do", $this);
    }
}
