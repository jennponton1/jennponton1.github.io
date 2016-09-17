<?php

require_once "dbutils.php";
/**
*  @uses DBProviderService  to get objects
 *
 * PHP API into dbprovider service
 *
*/
class DbProvider {

    const PROVIDER_URL = "http://devjp.htwp.com/dbprovidersvc/dbprovider.php";
    private $isLocal = false;
    const ALLOW_CLI = false;
    private $dbProvider = null;

    public function __construct() {
        // eventually might do something
        $dbHost = parse_url(self::PROVIDER_URL, PHP_URL_HOST);
        if ($dbHost == $_SERVER['HTTP_HOST'] || (self::ALLOW_CLI && php_sapi_name() == 'cli')) {
            // I am the local host... I can call locally
            require_once "dbproviderservice.class.php";
            require_once "retobject.class.php";
            $this->dbProvider = new DBProviderService();
            $this->isLocal = true;
        }
    }

    protected function decodeResponse($jsonResponse) {
        $retObj = json_decode($jsonResponse);
        if ($retObj != null) {
            if ($retObj->status == "FAILED") {
                throw new Exception("DB Call failed: " . $retObj->message);
            }
            return $retObj;
        }
        else {
            throw new Exception("DB Call failed - json response was " . $jsonResponse);
        }
    }

    protected function checkCriteria($criteria) {
        if (!is_array($criteria)) {
            throw new Exception("The Criteria paramater MUST be an array!");
        }
    }

    protected function checkObject($values) {
        if (!is_object($values)) {
            throw new Exception("The values parameter MUST be an object!");
        }
    }

    protected function createCurl($action, $crit, $object, $critval) {
        $ret = curl_init();
        curl_setopt($ret, CURLOPT_URL, self::PROVIDER_URL);
        curl_setopt($ret, CURLOPT_POST, true);
        curl_setopt($ret, CURLOPT_RETURNTRANSFER, true);
        switch ($action) {
            case "insert":
                $valKey = "values";
                break;
            default:
                $valKey = "criteria_values";
        }
        curl_setopt(
            $ret,
            CURLOPT_POSTFIELDS,
            array(
                "do" => $action,
                "object" => $object,
                "criteria" => $crit,
                "$valKey" => json_encode($critval)
                )
        );
        return $ret;
    }

    public function findOpen($object) {
        if ($this->isLocal) {
            $resp = $this->dbProvider->getObject($object, "findOpen");
            $retObj = new RetObject();
            $resp = json_decode(json_encode($resp));
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully read");
        }
        else {
            $curlHandle = $this->createCurl("get", "_OPEN_", $object, "");
            $jsonResponse = curl_exec($curlHandle);
            $retObj = $this->decodeResponse($jsonResponse);
        }
        return $retObj;
    }

    public function findWhere($object, $criteria) {
        $this->checkCriteria($criteria);
        if ($this->isLocal) {
            $resp = $this->dbProvider->getobject($object, "findWhere", $criteria);
            $resp = json_decode(json_encode($resp));
            $retObj = new RetObject();
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully read");
        }
        else {
            $curlHandle = $this->createCurl("get", "_JSON_", $object, $criteria);
            $jsonResponse = curl_exec($curlHandle);
            $retObj = $this->decodeResponse($jsonResponse);
        }
        return $retObj;
    }

    public function getCount($object) {
        $curlHandle = $this->createCurl("get", "_COUNT_", $object);
        $jsonResponse = curl_exec($curlHandle);
        $retObj = $this->decodeResponse($jsonResponse);
        return $retObj;
    }

    public function updateObject($object, $updateValues) {
        return $this->updateWhere($object, $updateValues);
    }

    public function updateWhere($object, $updateValues) {
        $this->checkObject($updateValues);
        if ($this->isLocal) {
            $resp = $this->dbProvider->updateObject($object, $updateValues);
            $retObj = new RetObject();
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully read");
        }
        else {
            throw new Exception("NOT YET IMPLEMENTED");
        }
        return $retObj;
    }

    public function insertObject($object, $insertValues) {
        $this->checkObject($insertValues);
        if ($this->isLocal) {
            $resp = $this->dbProvider->insertObject($object, $insertValues);
            $retObj = new RetObject();
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully inserted");
        }
        else {
            $curlHandle = $this->createCurl("insert", "", $object, $insertValues);
            $jsonResponse = curl_exec($curlHandle);
            $retObj = $this->decodeResponse($jsonResponse);
        }
        return $retObj;
    }

    public function deleteWhere($object, $criteria) {
        $this->checkCriteria($criteria);
        if ($this->isLocal) {
            $result = $this->dbProvider->deleteObject($object, $criteria);
            $retObj = new RetObject();
            $retObj->setData($result);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully deleted");
        }
        else {
            $object = "";
            throw new Exception("NOT YET IMPLEMENTED");
        }
    }

    public function getURL() {
        return self::PROVIDER_URL;
    }

    public function getObjectList() {
        return $this->dbProvider->listObjects();
    }

    public function callMethod($object, $methodName, $values) {
        if ($this->isLocal) {
            $resp = $this->dbProvider->callMethod($object, $methodName, $values);
            $retObj = new RetObject();
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully called");
            return $retObj;
        }
        else {
            throw new Exception("Not yet available");
        }
    }

    public function bulkUpdate($object, $keys, $values) {
        $this->checkObject((object) $keys, "You must provide a set of keys to be updated");
        $this->checkCriteria($values);
        if ($this->isLocal) {
            $resp = $this->dbProvider->bulkUpdate($object, $keys, $values);
            $retObj = new RetObject();
            $retObj->setData($resp);
            $retObj->setStatus("SUCCESS");
            $retObj->setMessage("Successfully updated");
        }
        else {
            throw new Exception("Not yet available for http");
            $curlHandle = $this->createCurl("bulkUpdate", "", $object, $values);
            $jsonResponse = curl_exec($curlHandle);
            $retObj = $this->decodeResponse($jsonResponse);
        }
        return $retObj;
    }

}
