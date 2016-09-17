<?php

namespace Intranet;

/** @Entity */
class Menupermissions extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $menuitemid;

    /** $Id @Column */
    protected $groupid;

}
