<?php

namespace Dwh;

/** @Entity */
class Crmcustid extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column 
     * @Id 
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @Column */
    protected $custid;

    /** @Column */
    protected $crmid;

    /** @Column */
    protected $name;

}
