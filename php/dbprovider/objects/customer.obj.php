<?php

require_once "basetable.class.php";
require_once "customercontact.obj.php";

class Customer {
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp",
        "DIL"=>"adodillard",
    );

    protected $billPreferenceMap = array(
        0=>"print",
        1=>"email"
    );

    protected $fieldList = array(
        'custid'=>'c',
        'lastname'=>'c',
        'terms'=>'c',
        'crlimit'=>'c',
        "slsacct"=>"c",
        "tax1"=>"c",
        "tax2"=>"c",
        "tax3"=>"c",
        "user3"=>"c",
        "user4"=>"c",
        'addr1'=>'a',
        'addr2'=>'a',
        'city'=>'a',
        'state'=>'a',
        'zip'=>'a',
        'phone'=>'a',
        'fax'=>'a',
        'shipaddr1'=>'b',
        'shipaddr2'=>'b',
        'shipcity'=>'b',
        'shipstate'=>'b',
        'shipzip'=>'b',
        'shipphone'=>'b',
        'shipfax'=>'b',
        'ptdsales'=>"c",
        'begbal'=>"c",
        'ytdsls'=>"c",
        'ytdpymt'=>"c",
        'ytdcrmemo'=>"c",
        'ytddrmemo'=>"c",
        'ytddisc'=>"c",
        'ytdfinchrg'=>"c",

    );

    protected $fieldMap = array(
        "user3"=>"export",
        "user4"=>"billpreference",
    );

    public function __construct() {
    }

    protected function getDSN(&$params) {
        $dsn = $this->dsnMap['CEN'];
        if (isset($params['dsn'])) {
            $dsn = $this->dsnMap[$params['dsn']];
            if ($dsn == "") {
                throw new Exception("Unknown DSN ".$params['dsn']);
            }
            unset($params['dsn']);
        }
        return $dsn;
    }

    public function findOpen() {
        $priorDate = date("Y-m-d", strtotime("-1 year"));
        return $this->findWhere(array("lastactdate"=>array("op"=>"GE", "value"=>$priorDate)));
    }

    protected function stringify($params) {
        $dsn = $this->getDSN($params);
        $tmp = new GenericPVSWTable("customer", $dsn);
        return $tmp->buildWhere(
            array_keys($params),
            array_values($params),
            false
        );
    }

    public function findWhere($queryString = "") {
        $dsn = $this->getDSN($queryString);
        foreach($this->fieldMap as $column => $field) {
            if (isset($queryString[$field])) {
                $queryString[$column] = $queryString[$field];
                unset($queryString[$field]);
            }
        }
        if (is_array($queryString)) {
            $queryString = $this->stringify($queryString);
        }
        $cust = new GenericPVSWTable("customer", $dsn);
        $stmt = $cust->multiJoin(
            "c",
            array(
                "a"=>"address",
                "m"=>"multship",
                "b"=>"address",
            ),
            array(
                "c.addrid"=>"a.addrid",
                "c.custid"=>"m.custid",
                "m.addrid"=>"b.addrid",
            ),
            array( "header"=>array("query"=>"$queryString", "alias"=>"c"))
        );
        $retArray = array();
        $custContact = new CustomerContact();
        foreach($stmt as $row) {
            $rowCust = new stdClass();
            foreach($this->fieldList as $field => $alias) {
                if (substr($field, 0, 4) == 'ship') {
                    $column = substr($field, 4)."_$alias";
                }
                else {
                    $column = $field."_$alias";
                }
                if (isset($this->fieldMap[$field])) {
                    $field = $this->fieldMap[$field];
                }
                $rowCust->$field = $row->$column;
            }
            $custEmails = $custContact->findWhere(array("custid"=>$rowCust->custid, "contacttype"=>"email"));
            $emails = "";
            foreach($custEmails as $emailData) {
                if ($emails != "") {
                    $emails .= ", ";
                }
                $emails .= $emailData->contact;
            }
            if (isset($this->billPreferenceMap[$rowCust->billpreference])) {
                $rowCust->billpreference = $this->billPreferenceMap[$rowCust->billpreference];
            }
            else {
                $rowCust->billpreference = "unknown";
            }
            $rowCust->email = $emails;
            $retArray[] = $rowCust;
        }
        return $retArray;
    }

    public function update($params) { /*$params*/
        $keys = array("custid"=>$params->custid);
        $paramAr = (array) $params;
        if (isset($paramAr['billpreference'])) {
            $pref = array_search($paramAr['billpreference'],$this->billPreferenceMap);
            if ($pref === false) {
                $pref = 0;
            }
            $paramAr['user4'] = $pref;
            unset($paramAr['billpreference']);
        }
        $emailInfo = array("contact"=>$paramAr['email']);
        $emailInfo['custid'] = $paramAr['custid'];
        unset($paramAr['email']);
        $contacts = new CustomerContact();
        $contacts->delete($emailInfo);
        $contacts->insert($emailInfo);
        return $this->bulkUpdate($keys, $paramAr);

    }

    public function bulkUpdate($keys, $params) {
        $keys = (array) $keys;
        $tmpDsn = $keys['dsn'];
        $dsn = $this->getDSN($keys);
        $params = (array) $params;
        if (count($keys) < 1) {
            throw new Exception("You must pass a set of keys to run the update against");
        }
        if (count($params) < 1) {
            throw new Exception("No update values passed!");
        }
        $cust = new GenericPVSWTable("customer", $dsn);
        $cust->update($keys, $params);
        if ($tmpDsn != "") {
            $keys['dsn'] = $tmpDsn;
        }
        return $this->findWhere($keys);
    }
}
