<?php

namespace Dwh;

/** @Entity @Table(name="hist_location") */
class HistLocation extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $invtid;

    /** @Id @Column */
    protected $siteid;

    /** @Id @Column */
    protected $lotsernbr;

    /** @Id @Column */
    protected $whseloc;

    /** @Id @Column */
    protected $whsedate;

    /** @Column */
    protected $qtyonhand;

}
