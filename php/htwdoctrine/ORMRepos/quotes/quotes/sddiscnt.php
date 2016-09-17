<?php

namespace Quotes;

/** @Entity */
class Sddiscnt extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $custid;

    /** @Id @Column */
    protected $site;

    /** @Column */
    protected $apgd;

    /** @Column */
    protected $bpgd;

    /** @Column */
    protected $axfx;

    /** @Column */
    protected $bxfx;

}
