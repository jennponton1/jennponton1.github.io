<?php

namespace Dwh;

/**
 * @Entity @Table(name="stathdr") 
 */
class StatHdr {

    /**
     * @id @column
     */
    private $ordNbr;

    /**
     * @id @column
     */
    private $invtId;

    /**
     * @id @column
     */
    private $siteId;

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
    private $carrier;

    /**
     * @column
     */
    private $dtRdy;

    /**
     * @column
     */
    private $dtAllRcd;

    /**
     * @column
     */
    private $dtDueToShip;

    /**
     * @column
     */
    private $pcsShip;

    /**
     * @column
     */
    private $bfShip;

    /**
     * @column
     */
    private $pcsRem;

    /**
     * @column
     */
    private $bfRem;

    /**
     * @column
     */
    private $notes;

    /** getter and setter methods * */
    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

    public function getInvtId() {
        return $this->invtId;
    }

    public function setInvtId($invtId) {
        $this->invtId = $invtId;
    }

    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
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

    public function getCarrier() {
        return $this->carrier;
    }

    public function setCarrier($carrier) {
        $this->carrier = $carrier;
    }

    public function getDtRdy() {
        return $this->dtRdy;
    }

    public function setDtRdy($dtRdy) {
        $this->dtRdy = $dtRdy;
    }

    public function getDtAllRcd() {
        return $this->dtAllRcd;
    }

    public function setDtAllRcd($dtAllRcd) {
        $this->dtAllRcd = $dtAllRcd;
    }

    public function getDtDueToShip() {
        return $this->dtDueToShip;
    }

    public function setDtDueToShip($dtDueToShip) {
        $this->dtDueToShip = $dtDueToShip;
    }

    public function getPcsShip() {
        return $this->pcsShip;
    }

    public function setPcsShip($pcsShip) {
        $this->pcsShip = $pcsShip;
    }

    public function getBfShip() {
        return $this->bfShip;
    }

    public function setBfShip($bfShip) {
        $this->bfShip = $bfShip;
    }

    public function getPcsRem() {
        return $this->pcsRem;
    }

    public function setPcsRem($pcsRem) {
        $this->pcsRem = $pcsRem;
    }

    public function getBfRem() {
        return $this->bfRem;
    }

    public function setBfRem($bfRem) {
        $this->bfRem = $bfRem;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

}
