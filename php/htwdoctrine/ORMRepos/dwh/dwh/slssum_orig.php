<?php

namespace Dwh;

/**
 * @Entity
 * @Table(name="slssum")
 */
class Slssum_orig extends BaseEntityClass {

    /**
     *  @Id @Column
     */
    protected $perpost;

    /**
     * @Id @Column
     */
    protected $custid;

    /**
     * @Column
     */
    protected $bfship;

    /**
     * @Column @Id
     */
    protected $siteid;

    /**
     * @Column
     */
    protected $pcsship;

    /**
     * @ManyToOne(targetEntity="Cust")
     * @JoinColumn(name="custid",referencedColumnName="custid")
     */
    protected $customer;

    /**
     * @Column
     */
    protected $prodcat;

    /** @Column @Id */
    protected $invtid;

    /** @Column */
    protected $whseloc;

    /** @Column */
    protected $slsperid;

}
