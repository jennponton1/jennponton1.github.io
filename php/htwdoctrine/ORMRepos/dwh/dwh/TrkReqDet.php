<?php

namespace Dwh;

/**
 * @Entity @Table(name="trkreqdet")
 */
class TrkReqDet {

    /**
     * @id @column(type="string")
     */
    private $trkNbr;

    /**
     * @id @column(type="string")
     */
    private $ordNbr;

    /**
     * @column(type="date")
     */
    private $dtRelease;

    /**
     * @column(type="string")
     */
    private $custId;

    /**
     * @column(type="string")
     */
    private $shipTo;

    /**
     * @column(type="string")
     */
    private $slsPerId;

    /**
     * @column(type="string")
     */
    private $comments;

    /** getter and setter methods * */
    public function getTrkNbr() {
        return $this->trkNbr;
    }

    public function setTrkNbr($trkNbr) {
        $this->trkNbr = $trkNbr;
    }

    public function getOrdNbr() {
        return $this->ordNbr;
    }

    public function setOrdNbr($ordNbr) {
        $this->ordNbr = $ordNbr;
    }

    public function getDtRelease() {
        return $this->dtRelease;
    }

    public function setDtRelease($dtRelease) {
        $this->dtRelease = $dtRelease;
    }

    public function getCustId() {
        return $this->custId;
    }

    public function setCustId($custId) {
        $this->custId = $custId;
    }

    public function getShipTo() {
        return $this->shipTo;
    }

    public function setShipTo($shipTo) {
        $this->shipTo = $shipTo;
    }

    public function getSlsPerId() {
        return $this->slsPerId;
    }

    public function setSlsPerId($slsPerId) {
        $this->slsPerId = $slsPerId;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }

}
