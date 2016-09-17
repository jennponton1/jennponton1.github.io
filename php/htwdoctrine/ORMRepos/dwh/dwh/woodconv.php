<?php

namespace Dwh;

/** @Entity */
class Woodconv extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column *
     *  @Id     

     */
    protected $woodid;

    /** @Column */
    protected $bf;

    /** @Column */
    protected $sf;

    /** @Column */
    protected $bndl;

    /** @Column */
    protected $cuft;

}
