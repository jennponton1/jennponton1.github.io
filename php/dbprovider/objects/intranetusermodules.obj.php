<?php

require_once "basetable.class.php";

class IntranetUserModules {
    protected $modulesTable;
    public function __construct() {
        $this->modulesTable = new GenericMySqlTable("my_modules", "intranet");
    }
    
    public function constructDataset($stmt) {
        $retAr = array();
        foreach($stmt as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }
    
    public function findOpen() {
        $stmt = $this->modulesTable->directQuery("select * From std_modules", array());
        return $this->constructDataset($stmt);
    }
    
    public function findWhere($parms) {
        $stdModules = $this->findOpen();
        $parms = (array) $parms;
        $userId = $parms['userid'];
        if ($userId == "") {
            $userId = $parms['uid'];
        }
        if ($userId == "") {
            throw new Exception("You must include a userid!");
        }
        // Get the user's groups
        require_once "intranetuser.obj.php";
        $userObj = new IntranetUser();
        $userData = $userObj->findWhere(array("uid"=>$userId));
        $groups = "";
        if (count($userData) > 0) {
            $userObj = (object) $userData[0];
            foreach($userObj->groups as $group) {
                $group = (object) $group;
                $groups = appendFieldList("'$group->group'", $groups);
            }
        }
        $stmt = $this->modulesTable->findWhere(array("userid"=>"$userId"));
        $userMods =  $this->constructDataset($stmt);
        $stmt = $this->modulesTable->directQuery("select * from my_modules where userid in ($groups)", array());
        $totalAr = array_merge($stdModules, $userMods, $this->constructDataset($stmt));
        
        
        return $totalAr;
    }
}
