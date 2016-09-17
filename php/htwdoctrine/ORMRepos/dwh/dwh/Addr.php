<?php

namespace Dwh;

/** @Entity */
class Addr {

    /** @Id @Column */
    public $addrid;

    /** @Column */
    public $addr1;

    /** @Column */
    public $addr2;

    /** @Column */
    public $city;

    /** @Column */
    public $state;

    /** @Column */
    public $zip;

}
