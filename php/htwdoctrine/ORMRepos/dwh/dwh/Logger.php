<?php

namespace Dwh;

//NOTE: No table in the database currently exist at the moment

/** @Entity @Table(name="logger") */
class Logger extends BaseEntityClass {

    /** @Id @Column @GeneratedValue */
    protected $id;

    /** @Column */
    protected $recordId;

    /** @Column */
    protected $user;

    /** @Column */
    protected $dateTime;

    /** @Column */
    protected $tableName;

    /** @Column */
    protected $fieldName;

    /** @Column */
    protected $oldValue;

    /** @Column */
    protected $newValue;

    public function __construct($recordId, $user, $dateTime, $tableName, $fieldName, $oldValue, $newValue) {
        parent::__construct();
        $this->recordId  = $recordId;
        $this->user      = $user;
        $this->dateTime  = $dateTime;
        $this->tableName = $tableName;
        $this->fieldName = $fieldName;
        $this->oldValue  = $oldValue;
        $this->newValue  = $newValue;
    }

}
