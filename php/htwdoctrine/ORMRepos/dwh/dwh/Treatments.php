<?php

namespace Dwh;

/**
 * @Entity @table(name="treatments")
 */
class Treatments {

    /**
     * @id @column (type="string")
     */
    private $trtId;

    /**
     * @column (type="string")
     */
    private $descr;

    /**
     * @column (type="decimal")
     */
    private $retention;

    /**
     * @column (type="string")
     */
    private $suffix;

    /**
     * Constructor to instantiate a Treatment object
     * @param type $trtId
     * @param type $descr
     * @param type $retention
     * @param type $suffix 
     */
    public function __construct($trtId, $descr, $retention, $suffix) {
        $this->trtId     = $trtId;
        $this->descr     = $descr;
        $this->retention = $retention;
        $this->suffix    = $suffix;
    }

    /** getters and setters * */
    public function getTrtId() {
        return $this->trtId;
    }

    public function setTrtId($trtId) {
        $this->trtId = $trtId;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function setDescr($descr) {
        $this->descr = $descr;
    }

    public function getRetention() {
        return $this->retention;
    }

    public function setRetention($retention) {
        $this->retention = $retention;
    }

    public function getSuffix() {
        return $this->suffix;
    }

    public function setSuffix($suffix) {
        $this->suffix = $suffix;
    }

}
