<?php

namespace Intranet;

/** @Entity */
class Subcats extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $subcatid;

    /** @Column */
    protected $subcatsort;

    /** @Column */
    protected $subcat;

}
