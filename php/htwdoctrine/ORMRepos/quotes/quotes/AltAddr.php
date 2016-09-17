<?php

namespace Quotes;

/** @Entity */
class AltAddr extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column 
     */
    protected $altId;

    /** @Id @Column */
    protected $custId;

    /** @Column */
    protected $shiptofname;

    /** @Column */
    protected $shiptolname;

    /** @Column */
    protected $shiptoaddr1;

    /** @Column */
    protected $shiptoaddr2;

    /** @Column */
    protected $shiptocity;

    /** @Column */
    protected $shiptostate;

    /** @Column */
    protected $shiptozip;

    /** @Column */
    protected $shiptophone;

    /** @Column */
    protected $shiptofax;

}
