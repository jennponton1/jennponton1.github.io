<?php

require_once "basetable.class.php";

class SalesorderTax {
    protected $hdrFields = array(
        "refnbr",
        "taxtype",
        "custvendid",
        "doctype",
        "bocntr",
        "taxid1",
        "taxid2",
        "taxid3",
        "taxtot1",
        "taxtot2",
        "taxtot3",
    );
    protected $keyFields = array(
        "refnbr",
        "taxtype",
        "custvendid",
        "doctype",
        "bocntr",
    );
    
    protected $dtlFields = array(
        "taxcat",
        "tax1",
        "tax2",
        "tax3",
        "taxamt1",
        "taxamt2",
        "taxamt3",
        "lineid",
        "taxbasis1",
        "taxbasis2",
        "taxbasis3",
        
    );


    public function __construct() {
        
    }
    
    public function findOpen() {
        throw new Exception("Not ready");
    }
    
    protected function buildKey($data) {
        $key = "";
        foreach($this->keyFields as $fld) {
            $key .= $data->$fld;
        }
        return $key;
    }


    public function findWhere($criteria) {
        $criteria = (array) $criteria;
        $docsTable = new GenericPVSWTable("docstax");
        $dtlsTable = new GenericPVSWTable("dtlstax");
        $sqlWhere = "";
        foreach($criteria as $fld => $value) {
            if ($sqlWhere !== "") {
                $sqlWhere .= " and ";
            }
            $op = "=";
            if (strpos($value, "%") !== false) {
                $op = " like  ";
            }
            $sqlWhere  .= " $fld $op '$value' ";
                
        }
        //$ret = $docsTable->findWhere($criteria);
        $ret = $docsTable->join(
            $dtlsTable,
            array(
                "refnbr"=>"refnbr",
                "custvendid"=>"custvendid",
                "taxtype"=>"taxtype",
                "doctype"=>"doctype",
                "bocntr"=>"bocntr"
            ),
            array("header"=>$sqlWhere)
        );
        //$ret2 = $dtlsTable->findWhere($criteria);
        $retAr = array();
        foreach($ret as $dataRow) {
            $key = $this->buildKey($dataRow);
            if (!isset($retAr[$key])) {
                $hdr = array();
                foreach($this->hdrFields as $field) {
                    $hdr[$field] = $dataRow->$field;
                }
                $hdr['detail'] = array();
                $retAr[$key] = (object) $hdr;
            }
            $dtl = new StdClass();
            foreach($this->dtlFields as $field) {
                $dtl->$field = $dataRow->$field;
            }
            $retAr[$key]->detail[] = $dtl;
        }
        //throw new Exception(var_export($ret, true));
        return array_values($retAr);
    }
    
    public function insert($insValues) {
        // Check for special control items
        $insValues = (array) $insValues;
        $docsTable = new GenericPVSWTable("docstax");
        if (isset($insValues['ordnbr'])) {
            // Handle adding the salestax for a salesorder
            // HAVE TO HAVE -- Ordtype and bocntr and custid
            $ordnbr = $insValues['ordnbr'];
            $ordtype = $insValues['ordtype'];
            $bocntr = $insValues['bocntr'];
            $custid = $insValues['custid'];
            if ($ordtype == "" || $bocntr === "" || $custid == "") {
                throw new Exception("Must include custid, ordnbr, ordtype, and bocntr\n".var_export($insValues));
            }
            $deleteDocSql = "delete from docstax 
                where doctype = '$ordtype' and 
                refnbr = '$ordnbr' and
                bocntr  = $bocntr and
                custvendid = '$custid'
            ";
            $deleteDtlSql = "delete from dtlstax 
                where doctype = '$ordtype' and 
                refnbr = '$ordnbr' and
                bocntr  = $bocntr and
                custvendid = '$custid'";
            $ret = $docsTable->directQuery($deleteDocSql, array());
            $ret = $docsTable->directQuery($deleteDtlSql, array());
            
            $insDocSql = "
                insert into docstax 
                ( doctype, refnbr, custvendid, taxtype, taxid1, taxid2, bocntr)
                select
                s.ordtype as doctype,
                s.ordnbr as refnbr,
                s.custid as custvendid,
                'O' as taxtype,
                c.tax1 as taxid1,
                c.tax2 as taxid2,
                s.bocntr as bocntr
                 From salesord s, customer c
                where ordnbr='$ordnbr' and ordtype='$ordtype' and bocntr=$bocntr and s.custid=c.custid
            ";
            $insDtlSql = "
                insert into dtlstax 
                (doctype, refnbr, custvendid, taxtype, tax1, tax2, bocntr, lineid, taxcat)
                select
                s.ordtype as doctype,
                s.ordnbr as refnbr,
                s.custid as custvendid,
                'O' as taxtype,
                c.tax1 as tax1,
                c.tax2 as tax2,
                s.bocntr as bocntr,
                d.lineid,
                c.tax1 = '' ?? '' :: 'ALL'
                 From salesord s, sodet d,  customer c
                where s.ordnbr='$ordnbr' and s.ordtype='$ordtype' and s.bocntr=$bocntr and
                 s.ordnbr=d.ordnbr and
                 s.ordtype=d.ordtype and
                 s.bocntr=d.bocntr and
                 s.custid=c.custid
            ";
            $ret = $docsTable->directQuery($insDocSql, array());
            $ret = $docsTable->directQuery($insDtlSql, array());
            
            return $this->findWhere(array("refnbr"=>$ordnbr,"bocntr"=>$bocntr, "doctype"=>$ordtype));
        }
        else {
            throw new Exception("Not ready for this yet");
        }
    }
}
