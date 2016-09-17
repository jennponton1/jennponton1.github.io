<?php

require_once "cenvendor1099s.obj.php";

class Corvendor1099s extends CenVendor1099s {

    public function __construct() {
        parent::__construct("adocorp");
    }
    /** @Id @Column -- so that we can satisiy the object */
    public $id;
}
