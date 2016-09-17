<?php

namespace Dwh;

/** @Entity */
class StackerUnposted extends BaseEntityClass {

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
    protected $dtEntered;

    /** @Column */
    protected $invtId;

    /** @Column */
    protected $descr;

    /** @Column */
    protected $shift;

    /** @Column */
    protected $qty;

    /** @Column */
    protected $layers;

    /** @Column */
    protected $priority;

    /** @Column */
    protected $custId;

    /** @Column */
    protected $whseLoc;
	
	/** @Column */
	protected $tosPos;
	
	/** @Column */
	protected $notes;
	
	/** @Column */
	protected $dest;
}
