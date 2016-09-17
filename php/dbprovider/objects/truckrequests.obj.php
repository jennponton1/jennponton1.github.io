<?php

require_once "basetable.class.php";

class TruckRequests {
    protected $trkReq;
    public $dataSet;


    public function __construct() {
        $this->trkReq = new GenericMySqlTable("trkreqhdr");
        $this->dataSet = array();
    }

    public function findOpen() {
        return $this->findWhere(array("covered"=>"N"));
    }

    protected function parseParams($criteria = '') {
        $newCrit = array();
        $hdrQuery = "";
        foreach((array) $criteria as $ndx => $val) {
            $ndx = strtolower($ndx);
            switch ($ndx) {
                case "closed":
                    $newCrit['closed'] = 'Y';
                    break;
                case "covered":
                    $hdrQuery = appendFieldList(" covered = '$val' ", $hdrQuery, " and ");
                    break;
                case "shipdirection":
                    $hdrQuery = appendFieldList(" shipdirection = '$val' ", $hdrQuery, " and ");
                    break;
                case "siteid":
                    $hdrQuery = appendFieldList(" siteid = '$val' ", $hdrQuery, " and ");
                    break;
                case "trknbr":
                    $hdrQuery = appendFieldList(" trknbr = '$val' ", $hdrQuery, " and ");
                    break;
                case "custid":
                case "ordnbr":
                    $newCrit[] = " d.$ndx = '$val' ";
                    break;
                default:
                    // do Nothing
                    //$newCrit[$ndx] = $val;
            }
        }
        if ($hdrQuery !== "") {
            $newCrit['header'] =  array("query"=>$hdrQuery, "alias"=>"h");
        }
        return $newCrit;
    }

    protected function addToDataset($resSet) {
        if (!isset($this->dataSet)) {
            $this->dataSet = array();
        }
        foreach($resSet as $row) {
            $key = $row->trknbr_h;
            $newRow = new stdClass();
            $dtlRow = new StdClass();
            foreach($row as $prop => $val) {
                $alias = substr($prop, strlen($prop)-1, 1);
                $field = substr($prop, 0, strlen($prop)-2);
                switch ($alias) {
                    case "h":
                    case "c":
                        $newRow->$field = $val;
                        break;
                    case 'd':
                        $dtlRow->$field = $val;
                        break;
                }
            }
            if (!isset($this->dataSet[$key])) {
                if (!isset($newRow->lastname)) {
                    $newRow->lastname = '';
                }
                $newRow->detail = array();
                $this->dataSet[$key] = $newRow;
            }
            $this->dataSet[$key]->detail[] = $dtlRow;
        }
        return $this->dataSet;
    }

    protected function buildBaseJoin() {
        $linkTables = array(
            "d"=>"trkreqdet"
        );
        $linkJoins = array(
                new JoinLink("IJ", "h.trknbr", "d.trknbr"),
        );
        $joinObject = new StdClass();
        $joinObject->tables = $linkTables;
        $joinObject->links = $linkJoins;
        return $joinObject;
    }

    public function getOrderTrucks($criteria) {
        $join = $this->buildBaseJoin();
        $criteria[] = "h.covered <> 'D' ";
        $linkTables = $join->tables;
        $linkJoins = $join->links;
        $linkTables["s"] = "soblhdr";
        $linkTables[] = new JoinTable("c", "cust", array("lastname"));

        $linkJoins[] = new JoinLink("IJ", "d.ordnbr", "s.ordnbr");
        $linkJoins[] = new JoinLink("IJ", "d.custid", "c.custid");

        //throw new Exception(var_export($criteria, true));
        $resSet = $this->trkReq->multiJoin(
            "h",
            $linkTables,
            $linkJoins,
            $criteria
        );
        return $resSet;
    }

    public function getInboundTrucks($criteria) {
        $criteria[] = "h.shipdirection = 'in' ";
        $criteria[] = "h.covered <> 'D' ";
        $join = $this->buildBaseJoin($criteria);
        $resSet = $this->trkReq->multiJoin(
            "h",
            $join->tables,
            $join->links,
            $criteria
        );
        return $resSet;
    }

    public function getPlywallTrucks($criteria) {
        $criteria[] = "d.custid = 'Plywall' ";
        $criteria[] = "h.covered <> 'D' ";
        $join = $this->buildBaseJoin($criteria);
        $resSet = $this->trkReq->multiJoin(
            "h",
            $join->tables,
            $join->links,
            $criteria
        );
        return $resSet;
    }

    public function getDataSet() {
        ksort($this->dataSet);
        //throw new Exception(var_export($this->dataSet, true));
        return array_values($this->dataSet);
    }

    public function findWhere($criteria = '') {
        $criteria = $this->parseParams($criteria);
        $this->addToDataset($this->getOrderTrucks($criteria));
        $this->addToDataset($this->getInboundTrucks($criteria));
        $this->addToDataSet($this->getPlywallTrucks($criteria));
        return $this->getDataSet();
        //throw new Exception("Not yet available ".var_export($resSet, true));
    }
}
