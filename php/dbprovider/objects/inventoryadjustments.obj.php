<?php

require_once "basetable.class.php";

class InventoryAdjustments {
    protected $hdrKeys = array(
        "refnbr",
        "siteid",
        "adjdt",
    );

    public function findOpen() {
        // Find unposted entries
        return $this->findWhere(array("batnbr"=>""));
    }

    public function findWhere($params) {
        $criteria = (array) $params;
        $adjTbl = new GenericPVSWTable("htadjhdr");
        $fields = array_keys($criteria);
        $values = array_values($criteria);
        $whereString = $adjTbl->buildWhere($fields, $values, false);
        $stmt = $adjTbl->multiJoin(
            "a",
            array(
                new JoinTable("d", "htadjdet")
            ),
            array(
                new JoinLink(
                    "IJ",
                    "a.refnbr",
                    "d.refnbr"
                ),
                new JoinLink(
                    "IJ",
                    "a.siteid",
                    "d.siteid"
                ),
                new JoinLink(
                    "IJ",
                    "a.adjdt",
                    "d.adjdt"
                ),
            ),
            array($whereString)
        );
        $dataset = array();
        foreach($stmt as $row) {
            $key = $row->refnbr_a.$row->siteid_a.$row->adjdt;
            if (!isset($dataset[$key])) {
                $dataset[$key] = new StdClass();
                $dataset[$key]->refnbr = $row->refnbr_a;
                $dataset[$key]->siteid = $row->siteid_a;
                $dataset[$key]->adjdt = $row->adjdt_a;
                $dataset[$key]->adjcode = $row->adjcode_a;
                $dataset[$key]->explain = $row->explain_a;
                $dataset[$key]->detail = array();
            }
            $obj = $dataset[$key];
            $dtlObj = new StdClass();
            foreach($row as $prop=>$value) {
                if (substr($prop, strlen($prop)-2, 2) != '_d') {
                    continue;
                }
                $fldName = substr($prop, 0, strlen($prop)-2);
                if (in_array($fldName, $this->hdrKeys)) {
                    continue;
                }
                $dtlObj->$fldName = $value;
            }
            $obj->detail[] = $dtlObj;
        }
        return array_values($dataset);
    }

    public function insert($insValues) {
        $values = (array) $insValues;
        $dtlValues = $values['detail'];
        unset($values['detail']);
        $adjhdr = new GenericPVSWTable("htadjhdr");
        $adjdet = new GenericPVSWTable("htadjdet");
        $res = $adjhdr->insert($values);
        foreach($dtlValues as $dtlLine) {
            $dtlAr = (array) $dtlLine;
            foreach($this->hdrKeys as $key) {
                $dtlAr[$key] = $values[$key];
            }
            $adjdet->insert($dtlAr);
        }
        $keyList = array();
        foreach($this->hdrKeys as $key) {
            $keyList[$key] = $values[$key];
        }
        return $this->findWhere($keyList);

    }


}
