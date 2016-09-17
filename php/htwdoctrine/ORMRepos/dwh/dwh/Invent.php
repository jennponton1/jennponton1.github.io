<?php

namespace Dwh;

/**
 * @Entity @Table(name="invent") 
 */
class Invent extends BaseEntityClass {

    /**
     * @id @column(type="string") 
     */
    protected $invtId;

    /**
     * @id @column(type="string") 
     */
    protected $classId;

    /**
     * @column(type="string")
     */
    protected $descr;

    /**
     * @column(type="string")
     */
    protected $trtmt;

    /**
     * @column(type="string")
     */
    protected $prodCat;

    /**
     * @column(type="string")
     */
    protected $rptClass;

    /**
     * @column(type="string")
     */
    protected $rptDry;

    /**
     * @column(type="decimal")
     */
    protected $bndSize;

    /**
     * @column(type="decimal")
     */
    protected $bfFac;

    /**
     * @column(type="decimal")
     */
    protected $sfFac;

    public function __construct() {
        parent::__construct();
    }

}
