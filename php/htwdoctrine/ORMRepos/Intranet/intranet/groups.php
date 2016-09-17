<?php

namespace Intranet;

/** @Entity */
class Groups extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id
     *  @Column
     */
    protected $groupid;

    /** @Column */
    protected $groupname;

}
