<?php

require_once "basetable.class.php";

class CustomerContact {
    protected $tbl = null;
    public function __construct() {
        // for now, do nothing
        $this->tbl = new GenericMySqlTable("custcontact");
    }

    public function findOpen() {
        return $this->findWhere(array("custid"=>"%"));
    }

    public function findWhere($criteria) {
        $ds = $this->tbl->findWhere($criteria);
        $ret = array();
        foreach($ds as $row) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function update($values) {
        $valAr = (array) $values;
        $keys = array("custid"=>$valAr['custid']);
        $emailAr = split(",", $valAr['contact']);
        $this->tbl->delete(array($keys));
        foreach($emailAr as $addr) {
            $this->insert(
                array(
                    "custid"=>$keys['custid'],
                    "contact"=>$addr
                )
            );
        }
        return $this->findWhere($keys);
    }


    public function insert($values) {
        // assume all email for now
        $testAr = (array) $values;
        if (!isset($testAr['custid'])) {
            throw new Exception("You must include a customer id!");
        }
        $newContact = new StdClass();
        foreach($values as $prop=>$value) {
            $newContact->$prop = $value;
        }
        $newContact->contacttype = 'email';
        $this->tbl->insert($newContact);
        return $this->findWhere((array("custid"=>$testAr['custid'])));
    }

    public function delete($values) {
        $valueAr = (array )$values;
        if (!isset($valueAr['custid'])) {
            throw new Exception("You must include a customer id!");
        }
        $this->tbl->delete(array("custid"=>$valueAr['custid']));
    }
}

