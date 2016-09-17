<?php

namespace Quotes;

/** @Entity * */
class Quotedtl extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column @Id * */
    protected $quotenbr;

    /** @Column @Id * */
    protected $revnbr;

    /** @Column @Id * */
    protected $linenbr;

    /** @Column * */
    protected $invtid;

    /** @Column * */
    protected $descr;

    /** @Column * */
    protected $qty;

    /** @Column * */
    protected $unit;

    /** @Column * */
    protected $woodcost;

    /** @Column * */
    protected $treatcost;

    /** @Column * */
    protected $treatadj;

    /** @Column * */
    protected $sddisc;

    /** @Column * */
    protected $addr;

    /** @Column * */
    protected $freight;

    /** @Column * */
    protected $ffactor;

    /** @Column * */
    protected $totcost;

    /** @Column * */
    protected $tsize;

    /** @Column * */
    protected $bf;

    /** @Column * */
    protected $bu;

    /** @Column * */
    protected $stkitem;

}
