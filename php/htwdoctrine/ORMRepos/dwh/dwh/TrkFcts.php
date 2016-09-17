<?php

namespace Dwh;

/**
 * @Entity @Table(name="trkfcts")
 */
class TrkFcts {

    /**
     * @id @column(type="string")
     */
    private $siteId;

    /**
     * @column(type="string")
     */
    private $invtId;

    /**
     * @column(type="decimal")
     */
    private $inFact;

    /**
     * @column(type="decimal")
     */
    private $outFact;

    /** getter and setter methods * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getInvtId() {
        return $this->invtId;
    }

    public function setInvtId($invTid) {
        $this->invtId = $invTid;
    }

    public function getInFact() {
        return $this->inFact;
    }

    public function setInFact($inFact) {
        $this->inFact = $inFact;
    }

    public function getOutFact() {
        return $this->outFact;
    }

    public function setOutFact($outFact) {
        $this->outFact = $outFact;
    }

}
