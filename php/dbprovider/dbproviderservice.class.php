<?php

require_once "objects/dbodbcBase.class.php";
require_once "objects/dbdoctrineBase.class.php";
require_once "objects/dbpdobase.class.php";

require_once "objects/sqlbuilder.class.php";
//require_once "dbproviderservice.class.php";

/**
 *  This is the dbProvider main class.
 *  @link DbProvider PHP API.
 *  @link DBProviderSvcApp HTML API.
 *
 *  DbProvider is the PHP API.
 *  DbProviderSvcApp is the HTTP API
 *
 */
class DBProviderService {

    public function __construct() {
        // Reserve for future usage
    }

    public function isKnown($object = '') {
        return ( file_exists(dirname(__FILE__) . "/objects/$object.obj.php"));
    }

    private function checkObject($object) {
        if (!$this->isKnown($object)) {
            throw new Exception("Unknown object $object");
        }
    }

    public function getObject($object = "", $method = "", $crit = "") {
        $this->checkObject($object);
        if ($method == "") {
            throw new Exception("You must include a method!!");
        }
        require_once dirname(__FILE__) . "/objects/$object.obj.php";
        $obj = new $object();
        $dataSet = $obj->$method($crit);
        return $dataSet;
    }

    public function insertObject($object = "", $values = "") {
        $this->checkObject($object);
        require_once dirname(__FILE__) . "/objects/$object.obj.php";
        $obj = new $object();
        $resp = $obj->insert($values);
        return $resp;
    }

    public function deleteObject($object = "", $values = "") {
        $this->checkObject($object);
        require_once dirname(__FILE__) . "/objects/$object.obj.php";
        $obj = new $object();
        $resp = $obj->delete($values);
        return $resp;
    }

    public function updateObject($object = "", $values = "") {
        $this->checkObject($object);
        require_once dirname(__FILE__) . "/objects/$object.obj.php";
        $obj = new $object();
        $resp = $obj->update($values);
        return $resp;
    }

    public function listObjects() {
        $list = array();
        $dir = dir(dirname(__FILE__) . "/objects");
        $count = 0;
        while (($tmp = $dir->read() ) && $count < 1000) {
            // Check for .obj.php in the file name
            $file = strtolower($tmp);
            $findExt = strpos($file, ".obj.php");
            if ($findExt !== false) {
                $file = substr($file, 0, $findExt);
                $list[] = $file;
            }
            $count++;
        }
        return $list;
    }

    public function bulkUpdate($object = null, $keys = null, $values = null) {
        $this->checkObject($object);
        if ($keys === null) {
            throw new Exception("You must include a keys array to use this method!");
        }
        require_once __DIR__."/objects/$object.obj.php";
        $obj = new $object();
        $resp = $obj->bulkUpdate($keys, $values);
        return $resp;
    }

    public function callMethod($object = null, $method = null, $parms = null) {
        if ($object == null || $method == null) {
            throw new Exception("You must pass an object and a methodname to this method");
        }
        require_once __DIR__."/objects/$object.obj.php";
        $obj = new $object();
        if (method_exists($obj, $method)) {
            $resp = $obj->$method($parms);
        }
        else {
            throw new Exception("Unknown method");
        }
        return $resp;
    }
}
