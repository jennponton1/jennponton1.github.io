<?php

require_once "basetable.class.php";

class OrderHistory {

    protected $ordhdr;
    protected $fieldMap = array(
        "h.ordnbr",
        "h.ordtype",
        "h.bocntr",
        "h.custid",
        "h.weekended",
        "h."
    );

    public function __construct() {
        $this->ordhdr = ""; //new GenericMySqllTable("ordhdr");
    }

    protected function getSunday($date) {
        // Determine the current weekend
        $dow       = date("w", $date);
        // this is DOW with 0 == Sunday and 6 = Saturday
        $daysToEOW = 0;
        if ($dow !== "0") {
            $daysToEOW = 7 - $dow;
        }
        $dateRet = date(strtotime("+$daysToEOW days", $date));
        return $dateRet;
    }

    public function findOpen() {
        //        $this->ordhdr = new GenericPVSWTable("soopen");
        $this->ordhdr = new GenericMySqlTable("ordhdr");
        $date         = $this->getSunday(time());
        $date         = strtotime("-6 days", $date);
        $weekended    = date("Y-m-d", $date);
        //$sql = "select * From ordhdr where weekended = ?";
        $res          = $this->findWhere(array('orddate' => $weekended));
        return $res;
        throw new Exception("Cannot handle this yet open date:" . var_export($res, true));
    }

    protected function buildHeader($row) {
        $retObj = new StdClass();
        $row    = (array) $row;
        foreach ($row as $fld => $val) {
            // if the field ends in _h, then its a header item
            $right = substr($fld, strlen($fld) - 2, 2);
            if ($right === '_h') {
                $newFld          = substr($fld, 0, strlen($fld) - 2);
                $retObj->$newFld = $val;
            }
        }
        $retObj->siteid   = $row['siteid_d'];
        $retObj->custname = $row['lastname_c'];
        $retObj->detail   = array();
        return $retObj;
    }

    protected function buildDetail($row) {
        $retObj = new StdClass();
        $row    = (array) $row;
        foreach ($row as $fld => $val) {
            // if the field ends in _h, then its a header item
            $right = substr($fld, strlen($fld) - 2, 2);
            if ($right === '_d') {
                $newFld          = substr($fld, 0, strlen($fld) - 2);
                $retObj->$newFld = $val;
            }
        }
        return $retObj;
    }

    public function findWhere($parms) {
        if ($this->ordhdr === '') {
            $this->ordhdr = new GenericMySqlTable("ordhdr");
        }
        $parms     = (array) $parms;
        $weekended = "";
        if (isset($parms['weekended'])) {
            $date               = $parms['weekended'];
            $weekended          = $this->getSunday(strtotime($date));
            $weekended          = date("Y-m-d", $weekended);
            $parms['weekended'] = $weekended;
        }
        else {
            $date               = $this->getSunday(time());
            $date               = strtotime("-6 days", $date);
            $weekended          = date("Y-m-d", $date);
            $parms['weekended'] = $weekended;
        }
        $ds    = $this->ordhdr->multiJoin(
            "h",
            array(
                "d" => "orddet",
                "c" => "cust"
                //                "c"=>"htinconv",
                //                "i"=>"invent",
                //                "p"=>"htinprod"
            ),
            array(
                new JoinLink("IJ", "h.ordnbr", "d.ordnbr"),
                new JoinLink("IJ", "h.custid", "c.custid"),
                //                new JoinLink("IJ","d.invtid","c.invtid"),
                //                new JoinLink("IJ","d.invtid","i.invtid"),
                //                new JoinLink("IJ","i.classid","i.prodcat")
            ),
            array(
                "header" => array(
                    "query" => "weekended='" . $parms['weekended'] . "'",
                    "alias" => "h"
                )
            )
        );
        
        $res   = array();
        $count = 0;
        foreach ($ds as $row) {
            $row    = (object) $row;
            $ordnbr = $row->ordnbr_h . $row->bocntr_h;
            if (!isset($res[$ordnbr])) {
                $res[$ordnbr] = $this->buildHeader($row);
            }
            $res[$ordnbr]->detail[] = $this->buildDetail($row);
            $count++;
        }

        return array_values($res);

        throw new Exception("Cannot handle this yet where:" . var_export($res, true));
    }

    public function update() {
        throw new Exception("Cannot handle this yet update");
    }

    public function insert() {
        throw new Exception("Cannot handle this yet insert");
    }

    public function delete() {
        throw new Exception("Cannot handle this yet delete");
    }

}
