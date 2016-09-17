<?php

class UnpostedTreatingItems {
    protected $siteAr = array(
        "THO"=>"10.0.0.244",
        "PB"=>"192.168.11.244",
        "MIL"=>"192.168.13.244",
        "DET"=>"192.168.14.240",
        "WIN"=>"192.168.15.134",
    );
    public function __construct() {
    }

    public function findOpen() {
        return $this->findWhere(array("uploaded!"=>0));
    }

    public function findWhere($criteria) {
        $criteria = (array) $criteria;
        if (!isset($criteria['siteid'])) {
            throw new Exception("You must provide a siteid for this object ");
        }
        $host = $this->siteAr[strtoupper($criteria['siteid'])];
        unset($criteria['siteid']);
        $url = "http://$host/dbprovidersvc/dbproxy.php?do=get&object=wipbeforekiln";
        if (count($criteria) > 0) {
            $critString = json_encode($criteria);
            $url .= "&criteria_values=".$critString;
        }
        $dbProvResult = file_get_contents($url);
        $resultSet = json_decode($dbProvResult);
        if ($resultSet === null) {
            return array();
        }
        if ($resultSet->status != "SUCCESS") {
            throw new Exception($resultSet->message);
        }

        return $resultSet->data;

    }
}
