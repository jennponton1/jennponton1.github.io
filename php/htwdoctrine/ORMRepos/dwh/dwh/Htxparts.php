<?php

namespace Dwh;

/**
 * @Entity @Table(name="htxparts")
 */
class Htxparts {

    /**
     * @id @column(type="string")
     */
    private $invTid;

    /**
     * @column(type="string")
     */
    private $netPrtDesc;

    /**
     * @column(type="decimal")
     */
    private $netFac;

    /**
     * @column(type="string")
     */
    private $m3PrtDesc;

    /**
     * @column(type="decimal")
     */
    private $m3Fac;

    /**
     * @column(type="decimal")
     */
    private $len;

    /**
     * @column(type="decimal")
     */
    private $thk;

    /**
     * @column(type="decimal")
     */
    private $wid;

    /** getter and setter methods * */
    public function getInvTid() {
        return $this->invTid;
    }

    public function setInvTid($invTid) {
        $this->invTid = $invTid;
    }

    public function getNetPrtDesc() {
        return $this->netPrtDesc;
    }

    public function setNetPrtDesc($netPrtDesc) {
        $this->netPrtDesc = $netPrtDesc;
    }

    public function getNetFac() {
        return $this->netFac;
    }

    public function setNetFac($netFac) {
        $this->netFac = $netFac;
    }

    public function getM3PrtDesc() {
        return $this->m3PrtDesc;
    }

    public function setM3PrtDesc($m3PrtDesc) {
        $this->m3PrtDesc = $m3PrtDesc;
    }

    public function getM3Fac() {
        return $this->m3Fac;
    }

    public function setM3Fac($m3Fac) {
        $this->m3Fac = $m3Fac;
    }

    public function getLen() {
        return $this->len;
    }

    public function setLen($len) {
        $this->len = $len;
    }

    public function getThk() {
        return $this->thk;
    }

    public function setThk($thk) {
        $this->thk = $thk;
    }

    public function getWid() {
        return $this->wid;
    }

    public function setWid($wid) {
        $this->wid = $wid;
    }

}
