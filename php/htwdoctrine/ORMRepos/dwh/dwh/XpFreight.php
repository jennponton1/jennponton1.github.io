<?php

namespace Dwh;

/**
 * @Entity @Table(name="xpfreight")
 */
class XpFreight {

    /**
     * @id @column (type="string")
     */
    private $siteId;

    /**
     * @id @column (type="string")
     */
    private $portId;

    /**
     * @id @column (type="string")
     */
    private $woodType;

    /**
     * @column (type="decimal")
     */
    private $price;

    public function __construct($siteId, $portId, $woodType, $price) {
        $this->siteId   = $siteId;
        $this->portId   = $portId;
        $this->woodType = $woodType;
        $this->price    = $price;
    }

    /** getter and setter methods * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getPortId() {
        return $this->portId;
    }

    public function setPortId($portId) {
        $this->portId = $portId;
    }

    public function getWoodType() {
        return $this->woodType;
    }

    public function setWoodType($woodType) {
        $this->woodType = $woodType;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

}
