<?php

namespace Quotes;

/** @Entity */
class PlyThick extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $nomThick;

    /** @Column */
    protected $actThick;

}
