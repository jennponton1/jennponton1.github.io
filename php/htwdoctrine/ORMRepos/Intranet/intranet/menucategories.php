<?php

namespace Intranet;

/** @Entity */
class Menucategories extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $categoryid;

    /** @Column */
    protected $categorysort;

    /** @Column */
    protected $category;

}
