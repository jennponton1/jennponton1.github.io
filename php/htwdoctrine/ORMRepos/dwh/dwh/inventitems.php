<?php

namespace Dwh;

/** @Entity */
class Inventitems extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id
     *  @Column
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @Column */
    protected $invtid;

    /** @Column */
    protected $descr;

    /** @Column */
    protected $classid;

    /** @Column */
    protected $woodid;

    /** @Column */
    protected $stkitem;

}
