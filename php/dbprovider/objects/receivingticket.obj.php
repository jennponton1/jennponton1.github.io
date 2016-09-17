<?php

require_once "basetable.class.php";

class ReceivingTicket {

    protected $queryHdrFields = array(
        "perpost",
        "rcptnbr",
        "ponbr",
        "siteid",
        "rcptdate",
        "vendid"
    );
    protected $locFile;
    protected $locDetFile;

    public function __construct() {
        $this->locFile="";
        $this->locDetFile="";
        $this->purchOrd = "";
        $this->purDtl = "";
    }

    protected function convertToNameValueList($elem) {
        return  array_map(
            function ($key, $val) {
                $retObj        = new StdClass();
                $retObj->name  = $key;
                $retObj->value = $val;
                return $retObj;
            },
            array_keys((array) $elem),
            array_values((array) $elem)
        );
    }

    public function findWhere($parms) {
        $parms = $this->convertToNameValueList($parms);
        $rtTable  = new GenericPVSWTable("htrthdr");
        $reqParms = array_filter($parms, array($this, "filterParms"));
        if (count($reqParms) == 0) {
            throw new Exception("No known parameters to use");
        }
        $criteria = array_reduce($reqParms, array($this, "buildQuery"), "");
        $stmt     = $rtTable->multiJoin(
            "r",
            array("d" => "htrtdtl"),
            array(
                new JoinLink("OJ", "r.rcptnbr", "d.rcptnbr"),
                new JoinLink("OJ", "r.siteid", "d.siteid"),
            ),
            array("header" => array("query" => $criteria, "alias" => "r"))
        );
        $retArray = array_reduce($stmt->fetchAll(), array($this, "constructDataSet"), array());
        return array_values($retArray);
    }

    protected function filterParms($elem) {
        return in_array($elem->name, $this->queryHdrFields);
    }

    protected function buildQuery(&$list, $elem) {
        $clause = $elem->name . " = '" . $elem->value . "' ";
        $list   = appendFieldList($clause, $list, " and ");
        return $list;
    }

    protected function convertToObjectRow($elem) {
        return array_reduce(
            $this->convertToNameValueList($elem),
            function (&$el, $curEl) {
                $field     = $curEl->name;
                $fieldName = substr($field, 0, strlen($field) - 2);
                if (substr($field, strlen($field) - 2) == '_r') {
                    $el->$fieldName = $curEl->value;
                }
                else {
                    if (!isset($el->$fieldName)) {
                        if (!isset($el->detail)) {
                            $el->detail    = array();
                            $el->detail[0] = new StdClass();
                        }
                        $el->detail[0]->$fieldName = $curEl->value;
                    }
                }
                return $el;
            },
            new StdClass()
        );
    }

    protected function constructDataSet(&$dataSet, $elem) {
        $uniqueKey = $elem->rcptnbr_r . $elem->siteid_r;
        $newEl = $this->convertToObjectRow($elem);
        if (!isset($dataSet[$uniqueKey])) {
            $dataSet[$uniqueKey] = $newEl;
        }
        else {
            $dataSet[$uniqueKey]->detail[] = $newEl->detail[0];
        }
        return $dataSet;
    }

    protected function getReceiptNumber($rcptnbr, $siteId) {
        switch ($rcptnbr) {
            case "0":
            case "":
            case null:
                $rcptnbr = "0";
                break;
        }
        if ($rcptnbr === "0") {
            // Go get the next receipt #
            $htrtNbr = new GenericPVSWTable("htrtnbr");
            $dataSet = $htrtNbr->findWhere(array("siteid"=>$siteId))->fetchAll();
            $rcptnbr = $dataSet[0]->rcptnbr;
            $this->validate(($rcptnbr != "0" && $rcptnbr != ""), "Failed getting next receipt #");
            $rcptnbr++;
            // Update htrtnbr
            $htrtNbr->update(array("siteid"=>$siteId), array("rcptnbr"=>$rcptnbr));
        }
        return $rcptnbr;
    }

    protected function validate($checkExpression, $message) {
        if (!$checkExpression) {
            throw new Exception("Failed: ".$message);
        }
    }

    protected function openFilesForInsert() {
        $this->baseTable = new GenericPVSWTable("htrthdr");
        $this->baseTable->getColumnList();
        $this->htrtDet = new GenericPVSWTable("htrtdet");
        $this->htrtDet->getColumnList();
        $this->htrtDtl = new GenericPVSWTable("htrtdtl");
        $this->htrtDtl->getColumnList();
        $this->inTran = new GenericPVSWTable("intran");
        $this->inTran->getColumnList();
        $this->purDtl = new GenericPVSWTable("purdtl");
        $this->purDtl->getColumnList();
        $this->purchOrd = new GenericPVSWTable("purchord");
        $this->purchOrd->getColumnList();
        $this->locFile = new GenericPVSWTable("location");
        $this->locFile->getColumnList();
        $this->locDetFile = new GenericPVSWTable("htlocdet");
        $this->locDetFile->getColumnList();
        $this->klnDet = new GenericPVSWTable("htklndet");
        $this->klnDet->getColumnList();
    }

    protected function postPerpetual($intObj) {
        if ($this->locFile === "") {
            $this->locFile = new GenericPVSWTable("location");
        }
        if ($this->locDetFile === "") {
            $this->locDetFile = new GenericPVSWTable("htlocdet");
        }
        if ($intObj->whseloc == 'VMK') {
            // Try to find this item still in the kiln
            require_once "kilnstatus.obj.php";
            $ksObj = new KilnStatus();
            $ksSearch = $ksObj->findWhere(array("siteid"=>$intObj->siteid));
            if (!is_array($ksSearch) || count($ksSearch) == 0) {
                throw new Exception("Could not find kiln charge to remove VMI from! (ks failed )");
            }
            $charges = array();
            $totPcsAvailable = 0;
            foreach ($ksSearch as $row) {
                // look for the part #
                if ($row->invtid == $intObj->invtid && $row->whseloc == "VMI") {
                    $list = $this->klnDet->findWhere(
                        array(
                            "chgid"=>$row->chgid,
                            "invtid"=>$row->invtid,
                            "siteid"=>$row->siteid,
                            "ordnbr"=>$row->ordnbr,
                            "whseloc"=>$row->whseloc,
                            "custid"=>$row->custid,
                        )
                    );
                    foreach($list as $klnRow) {
                        $charges[] = $klnRow;
                    }

                    //$charges[] = $row;
                    $totPcsAvailable += ($row->loaded - $row->unloaded);
                }
            }
            if (count($charges) == 0 || $totPcsAvailable < abs($intObj->qty)) {
                throw new Exception("Could not find kiln charge to remove VMI from! (no charges)");
            }
            $pcsToAllocate = abs($intObj->qty);
            $chg = 0;
            $newLine = 101;
            while ($pcsToAllocate > 0) {
                $curRow = $charges[$chg];
                $qty = min($pcsToAllocate, ($curRow->qty));
                $recUpdate = (array) json_decode(json_encode($curRow));
                $recUpdate['qty'] = ($recUpdate['qty'] - $qty);
                $pcsToAllocate -= $qty;
                $chg++;
                // @TODO -- FIX BF&SF #s
                if ($chg >= count($charges) && $pcsToAllocate > 0) {
                    throw new Exception("Not enough charges to calc amounts $pcsToAllocate");
                }
                // See if there's a matching Stock record already in
                $tmpStk = $this->klnDet->findWhere(
                    array(
                            "chgid"=>$curRow->chgid,
                            "invtid"=>$curRow->invtid,
                            "siteid"=>$curRow->siteid,
                            "ordnbr"=>"STOCK",
                            "whseloc"=>"STK",
                            "custid"=>"00",
                    )
                );
                $test = $tmpStk->fetch();
                if ($test === false) {
                    // No record, insert one
                    $insRec = (array) json_decode(json_encode($recUpdate));
                    $insRec['qty'] = $qty;
                    $insRec['ordnbr'] = 'STOCK';
                    $insRec['whseloc'] = 'STK';
                    $insRec['custid'] = '00';
                    $insRec['linenum'] = $newLine;
                    $newLine++;
                    //throw new Exception("insert ".var_export($test, true));
                    $this->klnDet->insert($insRec);
                }
                else {
                    // Found a stock record... update it
                    $insRec = (array) json_decode(json_encode($test));
                    $insRec['qty'] = ($insRec['qty'] + $qty);
                    $updKeys2 = array(
                        "chgid"=>$insRec['chgid'],
                        "siteid"=>$insRec['siteid'],
                        "invtid"=>$insRec['invtid'],
                        'ordnbr'=>$insRec['ordnbr'],
                        "custid"=>$insRec['custid'],
                        "linenum"=>$insRec['linenum'],
                        "rownum"=>$insRec['rownum'],
                    );
                    //throw new Exception("update ".var_export($updKeys2, true));
                    $this->klnDet->update($updKeys2, $insRec);
                }
                $updKeys = array(
                    "chgid"=>$recUpdate['chgid'],
                    "siteid"=>$recUpdate['siteid'],
                    "invtid"=>$recUpdate['invtid'],
                    'ordnbr'=>$recUpdate['ordnbr'],
                    "custid"=>$recUpdate['custid'],
                    "linenum"=>$recUpdate['linenum'],
                    "rownum"=>$recUpdate['rownum'],
                );
                $this->klnDet->update($updKeys, $recUpdate);

            }

            //$excMessage = "I can't handle VMI/KILN right now!!! ".
            //    "$totPcsAvailable $intObj->qty ".var_export($charges, true);
            //throw new Exception($excMessage);
        }
        $keys = array(
            "invtid"=>$intObj->invtid,
            "siteid"=>$intObj->siteid,
            "lotsernbr"=>$intObj->lotsernbr,
            "whseloc"=>$intObj->whseloc
        );
        $lotRS = $this->locFile->findWhere($keys)->fetchAll();
        // Determine if we need to insert
        if  (count($lotRS) == 0) {
            $keys['qtyonhand'] = $intObj->qty;
            $this->locFile->insert($keys);
        }
        else {
            $this->validate(count($lotRS) == 1, "Could not find the appropriate item!");
            $lotRec = $lotRS[0];
            $lotUpd = array(
                'qtyonhand' => $lotRec->qtyonhand + $intObj->qty
            );
            $this->locFile->update($keys, $lotUpd);
        }
        // handle posting htlocdet
        $lotsernbr = $keys['lotsernbr'];
        unset($keys['lotsernbr']);
        foreach($intObj->orders as $order => $orderQty) {
            $keys['custid'] = $lotsernbr;
            $keys['ordnbr'] = $order;
            $dtlRS = $this->locDetFile->findWhere($keys)->fetchAll();
            if (count($dtlRS) == 0) {
                $keys['qtyonhand'] = $orderQty;
                $this->locDetFile->insert($keys);
            }
            else {
                $this->validate(count($dtlRS) == 1, "Could not find the appropriate item!");
                $dtlRec = $dtlRS[0];
                $dtlUpd = array("qtyonhand"=>$dtlRec->qtyonhand + $orderQty);
                $this->locDetFile->update($keys, $dtlUpd);
            }
        }
    }

    protected function getBatchNumber() {
        require_once "inbatch.obj.php";
        $inBatch = new INBatch();
        $batchSet = $inBatch->insert(array());
        $batchNbr = $batchSet[0]->batnbr;
        return $batchNbr;
    }

    protected function getPerNbr() {
        $insetup = new GenericPVSWTable("insetup");
        $insData = $insetup->findWhere(array("setupid"=>"IN"))->fetchAll();
        $perNbr = $insData[0]->pernbr;
        unset($insData);
        return $perNbr;
    }

    protected function accumulatePerpetualPosts($intObj, &$accumAr, $ordnbr) {
        $key = $intObj->invtid.
               $intObj->siteid.
               $intObj->whseloc.
               $intObj->lotsernbr;
        if (!isset($accumAr[$key])) {
            $accumAr[$key] = (object) array(
                "invtid"=>$intObj->invtid,
                "siteid"=>$intObj->siteid,
                "whseloc"=>$intObj->whseloc,
                "lotsernbr"=>$intObj->lotsernbr,
                "qty"=>0,
                "orders"=>array()
            );
        }
        $accumAr[$key]->qty += $intObj->qty;
        if (!isset($accumAr[$key]->orders[$ordnbr])) {
            $accumAr[$key]->orders[$ordnbr] = 0;
        }
        $accumAr[$key]->orders[$ordnbr] += $intObj->qty;
        return $accumAr;
    }

    protected function updatePurchaseOrder($receipt) {
        $receipt = (object) $receipt;
        if ($this->purDtl == "") {
            $this->purDtl = new GenericPVSWTable("purdtl");
        }

        $purData = $this->purDtl->findWhere(array("ponbr"=>$receipt->ponbr))->fetchAll();
        $hashAr = array();
        for ($count =0; $count < count($purData); $count++) {
            $lineNbr = $purData[$count]->linenbr;
            $hashAr[$lineNbr] = $count;
        }
        foreach($receipt->detail as $rcptItem) {
            if (isset($hashAr[$rcptItem->linenbr])) {
                $poNdx = $hashAr[$rcptItem->linenbr];
                $poLine = $purData[$poNdx];
                $cnvfact = $poLine->cnvfact;
                if ($cnvfact == 0) {
                    $cnvfact = 1;
                }
                $rcptUOMQty = $purData[$poNdx]->qtyrcvd + $rcptItem->pcs / $poLine->cnvfact;
                $this->purDtl->update(
                    array(
                        "ponbr"=>$receipt->ponbr,
                        "linenbr"=>$rcptItem->linenbr
                    ),
                    array(
                        "qtyrcvd"=>$rcptUOMQty
                    )
                );
                $purData[$poNdx]->qtyrcvd = $rcptUOMQty;
            }
            else {
                // Don't know what to do
            }
        }

        // Now check to see if the po can be closed
        $complete = true;
        foreach($purData as $poItem) {
            $rem = $poItem->qtyord - $poItem->qtyrcvd;
            if ($rem != 0) {
                $complete = false;
                break;
            }
        }
        if ($complete) {
            if ($this->purchOrd == "") {
                $this->purchOrd = new GenericPVSWTable("purchord");
            }
            $this->purchOrd->update(
                array(
                    "ponbr"=>$receipt->ponbr
                ),
                array(
                    "status"=>"M",
                    "openpo"=>"N"
                )
            );
        }
    }

    public function insert($insertValues) {
        $insertValues = (array) $insertValues;
        $this->validate(isset($insertValues['siteid']), "Siteid was not set");
        $siteId = $insertValues['siteid'];
        $this->validate(in_array($siteId, array("THO","MIL","PB","DET", "WIN")), "Unrecognized siteid $siteId");
        // Get INTRan Batch #
        $batchNbr = $this->getBatchNumber();
        // get Period to post
        $perNbr = $this->getPerNbr();

        $this->openFilesForInsert();
        // Start Transaction
        $this->baseTable->directQuery("start transaction");
        // Get Receipt #
        $rcptNbr = $this->getReceiptNumber($insertValues['rcptnbr'], $siteId);
        // insert into htrthdr
        $hdrObj = (object) array(
            "rcptnbr"=> $rcptNbr,
            "siteid"=>$siteId,
            "vendid"=>$insertValues['vendid'],
            "rcptdate" => $insertValues['rcptdate'],
            "ponbr" => $insertValues['ponbr'],
            "batnbr" => $batchNbr,
            "perpost" => $perNbr
        );
        $this->baseTable->insert($hdrObj);
        $perpetualPosts = array();
        foreach($insertValues['detail'] as $dtlItem) {
            $hdrDet = (object) array(
                "rcptnbr"=> $rcptNbr,
                "siteid"=>$siteId,
                "ordnbr"=>$dtlItem->ordnbr,
                "invtid"=>$dtlItem->invtid,
                "qty"=>$dtlItem->pcs,
                "whseloc"=>$dtlItem->whseloc,
                "bdft"=>$dtlItem->bf,
                "sqft"=>$dtlItem->sf
            );
            // insert into htrtdet
            $this->htrtDet->insert($hdrDet);
            // htrtDTL now
            $hdrDet2 = (object) array_merge((array) $hdrObj, (array) $hdrDet);
            unset($hdrDet2->batnbr);
            unset($hdrDet2->perpost);
            unset($hdrDet2->ordnbr);
            $hdrDet2->rcpttype = $insertValues['rcpttype'];
            $hdrDet2->status = "U";
            $hdrDet2->linenbr = $dtlItem->linenbr;
            // insert into htrtdtl
            $this->htrtDtl->insert($hdrDet2);
            // Post to intran
            $intObj = (object) array(
                "jrnltype"=>"IN",
                "trantype"=>"RC",
                "perent"=>$perNbr,
                "perpost"=>$perNbr,
                "batnbr"=>$batchNbr,
                "refnbr"=>$rcptNbr,
                "trandate"=>$insertValues['rcptdate'],
                "trandesc"=>"Receipt $rcptNbr ~ORD~".$dtlItem->ordnbr,
                "tranamt"=>"0",
                "drcr"=>"D",
                "unitdescr"=>"EACH",
                "qty"=>$dtlItem->pcs,
                "invtid"=>$dtlItem->invtid,
                "lotsernbr"=>$dtlItem->lotsernbr,
                "whseloc"=>$dtlItem->whseloc,
                "cnvfact"=>"1",
                "rcptdate"=>$insertValues['rcptdate'],
                "rcptnbr"=>$rcptNbr,
                "user3"=>$dtlItem->pcs,
                "user4"=>"0",
                "siteid"=>$siteId,
                "linenbr"=>$dtlItem->linenbr,
                "shortqty"=>"0",
                "rlsed"=>"Y",
                "acctdist"=>"N",
                "uncosted"=>"N",
            );
            $this->inTran->insert($intObj);
            // Post to Location file
            $perpetualPosts = $this->accumulatePerpetualPosts($intObj, $perpetualPosts, $dtlItem->ordnbr);
            // Handle VMI Relief...
            // Check Receipt Type - if this is VMISTK , then we must relieve VMI
            if ($insertValues['rcpttype'] == 'VMISTK') {
                //throw new Exception("vmistk found ".var_export($dtlItem, true));
                $this->validate($dtlItem->vmiitem != '', "No VMI Relief item found!");
                $this->validate($dtlItem->vmiwhse != "", "No VMI Whse found!");
                // Continue on for VMI relief
                $intObj->whseloc = $dtlItem->vmiwhse;
                $intObj->invtid = $dtlItem->vmiitem;
                $intObj->lotsernbr = $insertValues['vendid'];
                $intObj->qty = $intObj->qty * -1;
                $intObj->user3 = $intObj->qty;
                $this->inTran->insert($intObj);
                // Post to Location file
                $perpetualPosts = $this->accumulatePerpetualPosts($intObj, $perpetualPosts, "STOCK");
            }
        } // Done with Detail
        // If this is the right kind of receipt, update the purchase order
        if ($insertValues['rcpttype'] == 'STK' || $insertValues['rcpttype'] == 'VMISTK') {
            $this->updatePurchaseOrder($insertValues);
        }
        unset($this->htrtDet);
        unset($this->htrtDtl);
        unset($this->inTran);
        // Go post the location file
        foreach($perpetualPosts as $perpItem) {
            $this->postPerpetual($perpItem);
        }
        $this->baseTable->directQuery("commit");
        return $this->findWhere(array("siteid"=>$siteId, "rcptnbr"=>$rcptNbr));
    }

}
