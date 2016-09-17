<?php

require_once "basetable.class.php";

class ExportInvoice {

    public function findWhere($params) {
        $tbl      = new GenericPVSWTable("htxpihdr");
        $sql = $tbl->buildWhere(array_keys($params), array_values($params), false);
        $res      = $tbl->multiJoin(
            "h",
            array(
                "d" => "htxpidet",
            ),
            array(
                new JoinLink(
                    "IJ",
                    "h.invcnbr",
                    "d.invcnbr"
                )
            ),
            array(
                "header"=>array(
                    "query"=>$sql,
                    "alias"=>"h"
                )
            )
        );
        $retArray = array();
        foreach ($res as $row) {
            $invcnbr = $row->invcnbr_h;
            if (!isset($retArray[$invcnbr])) {
                $obj = new StdClass();
                foreach ($row as $prop => $val) {
                    $field = substr($prop, 0, strlen($prop) - 2);
                    if (substr($prop, strlen($prop) - 2, 2) == '_h') {
                        $obj->$field = $val;
                    }
                }
                $obj->detail = array();
            }
            else {
                $obj = $retArray[$invcnbr];
            }
            $detObj = new StdClass();
            foreach($row as $prop => $val) {
                $field = substr($prop, 0, strlen($prop) - 2);
                if ($field == 'invcnbr') {
                    continue;
                }
                if (substr($prop, strlen($prop) - 2, 2) == '_d') {
                    $detObj->$field = $val;
                }
            }
            $obj->detail[] = $detObj;
            $retArray[$invcnbr] = $obj;
        }
        return array_values($retArray);
    }
}
