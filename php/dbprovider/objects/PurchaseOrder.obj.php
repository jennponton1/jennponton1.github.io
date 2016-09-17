<?php

require_once "basetable.class.php";

class PurchaseOrder {
    protected $fieldList = array(
        "ponbr"=>"h",
        "vendid"=>"h",
        "buyer"=>"h",
        "openpo"=>"h",
        "shipvia"=>"h",
        "confirmto"=>"h",
        "lastname"=>"v",
        "user1"=>"h",
        "fob"=>"h",
        "podate"=>"h",
        "linenbr"=>"d",
        "invtid"=>"d",
        "trandesc"=>"d",
        "lineid"=>"d",
        "siteid"=>"d",
        "dtlar"=>array("user1"=>"d"),
        "purchunit"=>"d",
        "qtyord"=>"d",
        "qtyrcvd"=>"d",
        "unitcost"=>"d",
        "bf"=>"c",
        "sf"=>"c",
        "cnvfact"=>"d",
    );
    protected $fieldsMap = array(
        // "column"=>"field"
        "user1_h"=>"expdate",
        "trandesc_d"=>"descr",
        "lastname_v"=>"vendlastname",
        "user1_d"=>"assignmt",
    );
    protected $purchord;

    public function __construct() {
        $this->purchord = new GenericPVSWTable("purchord");
    }

    protected function parseParams($params) {
        $hdrQuery = "";
        $dtlQuery = array();
        $opValMap = array(
            "openpo"=>array(
                "op"=>"="
            ),
            "ponbr"=>array(
                "op"=>"=",
            ),
            "vendid"=>array(
                "op"=>"like",
            ),
            "shipvia"=>array(
                "op"=>"like",
            ),
            "podate"=>array(
                "op"=>">=",
            ),
        );
        foreach($params as $key => $val) {
            if (isset($opValMap[$key])) {
                $op = $opValMap[$key]['op'];
                $hdrQuery = appendFieldList(" $key $op '$val' ", $hdrQuery, " and ");
                continue;
            }
            switch ($key) {
                case "siteid":
                    $siteStr = substr($val, 0, 1);
                    $hdrQuery = appendFieldList(" ponbr like '$siteStr%' ", $hdrQuery, " and ");
                    break;
                case 'assignmt':
                    $val = substr($val, 1);
                    $dtlQuery[] = " d.user1 like '%$val%' ";
                    break;
                case 'invtid':
                    $val = substr($val, 0, 1).'%'.substr($val, 4);
                    $dtlQuery[] = " d.invtid like '%$val%' ";
                    break;
                default:
                    throw new Exception("NOT IMPLEMENTED IN THIS CLASS");
            }
        }
        if ($hdrQuery != "") {
            $dtlQuery['header'] = array("query"=>$hdrQuery, "alias"=>"h");
        }
        return $dtlQuery;
    }

    public function findWhere($params) {
        $criteria = $this->parseParams($params);
        $stmt = $this->purchord->multiJoin(
            "h",
            array(
                "d"=>"purdtl",
                "c" => "htinconv",
                new JoinTable("v", "vendor", array("lastname")),
            ),
            array(
                new JoinLink("IJ", "h.ponbr", "d.ponbr"),
                new JoinLink("OJ", "d.invtid", "c.invtid"),
                new JoinLink("OJ", "h.vendid", "v.vendid"),
            ),
            $criteria
        );
        $dataSet = array();
        foreach($stmt as $row) {
            $headerItem = new StdClass();
            $detailItem = new StdClass();
            foreach($this->fieldList as $field => $alias) {
                // check for mapped field
                if (is_array($alias)) {
                    $field = key($alias);
                    $alias2 = $alias[$field];
                    $alias = $alias2;
                }
                $dsName =  $field."_".$alias;
                if (isset($this->fieldsMap[$dsName])) {
                    $field = $this->fieldsMap[$dsName];
                }
                if (in_array($alias, array("h","v"))) {
                    $headerItem->$field = $row->$dsName;
                }
                else {
                    $detailItem->$field = $row->$dsName;
                }
            }
            $headerItem->detail = array();
            $hash = serialize($headerItem);
            // throw new Exception(var_export($hash, true));
            if (!isset($dataSet[$hash])) {
                $dataSet[$hash] = $headerItem;
            }
            $dataSet[$hash]->detail[] = $detailItem;
        }
        return array_values($dataSet);

    }

    public function findOpen() {
        return $this->findWhere(array("openpo"=>"Y"));
    }

    public function bulkUpdate($keys, $updValues) {
        //$dsn = $this->getDSN((array) $keys);
        //$keys = (array) ($dsn->parms);
        $potable = new GenericPVSWTable("purchord"); // @todo add DSN , $this->dsn);
        if ($keys === null) {
            throw new Exception("You must provide a set of keys");
        }
        if ($keys === null) {
            throw new Exception("You must provide a set of values for the update");
        }
        return $potable->update($keys, $updValues);
    }


}
