<?php

namespace Dwh;

/** @Entity */
class StkGenNotes extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }
	
	/** @Id @Column */
	protected $id;

    /** @Column */
    protected $stackerId;

    /** @Column */
    protected $siteId;
	
	/** @Column */
	protected $notes;
}
