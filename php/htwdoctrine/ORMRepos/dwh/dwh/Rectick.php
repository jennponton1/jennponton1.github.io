<?php

namespace Dwh;

/** @Entity */
class Rectick extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $rcptnbr;

    /** @Id @Column */
    protected $siteid;

    /** @Id @Column */
    protected $rcptdate;

    /** @Column */
    protected $vendid;

    /** @Column */
    protected $dest;

    /** @Column */
    protected $ponbr;

    /** @Column */
    protected $invtid;

    /** @Column */
    protected $qty;

    /** @Column */
    protected $bdft;

    /** @Column */
    protected $sqft;

    /** @Column */
    protected $vmi;

}
