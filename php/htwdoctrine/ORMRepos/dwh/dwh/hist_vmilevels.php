<?php

namespace Dwh;

/** @Entity */
class Hist_vmilevels extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column 
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column */
    protected $invtid;

    /** @Column */
    protected $desiredlevel;

    /** @Column
     * */
    protected $siteid;

    /** @Column
     * */
    protected $whsedate;

}
