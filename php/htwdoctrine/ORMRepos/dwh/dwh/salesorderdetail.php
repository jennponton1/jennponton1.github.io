<?php

namespace Dwh;

/** @Entity */
class SalesorderDetail extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column
     *  @Id 
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column */
    protected $order_id;

    /** @Column */
    protected $ordnbr;

    /** @Column */
    protected $siteid;

    /** @Column */
    protected $whseloc;

    /** @Column */
    protected $custid;

    /** @Column */
    protected $invtid;

    /** @Column */
    protected $lotsernbr;

    /** @Column */
    protected $descr;

    /** @Column */
    protected $unitdescr;

    /** @Column */
    protected $cnvfact;

    /** @Column */
    protected $ordqty;

    /** @Column */
    protected $shipqty;

    /** @Column */
    protected $balqty;

    /** @Column */
    protected $bffactor;

    /** @Column */
    protected $sffactor;

    /** @Column */
    protected $slsprice;

    /** @Column */
    protected $wood;

    /** @Column */
    protected $treat;

    /** @Column */
    protected $trtadj;

    /** @Column */
    protected $freight;

    /** @Column */
    protected $misc;

    /** @Column */
    protected $othadj;

    /** @Column */
    protected $notes;

    /** @Column */
    protected $linenbr;

    /** @Column */
    protected $comment;

    /** @Column */
    protected $version;

    /** @Column */
    protected $lastrevisiondate;

}
