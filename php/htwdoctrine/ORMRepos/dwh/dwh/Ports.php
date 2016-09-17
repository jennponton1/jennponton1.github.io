<?php

namespace Dwh;

/**
 * @Entity @Table(name="ports")
 */
class Ports {

    /**
     * @id @column(type="string")
     */
    private $portId;

    /**
     * @column(type="string")
     */
    private $country;

    /**
     * @column(type="string")
     */
    private $portName;

    /** Getters and Setters * */
    public function getPortId() {
        return $this->portId;
    }

    public function setPortId($portId) {
        $this->portId = $portId;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getPortName() {
        return $this->portName;
    }

    public function setPortName($portName) {
        $this->portName = $portName;
    }

}
