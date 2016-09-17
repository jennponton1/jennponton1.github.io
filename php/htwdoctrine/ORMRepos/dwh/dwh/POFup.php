<?php

namespace Dwh;

/** @Entity */
class POFup extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    public $ponbr;

    /** @Id @Column */
    public $cmtnbr;

    /** @Column */
    public $vendid;

    /** @Column */
    public $buyer;

    /** @Column */
    public $origshipdt;

    /** @Column */
    public $modshipdt;

    /** @Column */
    public $commentdt;

    /** @Column */
    public $comment;

}
