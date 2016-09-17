<?php

namespace Dwh;

/**
 * @Entity @Table(name="sobldet")
 */
class SoblDet {

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
    private $siteId;

    /**
     * @column
     */
    private $prodCat;

    /**
     * @id @column
     */
    private $invtId;

    /**
     * @column
     */
    private $ordQty;

    /**
     * @column
     */
    private $unitDesc;

    /**
     * @column
     */
    private $cnvFact;

    /**
     * @column
     */
    private $bU;

    /**
     * @column
     */
    private $bF;

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

    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getProdCat() {
        return $this->prodCat;
    }

    public function setProdCat($prodCat) {
        $this->prodCat = $prodCat;
    }

    public function getInvtId() {
        return $this->invtId;
    }

    public function setInvtId($invtId) {
        $this->invtId = $invtId;
    }

    public function getOrdQty() {
        return $this->ordQty;
    }

    public function setOrdQty($ordQty) {
        $this->ordQty = $ordQty;
    }

    public function getUnitDesc() {
        return $this->unitDesc;
    }

    public function setUnitDesc($unitDesc) {
        $this->unitDesc = $unitDesc;
    }

    public function getCnvFact() {
        return $this->cnvFact;
    }

    public function setCnvFact($cnvFact) {
        $this->cnvFact = $cnvFact;
    }

    public function getBU() {
        return $this->bU;
    }

    public function setBU($bU) {
        $this->bU = $bU;
    }

    public function getBF() {
        return $this->bF;
    }

    public function setBF($bF) {
        $this->bF = $bF;
    }

}
