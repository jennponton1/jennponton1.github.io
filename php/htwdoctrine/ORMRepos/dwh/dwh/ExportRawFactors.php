<?php

namespace Dwh;

/**
 * @Entity @Table(name="exportrawfactors")
 */
class ExportRawFactors {

    /**
     * @id @column(type="string")
     */
    private $siteId;

    /**
     * @column(type="string")
     */
    private $invTid;

    /**
     * @column(type="string")
     */
    private $chemcat;

    /**
     * @column(type="string")
     */
    private $subcat;

    /**
     * @column(type="string")
     */
    private $descr;

    /**
     * @column(type="string")
     */
    private $D1D2;

    /**
     * @column(type="string")
     */
    private $grade;

    /**
     * @column(type="decimal")
     */
    private $bf;

    /**
     * @column(type="string")
     */
    private $woodType;

    /**
     * @column(type="decimal")
     */
    private $raw;

    /**
     * @column(type="decimal")
     */
    private $D1;

    /**
     * @column(type="decimal")
     */
    private $D2;

    /**
     * @column(type="decimal")
     */
    private $len;

    /**
     * @column(type="decimal")
     */
    private $fixD1;

    /**
     * @column(type="decimal")
     */
    private $AD1;

    /**
     * @column(type="decimal")
     */
    private $AD2;

    /**
     * @column(type="decimal")
     */
    private $netBF;

    /**
     * @column(type="integer")
     */
    private $bundleLimit;

    /** getter and setter methods * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getInvTid() {
        return $this->invTid;
    }

    public function setInvTid($invTid) {
        $this->invTid = $invTid;
    }

    public function getChemcat() {
        return $this->chemcat;
    }

    public function setChemcat($chemcat) {
        $this->chemcat = $chemcat;
    }

    public function getSubcat() {
        return $this->subcat;
    }

    public function setSubcat($subcat) {
        $this->subcat = $subcat;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function setDescr($descr) {
        $this->descr = $descr;
    }

    public function getD1D2() {
        return $this->D1D2;
    }

    public function setD1D2($D1D2) {
        $this->D1D2 = $D1D2;
    }

    public function getGrade() {
        return $this->grade;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    public function getBf() {
        return $this->bf;
    }

    public function setBf($bf) {
        $this->bf = $bf;
    }

    public function getWoodType() {
        return $this->woodType;
    }

    public function setWoodType($woodType) {
        $this->woodType = $woodType;
    }

    public function getRaw() {
        return $this->raw;
    }

    public function setRaw($raw) {
        $this->raw = $raw;
    }

    public function getD1() {
        return $this->D1;
    }

    public function setD1($D1) {
        $this->D1 = $D1;
    }

    public function getD2() {
        return $this->D2;
    }

    public function setD2($D2) {
        $this->D2 = $D2;
    }

    public function getLen() {
        return $this->len;
    }

    public function setLen($len) {
        $this->len = $len;
    }

    public function getFixD1() {
        return $this->fixD1;
    }

    public function setFixD1($fixD1) {
        $this->fixD1 = $fixD1;
    }

    public function getAD1() {
        return $this->AD1;
    }

    public function setAD1($AD1) {
        $this->AD1 = $AD1;
    }

    public function getAD2() {
        return $this->AD2;
    }

    public function setAD2($AD2) {
        $this->AD2 = $AD2;
    }

    public function getNetBF() {
        return $this->netBF;
    }

    public function setNetBF($netBF) {
        $this->netBF = $netBF;
    }

    public function getBundleLimit() {
        return $this->bundleLimit;
    }

    public function setBundleLimit($bundleLimit) {
        $this->bundleLimit = $bundleLimit;
    }

}
