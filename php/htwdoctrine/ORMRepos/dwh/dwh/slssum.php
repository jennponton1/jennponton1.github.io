<?php

namespace Dwh;

/**
 * @Entity
 * @Table(name="slssum2")
 */
class Slssum extends BaseEntityClass {

    /**
     *  @Column
     *  @Id
     */
    protected $id;

    /**
     * @Column
     */
    protected $perpost;

    /**
     * @Column
     */
    protected $custid;

    /**
     * @Column
     */
    protected $bfship;

    /**
     * @Column
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

    /** @Column */
    protected $invtid;

    /** @Column */
    protected $whseloc;

    /** @Column */
    protected $slsperid;

}
