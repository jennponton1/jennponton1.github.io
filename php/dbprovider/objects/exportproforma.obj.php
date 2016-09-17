<?php

require_once "basetable.class.php";

class ExportProforma {
    public function findOpen(){
        return $this->findWhere(array("pfinvcnbr"=>"%"));
    }

    public function findWhere($params) {
        $paramAr = (array) $params;
        $tbl = new GenericPVSWTable("htpfihdr");
        $res = $tbl->multiJoin(
            "h",
            array(
                "d"=>"htpfidet",
            ),
            array(
                new JoinLink(
                    "IJ","h.pfinvcnbr", "d.pfinvcnbr"
                )
            ),
            array(
                "header"=>array(
                    "query"=>$sql,
                    "alias"=>"h"
                )
            )
        );
        throw new Exception("I SAID BOOM!");
    }
}
