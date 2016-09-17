<?php

namespace Dwh;

/**
 * @Entity @Table(name="htinprod")
 */
class HtinProd {

    /**
     * @id @column(type="string")
     */
    private $prodCat;

    /**
     * @column(type="string")
     */
    private $chemCat;

    /**
     * @column(type="string")
     */
    private $chemCatSub;

    /**
     * @column(type="string")
     */
    private $cat1;

    /**
     * @column(type="string")
     */
    private $cat2;

    /**
     * @column(type="decimal")
     */
    private $packaging;

    /**
     * @column(type="decimal")
     */
    private $retention;

    /**
     * @column(type="decimal")
     */
    private $handling;

    /**
     * @column(type="decimal")
     */
    private $labor;

    /**
     * @column(type="decimal")
     */
    private $drying;

    /** Getters and Setters * */
    public function getProdCat() {
        return $this->prodCat;
    }

    public function setProdCat($prodCat) {
        $this->prodCat = $prodCat;
    }

    public function getChemCat() {
        return $this->chemCat;
    }

    public function setChemCat($chemCat) {
        $this->chemCat = $chemCat;
    }

    public function getChemCatSub() {
        return $this->chemCatSub;
    }

    public function setChemCatSub($chemCatSub) {
        $this->chemCatSub = $chemCatSub;
    }

    public function getCat1() {
        return $this->cat1;
    }

    public function setCat1($cat1) {
        $this->cat1 = $cat1;
    }

    public function getCat2() {
        return $this->cat2;
    }

    public function setCat2($cat2) {
        $this->cat2 = $cat2;
    }

    public function getPackaging() {
        return $this->packaging;
    }

    public function setPackaging($packaging) {
        $this->packaging = $packaging;
    }

    public function getRetention() {
        return $this->retention;
    }

    public function setRetention($retention) {
        $this->retention = $retention;
    }

    public function getHandling() {
        return $this->handling;
    }

    public function setHandling($handling) {
        $this->handling = $handling;
    }

    public function getLabor() {
        return $this->labor;
    }

    public function setLabor($labor) {
        $this->labor = $labor;
    }

    public function getDrying() {
        return $this->drying;
    }

    public function setDrying($drying) {
        $this->drying = $drying;
    }

}
