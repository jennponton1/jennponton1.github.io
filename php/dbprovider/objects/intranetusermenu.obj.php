<?php

class IntranetUserMenu extends DBDoctrineBase {
    public function __construct($dsn = "Intranet") {
        parent::__construct($dsn);
        
    }
    
    public function findOpen() {
        throw new Exception("This object is not currently compatible with findOpen!");
    }
    
    public function findWhere($parms) {
        require_once "dbprovider/dbprovider.inc.php";
        $dbProvider = new DbProvider();
        // Get the userid
        if (!is_array($parms) || !isset($parms['userid'])) {
            throw new Exception("You must pass an array of values including the userid to this method");
        }
        $user = $dbProvider->findWhere("intranetuser", array("uid"=>$parms['userid']));
        if (count($user->data) == 0) {
            $retArray = array();
            return $retArray;
        }
        $groupStr = "";
        //throw new Exception("stopping ".var_export($user->data[0], true));
        foreach($user->data[0]->groups as $group) {
            if ($groupStr != "") {
                $groupStr .= ", ";
            }
            $groupStr .= " '$group->group' ";
        }
        // OK, we have the user and all of his groups
        // Build the Menu
        $sql = "select DISTINCT
                  c.category,
                  s.subcat,
                  m.menudescr,
                  m.menulink
                from Intranet\\menutable m, Intranet\\menucategories c , 
                Intranet\\subcats s,
                Intranet\\menupermissions p, Intranet\\groups g
                
                where m.categoryid=c.categoryid and 
                m.subcatid=s.subcatid and
                m.menuitemid=p.menuitemid and 
                p.groupid = g.groupid and
                g.groupname in ($groupStr)
                order by c.categorysort, s.subcatsort, m.menudescr
                ";
        $res = $this->eMgr->createQuery($sql)->getArrayResult();
        $resSet = array();
        foreach($res as $row) {
            $cat = $row['category'];
            $subcat = $row['subcat'];
            if (!isset($resSet[$cat.$subcat])) {
                $menuObj = new stdClass();
                $resSet[$cat.$subcat] = $menuObj;
                $resSet[$cat.$subcat]->category = $cat;
                $resSet[$cat.$subcat]->subcat = $subcat;
                $resSet[$cat.$subcat]->items = array();
            }
            $menuItem = new stdClass();
            $menuItem->menudescr = $row['menudescr'];
            $menuItem->menulink = $row['menulink'];
            $resSet[$cat.$subcat]->items[] = $menuItem;
        }
        
        return array_values($resSet);
    }
}
