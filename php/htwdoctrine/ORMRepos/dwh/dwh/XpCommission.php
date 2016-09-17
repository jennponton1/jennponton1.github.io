<?php

namespace Dwh;

/**
 * @Entity @Table(name="xpcommission")
 */
class XpCommission {

    /**
     * @id @column (type="string")
     */
    private $portId;

    /**
     * @column (type="decimal")
     */
    private $commPct;

    /**
     * Constructor to instantiate a new XpCommission object
     * @param type $portId
     * @param type $commPct
     */
    public function __construct($portId, $commPct) {
        $this->portId  = $portId;
        $this->commPct = $commPct;
    }

    /** getters and setters * */
    public function getPortId() {
        return $this->portId;
    }

    public function setPortId($portId) {
        $this->portId = $portId;
    }

    public function getCommPct() {
        return $this->commPct;
    }

    public function setCommPct($commPct) {
        $this->commPct = $commPct;
    }

}
