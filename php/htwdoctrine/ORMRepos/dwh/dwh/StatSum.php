<?php

namespace Dwh;

/**
 * @Entity @Table(name="statsum") 
 */
class StatSum {

    /**
     * @id @column
     */
    private $siteId;

    /**
     * @id @column
     */
    private $ordNbr;

    /**
     * @column
     */
    private $trtmt;

    /**
     * @column
     */
    private $custName;

    /**
     * @column
     */
    private $custOrdNbr;

    /**
     * @column
     */
    private $slsPerId;

    /**
     * @column
     */
    private $ordDate;

    /**
     * @column
     */
    private $matlRcvdDt;

    /**
     * @column
     */
    private $dtDueToShip;

    /**
     * @column
     */
    private $status;

    /**
     * @column
     */
    private $dtRdy;

    /**
     * @column
     */
    private $carrier;

    /**
     * @column
     */
    private $toTord;

    /**
     * @column
     */
    private $shipped;

    /**
     * @column
     */
    private $notes;

    /** getter and setter methods * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

    public function getTrtmt() {
        return $this->trtmt;
    }

    public function setTrtmt($trtmt) {
        $this->trtmt = $trtmt;
    }

    public function getCustName() {
        return $this->custName;
    }

    public function setCustName($custName) {
        $this->custName = $custName;
    }

    public function getCustOrdNbr() {
        return $this->custOrdNbr;
    }

    public function setCustOrdNbr($custOrdNbr) {
        $this->custOrdNbr = $custOrdNbr;
    }

    public function getSlsPerId() {
        return $this->slsPerId;
    }

    public function setSlsPerId($slsPerId) {
        $this->slsPerId = $slsPerId;
    }

    public function getOrdDate() {
        return $this->ordDate;
    }

    public function setOrdDate($ordDate) {
        $this->ordDate = $ordDate;
    }

    public function getMatlRcvdDt() {
        return $this->matlRcvdDt;
    }

    public function setMatlRcvdDt($matlRcvdDt) {
        $this->matlRcvdDt = $matlRcvdDt;
    }

    public function getDtDueToShip() {
        return $this->dtDueToShip;
    }

    public function setDtDueToShip($dtDueToShip) {
        $this->dtDueToShip = $dtDueToShip;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDtRdy() {
        return $this->dtRdy;
    }

    public function setDtRdy($dtRdy) {
        $this->dtRdy = $dtRdy;
    }

    public function getCarrier() {
        return $this->carrier;
    }

    public function setCarrier($carrier) {
        $this->carrier = $carrier;
    }

    public function getToTord() {
        return $this->toTord;
    }

    public function setToTord($toTord) {
        $this->toTord = $toTord;
    }

    public function getShipped() {
        return $this->shipped;
    }

    public function setShipped($shipped) {
        $this->shipped = $shipped;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

}
