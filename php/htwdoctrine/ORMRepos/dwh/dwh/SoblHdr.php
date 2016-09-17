<?php

namespace Dwh;

/**
 * @Entity @Table(name="soblhdr")
 */
class SoblHdr {

    /**
     * @id @column
     */
    private $ordNbr;

    /**
     * @column
     */
    private $ordType;

    /**
     * @column
     */
    private $boCntr;

    /**
     * @column
     */
    private $custId;

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
    private $shipDate;

    /**
     * @column
     */
    private $shipVia;

    /**
     * @column
     */
    private $fOB;

    /**
     * @column
     */
    private $siteType;

    /**
     * @column
     */
    private $status;

    /**
     * @column
     */
    private $openSO;

    /** Getters and Setters * */
    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

    public function getOrdType() {
        return $this->ordType;
    }

    public function setOrdType($ordType) {
        $this->ordType = $ordType;
    }

    public function getBoCntr() {
        return $this->boCntr;
    }

    public function setBoCntr($boCntr) {
        $this->boCntr = $boCntr;
    }

    public function getCustId() {
        return $this->custId;
    }

    public function setCustId($custId) {
        $this->custId = $custId;
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

    public function getShipDate() {
        return $this->shipDate;
    }

    public function setShipDate($shipDate) {
        $this->shipDate = $shipDate;
    }

    public function getShipVia() {
        return $this->shipVia;
    }

    public function setShipVia($shipVia) {
        $this->shipVia = $shipVia;
    }

    public function getFOB() {
        return $this->fOB;
    }

    public function setFOB($fOB) {
        $this->fOB = $fOB;
    }

    public function getSiteType() {
        return $this->siteType;
    }

    public function setSiteType($siteType) {
        $this->siteType = $siteType;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getOpenSO() {
        return $this->openSO;
    }

    public function setOpenSO($openSO) {
        $this->openSO = $openSO;
    }

}
