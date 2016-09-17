<?php

namespace Dwh;

/** @Entity */
class Woodlookup extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column *
     *  @Id     

     */
    protected $woodid;

    /** @Column */
    protected $descr;

    /** @Column */
    protected $wooddesc;

    /** @Column */
    protected $grade;

    /** @Column */
    protected $species;

    /** @Column */
    protected $prefix;

    /** @Column */
    protected $d1d2desc;

    /** @Column */
    protected $lendesc;

    /** @Column */
    protected $nomd1;

    /** @Column */
    protected $nomd2;

    /** @Column */
    protected $nomd3;

    /** @Column */
    protected $actd1;

    /** @Column */
    protected $actd2;

    /** @Column */
    protected $actd3;

}
