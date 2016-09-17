<?php

namespace Dwh;

/** @Entity */
class Stackerschedule extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id 
     * @Column
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column */
    protected $stackerId;

    /** @Column */
    protected $siteId;

    /** @Column */
    protected $ordNbr;

    /** @Column */
    protected $invtId;

    /** @Column */
    protected $descr;

    /** @Column */
    protected $custId;

    /** @Column */
    protected $whseLoc;

    /** @Column */
    protected $qty;

    /** @Column */
    protected $priority;

    /** @Column */
    protected $staged;
	
	/** @Column */
	protected $notes;
	
	/** @Column */
	protected $dest;
	
	/** @Column */
	protected $rel;	

	/** @Column */
	protected $tosPos;
}
