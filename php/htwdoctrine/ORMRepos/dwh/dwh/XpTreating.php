<?php

namespace Dwh;

/**
 * @Entity @table(name="xptreating")
 */
class XpTreating {

    /**
     * @id @column (type="string")
     */
    private $woodType;

    /**
     * @id @column (type="string")
     */
    private $treatment;

    /**
     * @column (type="decimal")
     */
    private $price;

    /**
     * Constructor to instantiate an XpTreating object
     * @param type $woodType
     * @param type $treatment
     * @param type $price
     */
    public function __construct($woodType, $treatment, $price) {
        $this->woodType  = $woodType;
        $this->treatment = $treatment;
        $this->price     = $price;
    }

    /**
     * Constructor to instantiate an XpTreating object
     * @param type $woodType
     * @param type $treatment
     * @param type $price
     */
    public function __construct($woodType, $treatment, $price) {
        $this->woodType  = $woodType;
        $this->treatment = $treatment;
        $this->price     = $price;
    }

    /** getters and setters * */
    public function getWoodType() {
        return $this->woodType;
    }

    public function setWoodType($woodType) {
        $this->woodType = $woodType;
    }

    public function getTreatment() {
        return $this->treatment;
    }

    public function setTreatment($treatment) {
        $this->treatment = $treatment;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

}
