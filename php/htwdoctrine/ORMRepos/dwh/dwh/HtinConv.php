<?php

namespace Dwh;

/**
 * @Entity @Table(name="htinconv")
 */
class HtinConv {

    /**
     * @column(type="decimal")
     */
    private $bf;

    /**
     * @column(type="decimal")
     */
    private $bndl;

    /**
     * @column(type="decimal")
     */
    private $ea;

    /**
     * @column(type="decimal")
     */
    private $cuft;

    /**
     * @column(type="decimal")
     */
    private $sf;

    /**
     * @id @column(type="boolean")
     */
    private $invtId;

    /** Getters and Setters * */
    public function getBf() {
        return $this->bf;
    }

    public function setBf($bf) {
        $this->bf = $bf;
    }

    public function getBndl() {
        return $this->bndl;
    }

    public function setBndl($bndl) {
        $this->bndl = $bndl;
    }

    public function getEa() {
        return $this->ea;
    }

    public function setEa($ea) {
        $this->ea = $ea;
    }

    public function getCuft() {
        return $this->cuft;
    }

    public function setCuft($cuft) {
        $this->cuft = $cuft;
    }

    public function getSf() {
        return $this->sf;
    }

    public function setSf($sf) {
        $this->sf = $sf;
    }

    public function getInvtId() {
        return $this->invtId;
    }

    public function setInvtId($invtId) {
        $this->invtId = $invtId;
    }

}
