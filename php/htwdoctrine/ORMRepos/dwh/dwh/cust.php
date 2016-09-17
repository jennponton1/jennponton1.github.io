<?php

namespace Dwh;

/**
 * @Entity 
 * @Table(name="cust")
 * 
 */
class Cust {

    /** @Column  @Id  */
    public $custid;

    /** @Column */
    public $lastname;

    /** @Column  */
    public $lastinvcdate;

    /** @Column */
    public $status;

    /** @Column */
    public $addrid;

    /**
     * @ManyToOne(targetEntity="Multship")
     * @JoinColumn(name="custid",referencedColumnName="custid")
     */
    public $shipaddress;

}
