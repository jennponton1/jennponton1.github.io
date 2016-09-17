<?php

namespace Dwh;

/**
 * @Entity @Table(name="inthist") 
 */
class IntHist {

    /**
     * @id @column(type="string") 
     */
    private $refNbr;

    /**
     * @column(type="string") 
     */
    private $tranType;

    /**
     * @column
     */
    private $tranDate;

    /**
     * @column(type="string")
     */
    private $whseLoc;

    /**
     * @column(type="string") 
     */
    private $lotSerNbr;

    /**
     * @column(type="string") 
     */
    private $siteId;

    /**
     * @id @column(type="string")
     */
    private $invtId;

    /**
     * @column(type="decimal")
     */
    private $qty;

    /**
     * @column(type="decimal") 
     */
    private $cf;

    /**
     * @column(type="decimal") 
     */
    private $bf;

    /**
     * @column(type="decimal")
     */
    private $sf;

    /**
     * @column(type="decimal")
     */
    private $cnvFact;

    /**
     * @column(type="decimal") 
     */
    private $pcs;

    /**
     * @column(type="string") 
     */
    private $unit;

    /**
     * @column(type="string")
     */
    private $perPost;

    /**
     * @column(type="string")
     */
    private $batNbr;

    /**
     * @id @column(type="string")
     */
    private $ordNbr;

    /** getter and setter methods * */
    public function getRefNbr() {
        return $this->refNbr;
    }

    public function setRefNbr($refNbr) {
        $this->refNbr = $refNbr;
    }

    public function getTranType() {
        return $this->tranType;
    }

    public function setTranType($tranType) {
        $this->tranType = $tranType;
    }

    public function getTranDate() {
        return $this->tranDate;
    }

    public function setTranDate($tranDate) {
        $this->tranDate = $tranDate;
    }

    public function getWhseLoc() {
        return $this->whseLoc;
    }

    public function setWhseLoc($whseLoc) {
        $this->whseLoc = $whseLoc;
    }

    public function getLotSerNbr() {
        return $this->lotSerNbr;
    }

    public function setLotSerNbr($lotSerNbr) {
        $this->lotSerNbr = $lotSerNbr;
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

    public function getQty() {
        return $this->qty;
    }

    public function setQty($qty) {
        $this->qty = $qty;
    }

    public function getCf() {
        return $this->cf;
    }

    public function setCf($cf) {
        $this->cf = $cf;
    }

    public function getBf() {
        return $this->bf;
    }

    public function setBf($bf) {
        $this->bf = $bf;
    }

    public function getSf() {
        return $this->sf;
    }

    public function setSf($sf) {
        $this->sf = $sf;
    }

    public function getCnvFact() {
        return $this->cnvFact;
    }

    public function setCnvFact($cnvFact) {
        $this->cnvFact = $cnvFact;
    }

    public function getPcs() {
        return $this->pcs;
    }

    public function setPcs($pcs) {
        $this->pcs = $pcs;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function getPerPost() {
        return $this->perPost;
    }

    public function setPerPost($perPost) {
        $this->perPost = $perPost;
    }

    public function getBatNbr() {
        return $this->batNbr;
    }

    public function setBatNbr($batNbr) {
        $this->batNbr = $batNbr;
    }

    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

}
