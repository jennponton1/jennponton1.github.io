<?php

require_once "basetable.class.php";

class ARInvoice {
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp",
        "DIL"=>"adodillard",
    );

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

    public function findOpen(){
        return $this->findWhere(array("opendoc"=>"Y", "rlsed"=>"Y"));
    }

    public function findWhere($params) {
        $dsn = $this->getDSN($params);
        $ardoc = new GenericPVSWTable("ardoc", $dsn);
        $where = $ardoc->buildWhere(
            array_keys($params),
            array_values($params),
            false
        );
        $stmt = $ardoc->multiJoin(
            "a",
            array(
                "t"=>"artran"
            ),
            array(
                new JoinLink("IJ", "a.refnbr", "t.refnbr"),
                new JoinLink("IJ", "a.batnbr", "t.batnbr"),
            ),
            array(
                "header"=>array(
                    "query"=>$where,
                    "alias"=>"a"
                )
            )
        );
        //$stmt = $ardoc->findWhere($params);
        return $this->buildDataset($stmt->fetchAll());
    }

    protected function buildDataset($data) {
        $retAr = array();
        foreach($data as $row) {
            // Strip off the aliases;
            // accumulate the items
            $hdrRow = new stdClass();
            $dtlRow = new stdClass();
            foreach($row as $field => $val) {
                $tmpAr = explode("_", $field);
                switch ($tmpAr[1]) {
                    case "a":
                        // Header
                        $hdrRow->$tmpAr[0] = $val;
                        break;
                    case "t":
                        $dtlRow->$tmpAr[0]  = $val;
                        break;
                }
            }
            $key = $row->refnbr_a.$row->batnbr_a.$row->perpost_a.$row->doctype_a;
            //    throw new Exception(var_export($key, true));
            if (!isset($retAr[$key])) {
                // Accumulate detail
                $retAr[$key] = $hdrRow;
                $retAr[$key]->detail = array();
            }
            $retAr[$key]->detail[] = $dtlRow;
        }
        return array_values($retAr);
    }

    public function bulkUpdate($keys, $values) {
        $tmpDsn = $keys['dsn'];
        $dsn = $this->getDSN($keys);
        $ardoc = new GenericPVSWTable("ardoc", $dsn);
        $ardoc->update($keys, $values);
        $keys['dsn'] = $tmpDsn;
        return $this->findWhere($keys);
    }

    public function insert($values) {
        $arValues = (array) $values;
        $dsn = $this->getDSN($arValues);
        // force the values to be an array
        // detail items go into artran
        // everything else goes into ardoc
        // MUST HAVE REF # and TYPE
        if (!isset($arValues['refnbr']) || !isset($arValues['doctype'])) {
            throw new Exception("You must include a reference and a doctype for insert");
        }
        if (!isset($arValues['custid'])) {
            throw new Exception("There must be a customer assigned to this record!");
        }
        $ardoc = new GenericPVSWTable("ardoc", $dsn);
        $arTran = new GenericPVSWTable("artran", $dsn);
        $arHdrVals = (object) unserialize(serialize($arValues));
        $arDtlVals = (object) unserialize(serialize($arValues['detail']));
        unset($arHdrVals->detail);
        $ardoc->insert($arHdrVals);
        foreach($arDtlVals as $dtlRow) {
            $dtlRow->refnbr = $arHdrVals->refnbr;
            if (!isset($dtlRow->trantype)) {
                $dtlRow->trantype = $arHdrVals->doctype;
            }
            $dtlRow->batnbr = $arHdrVals->batnbr;
            $dtlRow->perpost = $arHdrVals->perpost;
            $dtlRow->perent = $arHdrVals->perpost;
            $arTran->insert($dtlRow);
        }

//        throw new Exception(
//            "Sorry, this doesn't work yet ".
//            var_export($arHdrVals, true).
//            "<hr>".
//            var_export($arDtlVals, true)
//        );
        $arHdrVals->detail = $arDtlVals;
        return $arHdrVals;
    }
}
