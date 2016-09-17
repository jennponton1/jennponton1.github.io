<?php

namespace Dwh;

/** @Entity */
class SalesorderHeader extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column
     *  @Id 
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column */
    protected $ordnbr;

    /** @Column */
    protected $openso;

    /** @Column */
    protected $slsperid;

    /** @Column */
    protected $orddate;

    /** @Column */
    protected $shipvia;

    /** @Column */
    protected $fob;

    /** @Column */
    protected $terms;

    /** @Column */
    protected $custordnbr;

    /** @Column */
    protected $ordtot;

    /** @Column */
    protected $shipdate;

    /** @Column */
    protected $siteid;

    /** @Column */
    protected $slstype;

    /** @Column */
    protected $perclosed;

    /** @Column */
    protected $custid;

    /** @Column */
    protected $shipaddr1;

    /** @Column */
    protected $shipaddr2;

    /** @Column */
    protected $shipcity;

    /** @Column */
    protected $shiplastname;

    /** @Column */
    protected $shipfirstname;

    /** @Column */
    protected $shipstate;

    /** @Column */
    protected $shipzip;

    /** @Column */
    protected $shipaddressid;

    /** @Column */
    protected $emaillist;

    /** @Column */
    protected $export;

    /** @Column */
    protected $notes;

    /** @Column */
    protected $version;

    /** @Column */
    protected $lastrevisiondate;

}
