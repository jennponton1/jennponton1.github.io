<?php

namespace Dwh;

/** @Entity */
class Vmivendors extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column @Id */
    protected $siteid;

    /** @Column @Id */
    protected $vendid;

    /** @Column */
    protected $wdtype;

}
