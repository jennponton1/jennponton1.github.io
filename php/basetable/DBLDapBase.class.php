<?php

class DBLDAPBase {

    public $ldapServer;

    public function __construct($server = "10.1.1.5") {
        $this->ldapServer = $server;
        $this->conn = ldap_connect($this->ldapServer);
    }

    public function runQuery($parms = null) {
        $ldapConn = $this->conn;
        if ($ldapConn == null || $parms == null) {
            throw new Exception("You must pass both an ldap Server and a value to the find method!");
        }
        $search = ldap_search($ldapConn, "o=htwp.com,c=US", $parms);
        $res = ldap_get_entries($ldapConn, $search);

        return $res;
    }

    public function findOpen() {
        throw new Exception("You must implement this at the class level");
    }

    public function findWhere() {
        throw new Exception("You must implement this at the class level");
    }

}
