<?php

namespace Quotes;

/** @Entity */
class Treatcalc extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $siteid;

    /** @Id @Column */
    protected $prodcat;

    /** @Column */
    protected $dim;

    /** @Column */
    protected $species;

    /** @Column */
    protected $finish;

    /** @Column */
    protected $price;

}
