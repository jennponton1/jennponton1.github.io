<?php

namespace Intranet;

/** @Entity */
class Menutable extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $menuitemid;

    /** @Column */
    protected $menudescr;

    /** @Column */
    protected $menulink;

    /** @Column */
    protected $categoryid;

    /** @Column */
    protected $subcatid;

}
