<?php

namespace Dwh;

/**
 * @Entity
 */
class XpFreightVolume {

    /** @id @column (type="string") */
    private $siteId;

    /** @id @column (type="string") */
    private $woodType;

    /**
     * @column (type="decimal")
     */
    private $volume;

    public function __construct($siteId, $woodType, $volume) {
        $this->siteId   = $siteId;
        $this->woodType = $woodType;
        $this->volume   = $volume;
    }

    /** getters and setters * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getWoodType() {
        return $this->woodType;
    }

    public function setWoodType($woodType) {
        $this->woodType = $woodType;
    }

    public function getVolume() {
        return $this->volume;
    }

    public function setVolume($volume) {
        $this->volume = $volume;
    }

}
