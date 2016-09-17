<?php

namespace Dwh;

/**
 * @Entity
 * 
 */
class Stackeddet extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column @GeneratedValue()   */
    protected $id;

    /** @Column */
    protected $hdrId;

    /** @Column */
    protected $invtId;

    /** @Column */
    protected $pieces;

    /** @Column */
    protected $layers;

    /** @Column */
    protected $ordNbr;

}
