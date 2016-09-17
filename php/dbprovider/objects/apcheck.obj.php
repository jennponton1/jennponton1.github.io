<?php

require_once "basetable.class.php";
require_once "dbprovider/dbprovider.inc.php";

class APCheck {
    protected $dsn;
    protected $dsnMap = array(
        "CEN"=>"adohtwsol",
        "COR"=>"adocorp"
    );

    protected $glTranFieldArray = array(
        "JrnlType",
        "TranType",
        "Acct",
        "Sub",
        "PerEnt",
        "PerPost",
        "batnbr",
        "RefNbr",
        "TranDate",
        "TranDesc",
        "TranAmt",
        "DrCr",
        "LineNbr",
    );
    public function __construct() {
        $this->dsn = "";
    }

    public function constructDataset($res) {
        $retSet = array();
        foreach($res as $row) {
            $key = $row->refnbr_a.$row->doctype_a.$row->docdate_a;
            if (!isset($retSet[$key])) {
                $retSet[$key] = new StdClass();
                $retSet[$key]->chknbr = $row->refnbr_a;
                $retSet[$key]->chktype = $row->doctype_a;
                $retSet[$key]->chkamt = $row->origamt_a;
                $retSet[$key]->status = $row->status_a;
                $retSet[$key]->vendid = $row->vendid_a;
                $retSet[$key]->chkdate = $row->docdate_a;
                $retSet[$key]->lastname = $row->lastname_v;
                $retSet[$key]->detail = array();
            }
            $dtlObj = new StdClass();
            $dtlObj->invcnbr = $row->invcnbr_b;
            $dtlObj->refnbr = $row->refnbr_b;
            $dtlObj->doctype = $row->doctype_b;
            $dtlObj->adjamt = $row->adjamt_j;
            $dtlObj->adjdiscamt = $row->adjdiscamt_j;
            $dtlObj->docdate = $row->docdate_b;
            $dtlObj->origamt = $row->origamt_b;
            $retSet[$key]->detail[] = $dtlObj;
            //$retSet[$key] = $row;
        }
        ksort($retSet);
        return array_values($retSet);
    }

    protected function getDSN($parms) {
        if (!isset($parms['dsn'])) {
            throw new Exception("You must pass a DSN for this object!!");
        }
        $dsn = $this->dsnMap[strtoupper($parms['dsn'])];
        if ($dsn == null) {
            throw new Exception("Unknown DSN");
        }
        unset($parms['dsn']);
        return (object) array("parms"=>$parms, "dsn"=>$dsn);
    }

    public function findWhere($parms) {
        $tmpObj = $this->getDSN((array) $parms);
        $parms = $tmpObj->parms;
        $apdoc = new GenericPVSWTable("apdoc", $tmpObj->dsn);
        $dtlCrit = array();
        if (isset($parms['adjdrefnbr'])) {
            // try to find the ref#
            $apadj = new GenericPVSWTable("apadjust", $tmpObj->dsn);
            $tmpRes = $apadj->findWhere(array("adjdrefnbr"=>$parms['adjdrefnbr']));
            $tmpRow = $tmpRes->fetch();
            if ($tmpRow == false) {
                return array();
            }
            $parms['checknbr'] = $tmpRow->adjgrefnbr;
            unset($parms['adjdrefnbr']);
        }
        if (count($dtlCrit) == 0 || count($parms) > 0) {
            $where = $this->getWhereSql($parms);
            $dtlCrit['header']  = array("query"=>$where, "alias"=>"a");
        }
        // This is a patch --
        $res = $apdoc->multiJoin(
            "a",
            array(
                new JoinTable("j", "apadjust"),
                new JoinTable("b", "apdoc"),
                new JoinTable("v", "vendor", array("lastname"))
            ),
            array(
                new JoinLink("IJ", "a.refnbr", "j.adjgrefnbr"),
                new JoinLink("IJ", "a.doctype", "j.adjgdoctype"),
                new JoinLink('IJ', 'a.perpost', 'j.adjgperpost'),
                new JoinLink('IJ', 'j.vendid', 'b.vendid'),
                new JoinLink("IJ", "j.adjdrefnbr", 'b.refnbr'),
                new JoinLink("IJ", "j.adjddoctype", 'b.doctype'),
                new JoinLink("IJ", "a.vendid", "v.vendid")
            ),
            $dtlCrit
        );
        return $this->constructDataset($res);
    }

    public function getWhereSql($crit = "") {
        $map = SqlBuilder::createMap();
        $crit = (array) $crit;
        $begFound = isset($crit['docdate']);
        $endFound = isset($crit['enddate']);
        if ($begFound && !$endFound) {
            throw new Exception("You must include and end date if you include a beginning date");
        }
        if (!$begFound && $endFound) {
            throw new Exception("You must include a beginning date if you include an ending date");
        }
        SqlBuilder::addMapItem(
            $map,
            array(
                array(
                    "field"=>"checknbr",
                    "column"=>"refnbr"
                ),
                array(
                    "field"=>"chknbr",
                    "column"=>"refnbr"
                ),
                array(
                    "field"=>"chktype",
                    "column"=>"doctype"
                ),
                array(
                    'field'=>'perpost',
                    'column'=>'perpost'
                ),
                array(
                    "field"=>"vendid",
                    "column"=>"vendid",
                    "op"=>"LIKE%"
                    ),
                array(
                    "field"=>"docdate",
                    "column"=>"docdate",
                    "op"=>"GE"
                ),
                array(
                    "field"=>"enddate",
                    "column"=>"docdate",
                    "op"=>"LE"
                ),
                array(
                    "field"=>"adjdrefnbr",
                    "column"=>"j.adjdrefnbr",
                ),
                array(
                    "field"=>"invcnbr",
                    "column"=>"b.invcnbr",
                )
            )
        );
        $where = SqlBuilder::buildSql($crit, $map);
        if (!$begFound && !$endFound) {
            //$where = ' a.docdate >= curdate - 30 and ' . $where;
        }
        //$sql = str_replace("/**/", $where, $this->searchSql);
        //$sql = $sql . $this->joinClause;
        $sql = $where;
        // throw new Exception("sql is $sql");
        return $sql;
    }

    public function findOpen() {
        throw new Exception("Not available");
    }

    protected function validate($validateExpression, $message) {
        // if validateExpress is false, this will throw an exception with the
        // message parameter
        if (!$validateExpression) {
            throw new Exception($message);
        }
    }

    protected function readDataset($stmt) {
        $retAr = array();
        foreach($stmt as $row) {
            $retAr[] = $row;
        }
        return $retAr;
    }

    protected function makeGLTranRec($aptRec) {
        $gltRec = new StdClass();
        foreach($this->glTranFieldArray as $field) {
            $field = strtolower($field);
            $gltRec->$field = $aptRec->$field;
        }
        $gltRec->module = 'AP';
        $gltRec->posted = 'U';
        $gltRec->relcntr = 0;
        return $gltRec;
    }

    protected function getBatch() {
        $db = new DbProvider();
        $batRecs = $db->insertObject("apbatch", (object) array("dsn"=>array_search($this->dsn, $this->dsnMap)));
        $this->validate(($batRecs->status == SUCCESS), "Failed getting batch # ".$batRecs->message);
        $batchNbr = $batRecs->data[0]->batnbr;
        $perpost = $batRecs->data[0]->perpost;
        $db->updateObject(
            "apbatch",
            (object) array(
                "dsn"=>array_search($this->dsn, $this->dsnMap),
                "batnbr"=>$batchNbr,
                "status"=>"U",
                "rlsed"=>"Y",
                "perpost"=>$perpost,
            )
        );
        return $batchNbr;
    }

    protected function updateVendor($vendid, $amt) {
        $db = new DbProvider();
        $res = $db->findWhere("vendor", array("vendid"=>$vendid, "dsn"=> array_search($this->dsn, $this->dsnMap)));
        $vend = $res->data[0];
        $pmtAmt = $vend->ytdpymt;
        $amt = $pmtAmt-$amt;
        $db->updateObject(
            "vendor",
            (object) array("vendid"=>$vendid, "ytdpymt"=>$amt, "dsn"=>array_search($this->dsn, $this->dsnMap))
        );
    }

    protected function handleVoid($chkArray) {
        // go get this check
        $critArray = array();

        foreach(array("chknbr","vendid","perpost","docdate") as $field) {
            if (isset($chkArray[$field])) {
                $critArray[$field] = $chkArray[$field];
            }
        }
        $critArray['refnbr'] = $critArray['chknbr'];
        unset($critArray['chknbr']);
        $base = new GenericPVSWTable("apdoc", $this->dsn);
        $rec = $base->findWhere($critArray);
        $chks = array();
        foreach($rec as $row) {
            if (in_array($row->doctype, array('CK', 'AC'))) {
                $chks[] = $row;
            }
        }
        $this->validate(count($chks) != 0, "Didn't find check #".$chkArray['chknbr']);
        $this->validate(count($chks) == 1, "Can't determine with check #".$chkArray['chknbr']." to void");
        // Get the check to use
        $chk = (array) $chks[0];
        // Make sure it's not already voided
        $this->validate($chk['status'] != 'V', "Check is already voided");
        // At this point, we should be able to void the check.
        // Where's what we have to do:
        // Get Batch #
        $batchNbr = $this->getBatch();

        $base->directQuery("start transaction", array());
        //  get current period;
        $apsetup = new GenericPVSWTable("apsetup", $this->dsn);
        $apStmt = $apsetup->findWhere(array("setupid"=>"AP"));
        $apSURec = $apStmt->fetch();
        // Create APDOC record for voided check
        $apIns = (object) $chk;
        $apIns->doctype = 'VC';
        $apIns->status = 'V';
        $apIns->docdate = date("Y-m-d");
        $apIns->perent =  $apSURec->pernbr;
        $apIns->perpost = $apSURec->pernbr;
        $apIns->perclosed = $apSURec->pernbr;
        $apIns->batnbr = $batchNbr;
        $apIns->docclass = 'V';
        $base->insert($apIns);

        // Update APDOC Check to reflect status of void
        $apdUpd = array();
        $keys = array();
        foreach(array("refnbr","doctype","vendid","perpost") as $field) {
            $apdUpd[$field] = $chk[$field];
            $keys[$field] = $chk[$field];
        }
        $apdUpd['status'] = 'V';
        $apdUpd['perclosed'] = $apSURec->pernbr;
        $base->update($keys, $apdUpd);

        // Create apadjust record
        $apAdjustTable = new GenericPVSWTable("apadjust", $this->dsn);
        $adjStmt = $apAdjustTable->findWhere(
            array(
                "adjgrefnbr"=>$chk['refnbr'],
                "adjgperpost"=>$chk['perpost']
            )
        );
        $adjSet = $this->readDataset($adjStmt);
        $this->validate(count($adjSet) > 0, "Couldn't find the adj records");
        foreach($adjSet as $rec) {
            $newRec = (object) $rec;
            $newRec->adjamt = ($newRec->adjamt)*-1;
            $newRec->adjdiscamt = ($newRec->adjdiscamt)*-1;
            $newRec->adjgperpost = $apSURec->pernbr;
            $newRec->adjgdoctype = 'VC';
            $voucherKeys = array(
                "refnbr"=>$rec->adjdrefnbr,
                "doctype"=>$rec->adjddoctype
            );
            $origVoucher = $base->findWhere($voucherKeys);
            $voucherSet = $this->readDataset($origVoucher);
            $this->validate(
                count($voucherSet) == 1,
                "Can't determine which record to update in apadj"
            );
            // Mark invoices previously paid as being reoopend
            $updVoucher =  new StdClass();
            $updVoucher->docbal= $voucherSet[0]->docbal - $newRec->adjamt - $newRec->adjdiscamt;
            $updVoucher->discbal = $voucherSet[0]->discbal - $newRec->adjdiscamt;
            $updVoucher->perclosed = '';
            $updVoucher->opendoc = 'Y';

            $base->update($voucherKeys, (array) $updVoucher);
            $apAdjustTable->insert($newRec);
            unset($newRec);
        }
        // Create APTran records
        $apTranTable = new GenericPVSWTable("aptran", $this->dsn);
        $glTranTable = new GenericPVSWTable("gltran", $this->dsn);
         // $chk['doctype'] -- ALWAYS CK in apTran
        $apTranStmt = $apTranTable->findWhere(array("refnbr"=>$chk['refnbr'], "doctype"=>'CK'));
        $apTranSet = $this->readDataset($apTranStmt);
        foreach($apTranSet as $aptRec) {
            $aptRec->batnbr = $batchNbr;
            $aptRec->perpost = $apSURec->pernbr;
            $drcr = 'D';
            if ($aptRec->drcr == 'D') {
                $drcr = 'C';
            }
            $aptRec->drcr = $drcr;
            $aptRec->trandate = date("Y-m-d");
            $aptRec->trantype = "VC";
            $aptRec->doctype = 'VC';
            $apTranTable->insert($aptRec);
            // Create GLTran Records
            $gltRec = $this->makeGLTranRec($aptRec);
            $glTranTable->insert($gltRec);
        }
        // Update Vendor table fields
        $this->updateVendor($chk['vendid'], $chk['origamt']);
        // Commit record
        $base->directQuery("commit ");

        return "Success";
    }

    public function insert($insValues) {
        // Check for type and number
        $chkArray = (array) $insValues;
        if (isset($chkArray['checknbr'])) {
            $chkArray['chknbr'] = $chkArray['checknbr'];
        }
        $tmpObj = $this->getDSN((array) $insValues);
        $insValues = $tmpObj->parms;
        $this->dsn = $tmpObj->dsn;
        $this->validate(
            (isset($chkArray['chknbr']) && isset($chkArray['chktype'])),
            "You must at least include a check number and a check type ".var_export($chkArray, true)
        );
        if ($chkArray['chktype'] == 'VC') {
            $this->handleVoid($chkArray);
        }
        else {
            throw new Exception("Can only insert voids at this time");
        }
    }


}
