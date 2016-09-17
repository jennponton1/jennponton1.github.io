<?php


require_once "basetable.class.php";

class Intranetuser extends DBLDAPBase {

    public function __construct() {
        parent::__construct();
    }

    public function constructDataset($res) {
        $results = array();
        for ($ndx = 0; $ndx < $res['count']; $ndx++) {
            $entry = $res[$ndx];
            $item = array();
            $item['name'] = $entry['cn'][0];
            $item['email'] = $entry['mail'][0];
            $item['uid'] = $entry['uid'][0];
            $item['dept'] = $entry['ou'][0];
            $item['manager'] = $entry['manager'][0];
            $item['dn'] = $entry['dn'];
            $item['groups'] = array();
            $dn = $entry['dn'];
            $groupSearch = ldap_search($this->conn, "o=htwp.com,c=US", "member=$dn");
            $groupAr = ldap_get_entries($this->conn, $groupSearch);
            for ($gNdx = 0; $gNdx < $groupAr['count']; $gNdx++) {
                $group = $groupAr[$gNdx];
                $item['groups'][] = array("group"=>$group['cn'][0]);
            }
            //throw new Exception(var_export($item, true));
            $results[] = $item;
        }
        return $results;
    }

    public function findOpen() {
        $searchAr = $this->runQuery("objectclass=inetOrgPerson");
        $results = $this->constructDataset($searchAr);
        return $results;
    }

    public function findWhere($critAr = "") {
        if (!is_array($critAr)) {
            throw new Exception("You must pass an array to this method!!");
        }
        $searchStr = "";
        foreach ($critAr as $key => $val) {
            switch ($key) {
                case "email":
                    $searchStr .= "mail=$val";
                    break;
                case "uid":
                    $searchStr .= "uid=$val";
                    break;
                case "manager":
                    $searchStr .= "manager=$val";
                    break;
                default:
                    throw new Exception("Not implemented!!");
            }
        }
        $res = $this->runQuery($searchStr);
        $results = $this->constructDataset($res);
        return $results;
    }

}
