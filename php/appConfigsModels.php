<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class AppConfigRegistryModel extends DwhModel {
    var $critAppKey;
    var $tableName = "intranet.configregistry";

    protected $accessorNames = array(
        "appkey"=>"appkey",
        "registeredby"=>"registeredby",
        "registeredpath"=>"registeredpath",
        "registereddate"=>"registereddate",
        "archived"=>"archived"
    );

    function __construct() {
        parent::__construct();
        $this->critAppKey = "";
    }

    function setAppKey($in="") {
        if ($in == "" ) throw new HTException("You must include an application key!!", HTFRK_EX_STOP);
        $this->critAppKey = $in;

    }

    function getOpenSql(){
        $where = "where archived <> 'Y' ";
        if ($this->critAppKey != "") $where .= " and appkey = '$this->critAppKey' ";
        $sql = "select * From $this->tableName $where order by appkey ";
        return $sql;
    }

    function getInsertSql($row) {
        $sql = "insert into $this->tableName ";
        $values = "";
        $fields = "";
        foreach ($this->accessorNames as $key=>$col) {
            if ($values != "") $values .= " , ";
            $values .= "'".$row->$key."' ";
            if ($fields != "") $fields .= " , ";
            $fields  .= "$col";
        }
        $sql = $sql."($fields) values($values)";
        return $sql;
    }

    
}

class AppConfigEntryModel extends DwhModel {
    var $critAppKey;
    var $critConfigKey;
    var $tableName = "intranet.configentries";

    protected $accessorNames = array(
        "appkey"=>"appkey",
        "configkey"=>"configkey",
        "configvalue"=>"configvalue",
    );


    function setAppKey($in="") {
        if ($in == "" ) throw new HTException("You must include an application key!!", HTFRK_EX_STOP);
        $this->critAppKey = $in;
    }


    function setConfigKey($in="") {
        if ($in == "" ) throw new HTException("You must include a configuration key!!", HTFRK_EX_STOP);
        $this->critConfigKey = $in;
    }

    function __construct() {
        parent::__construct();
        $this->critAppKey = "";
        $this->critConfigKey = "";
    }


    function getOpenSql(){
        $where = "";
        if ($this->critAppKey != "") $where .= " appkey = '$this->critAppKey' ";
        if ($this->critConfigKey != "") {
                if ($where != "") $where .= " and ";
                $where .= " configkey = '$this->critConfigKey' ";
        }
        if ($where != "") $where = " where $where ";
        $sql = "select * From $this->tableName $where order by appkey,configkey ";
        return $sql;
    }

    function getDeleteSql($row) {
        $sql = "delete from $this->tableName
                where appkey = '$row->appkey' and
                 configkey = '$row->configkey' 
                ";
        return ($sql);
    }


    function getInsertSql($row) {
        $sql = "insert into $this->tableName ";
        $values = "";
        $fields = "";
        foreach ($this->accessorNames as $key=>$col) {
            if ($values != "") $values .= " , ";
            $values .= "'".$row->$key."' ";
            if ($fields != "") $fields .= " , ";
            $fields  .= "$col";
        }
        $sql = $sql."($fields) values($values)";
        return $sql;
    }



    
}

class AppConfigClassModel  {

    protected  $registry;
    protected  $entries;

    function __construct() {
        $this->registry = new AppConfigRegistryModel();
        $this->entries = new AppConfigEntryModel();
    }

    function checkRegistration($appKey = "") {
        if ($appKey == "")
            throw new HTException("You must include an application key!!!",HTFRK_EX_STOP);
        else {
            // First check that this entry is in the registry!!!
            $this->registry->setAppKey($appKey);
            $this->registry->open();
            $count = 0;
            $retArray = array();
            foreach ($this->registry as $appItem) {
                $retArray[$count]['appkey'] = $appItem->appkey;
                $retArray[$count]['regdate'] = $appItem->registereddate;
                $retArray[$count]['regby'] = $appItem->registeredby;
                $retArray[$count]['regpath'] = $appItem->registeredpath;
                $retArray[$count]['archived'] = $appItem->archived;
                $count++;

            }
            return  $retArray;
        }
    }


    function getEntries($appKey,$configKey) {
        $this->entries->close();
        $this->entries->setAppKey($appKey);
        $this->entries->setConfigKey($configKey);
        $this->entries->open();
        $retAr = array();
        foreach($this->entries as $item) {
            $retAr[] = $item->configvalue;
        }
        return $retAr;
    }


    function getConfig($appKey="",$configKey="") {
        if ($appKey == "")
            throw new HTException("You must include an application key!!!",HTFRK_EX_STOP);
        if ($configKey == "")
            throw new HTException("You must include a configuration key!!!",HTFRK_EX_STOP);

        // First check that this entry is in the registry!!!
        $regApps = $this->checkRegistration($appKey);
        if (count($regApps) == 0) {throw new HTException("There are no registrations for appkey $appKey!!!",HTFRK_EX_STOP);}

        $regKeys = array();
        $regKeys = $this->getEntries($appKey,$configKey);
        return $regKeys;
    }

    function setConfig($appKey="",$configKey="",$values = "") {
        if ($appKey == "")
            throw new HTException("You must include an application key!!!",HTFRK_EX_STOP);
        if ($configKey == "")
            throw new HTException("You must include a configuration key!!!",HTFRK_EX_STOP);
        if ( !is_array($values)  )
            throw new HTException("You must include an array of configuration values !!!",HTFRK_EX_STOP);
        $regApps = $this->checkRegistration($appKey);
        if (count($regApps) == 0) {throw new HTException("There are no registrations for appkey $appKey!!!",HTFRK_EX_STOP);}

        // At this point, it's safe to start inserting keys
        // First -- Delete all existing entries for this key
        $row = $this->entries->addNew();
        $row->appkey = $appKey;
        $row->configkey = $configKey;
        $this->entries->delete($row);
        // Now, add all the values from the values array into the table
        foreach($values as $ndx=>$val) {
            unset($row);
            $row = $this->entries->addNew();
            $row->appkey = $appKey;
            $row->configkey = $configKey;
            $row->configvalue = $val;
            $this->entries->insert($row);
        }

    }

    function registerApp($appKey = "",$path="",$date="",$user="") {
        /* TODO
         * need to add code to avoid duplicate registrations!!!
         */
        if ($appKey == "")
            throw new HTException("You must include an application key!!!",HTFRK_EX_STOP);
        $regs = $this->checkRegistration($appKey);
        if (count($regs) != 0) throw new HTException("There are already entries for this key!!!",HTFRK_EX_STOP);
        $newRegistry = $this->registry->addNew();
        $newRegistry->appkey = $appKey;
        $newRegistry->registeredpath = $path;
        $newRegistry->registereddate = $date;
        $newRegistry->registeredby = $$user;
        $this->registry->insert($newRegistry);
    }

}

?>
