<?php

namespace Dwh;

/**
 * @Entity @Table(name="statvals") 
 */
class StatVals {

    /**
     * @id @column
     */
    private $status;

    /**
     * @id @column
     */
    private $rank;

    /** getter and setter methods * */
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getRank() {
        return $this->rank;
    }

    public function setRank($rank) {
        $this->rank = $rank;
    }

}
