<?php

namespace Quotes;

/** @Entity */
class Ranking extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $custid;

    /** @Id @Column */
    protected $invtid;

    /** @Column */
    protected $trt;

    /** @Column */
    protected $billunits;

    /** @Column */
    protected $linetot;

}
