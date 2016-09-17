<?php

namespace Quotes;

/** @Entity */
class Manuloc extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $chemcat;

    /** @Id @Column */
    protected $siteid;

}
