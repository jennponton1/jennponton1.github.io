<?php

namespace Dwh;

/** @Entity * */
class Multship {

    /** @Id @Column   */
    public $custid;

    /** @Id @Column */
    public $addrid;

    /**
     * @ManyToOne(targetEntity="Addr")
     * @JoinColumn(name="addrid",referencedColumnName="addrid")
     */
    public $address;

}
