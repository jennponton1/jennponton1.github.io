<?php

namespace Dwh;

/**
 * @Entity @Table(name="statdet")
 */
class StatDet {

    /**
     * @id @column
     */
    private $ordNbr;

    /**
     * @id @column
     */
    private $siteId;

    /**
     * @id @column
     */
    private $invtId;

    /**
     * @id @column
     */
    private $status;

    /**
     * @column
     */
    private $pcs;

    /**
     * @column
     */
    private $bf;

    /**
     * @column
     */
    private $statEdit;

    /**
     * 7 Parameter constructor
     * @param type $ordNbr
     * @param type $siteId
     * @param type $invtId
     * @param type $status
     * @param type $pcs
     * @param type $bf
     * @param type $statEdit
     */
    public function __construct($ordNbr, $siteId, $invtId, $status, $pcs, $bf, $statEdit) {
        $this->ordNbr   = $ordNbr;
        $this->siteId   = $siteId;
        $this->invtId   = $invtId;
        $this->status   = $status;
        $this->pcs      = $pcs;
        $this->bf       = $bf;
        $this->statEdit = $statEdit;
    }

    /** getter and setter methods * */
    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getInvtId() {
        return $this->invtId;
    }

    public function setInvtId($invtId) {
        $this->invtId = $invtId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPcs() {
        return $this->pcs;
    }

    public function setPcs($pcs) {
        $this->pcs = $pcs;
    }

    public function getBf() {
        return $this->bf;
    }

    public function setBf($bf) {
        $this->bf = $bf;
    }

    public function getStatEdit() {
        return $this->statEdit;
    }

    public function setStatEdit($statEdit) {
        $this->statEdit = $statEdit;
    }

}
