<?php

namespace Dwh;

/** @Entity * */
class Vmilevels extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column @Id * */
    protected $siteid;

    /** @Column @Id * */
    protected $vendid;

    /** @Column @Id * */
    protected $invtid;

    /** @Column * */
    protected $desiredlevel;

}
