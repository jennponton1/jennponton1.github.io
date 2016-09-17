<?php

namespace Dwh;

/**
 * @Entity
 * 
 */
class Stackedhdr extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column @GeneratedValue()  */
    protected $id;

    /** @Column */
    protected $stackerId;

    /** @Column */
    protected $shift;

    /** @Column */
    protected $tranDate;

    /** @Column */
    protected $operator;

    /** @Column */
    protected $direction;

}
