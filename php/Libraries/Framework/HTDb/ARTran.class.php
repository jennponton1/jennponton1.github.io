<?php
/**
 * ARTran - class
 * This class provides access to the ARTRAN table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class ARTran extends SolModel
  {
  /**
   * ARTranId - Primary index used to uniquely 
   *  identify a ARTran object.
   */  
  private $ARTranId;
  /**
   * Keys - data members used to filter the object list
   */   
  private $Batnbr;
  private $Custid;
  private $Drcr;
  private $Invtid;
  private $Jrnltype;
  private $Lineid;
  private $Linenbr;
  private $Lotsernbr;
  private $Refnbr;
  private $Rlsed;
  private $Siteid;
  private $Slsperid;
  private $Sub;
  /**
   * Ranges - data members used to filter the object list
   */   
  private $beginPerent;
  private $endPerent;
  private $beginPerpost;
  private $endPerpost;
  private $beginTrandate;
  private $endTrandate;
  
  public function __construct()
  {
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setBatnbr($inBatnbr)
  {
    $this->Batnbr=$inBatnbr;
    return $this->Batnbr;
  }
  public function getBatnbr()
  {
    return $this->Batnbr;
  }

  public function setCustid($inCustid)
  {
    $this->Custid=$inCustid;
    return $this->Custid;
  }
  public function getCustid()
  {
    return $this->Custid;
  }

  public function setDrcr($inDrcr)
  {
    $this->Drcr=$inDrcr;
    return $this->Drcr;
  }
  public function getDrcr()
  {
    return $this->Drcr;
  }

  public function setInvtid($inInvtid)
  {
    $this->Invtid=$inInvtid;
    return $this->Invtid;
  }
  public function getInvtid()
  {
    return $this->Invtid;
  }

  public function setJrnltype($inJrnltype)
  {
    $this->Jrnltype=$inJrnltype;
    return $this->Jrnltype;
  }
  public function getJrnltype()
  {
    return $this->Jrnltype;
  }

  public function setLineid($inLineid)
  {
    $this->Lineid=$inLineid;
    return $this->Lineid;
  }
  public function getLineid()
  {
    return $this->Lineid;
  }

  public function setLinenbr($inLinenbr)
  {
    $this->Linenbr=$inLinenbr;
    return $this->Linenbr;
  }
  public function getLinenbr()
  {
    return $this->Linenbr;
  }

  public function setLotsernbr($inLotsernbr)
  {
    $this->Lotsernbr=$inLotsernbr;
    return $this->Lotsernbr;
  }
  public function getLotsernbr()
  {
    return $this->Lotsernbr;
  }

  public function setRefnbr($inRefnbr)
  {
    $this->Refnbr=$inRefnbr;
    return $this->Refnbr;
  }
  public function getRefnbr()
  {
    return $this->Refnbr;
  }

  public function setRlsed($inRlsed)
  {
    $this->Rlsed=$inRlsed;
    return $this->Rlsed;
  }
  public function getRlsed()
  {
    return $this->Rlsed;
  }

  public function setSiteid($inSiteid)
  {
    $this->Siteid=$inSiteid;
    return $this->Siteid;
  }
  public function getSiteid()
  {
    return $this->Siteid;
  }

  public function setSlsperid($inSlsperid)
  {
    $this->Slsperid=$inSlsperid;
    return $this->Slsperid;
  }
  public function getSlsperid()
  {
    return $this->Slsperid;
  }

  public function setSub($inSub)
  {
    $this->Sub=$inSub;
    return $this->Sub;
  }
  public function getSub()
  {
    return $this->Sub;
  }

  /**
   * Ranges - get set methods
   */   
  public function setPerentRange($inBeginPerent, $inEndPerent)
  {
    $this->beginPerent = $inBeginPerent;
    $this->endPerent = $inEndPerent;
  }
  public function getBeginPerentRange()
  {
    return $this->beginPerent;
  }
  public function getEndPerentRange()
  {
    return $this->endPerent;
  }

  public function setPerpostRange($inBeginPerpost, $inEndPerpost)
  {
    $this->beginPerpost = $inBeginPerpost;
    $this->endPerpost = $inEndPerpost;
  }
  public function getBeginPerpostRange()
  {
    return $this->beginPerpost;
  }
  public function getEndPerpostRange()
  {
    return $this->endPerpost;
  }

  public function setTrandateRange($inBeginTrandate, $inEndTrandate)
  {
    $this->beginTrandate = $inBeginTrandate;
    $this->endTrandate = $inEndTrandate;
  }
  public function getBeginTrandateRange()
  {
    return $this->beginTrandate;
  }
  public function getEndTrandateRange()
  {
    return $this->endTrandate;
  }

  /**
   * Associate ARTran accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */
   'acct'     => 'Acct',   // Account
   'acctdist'	=> 'AcctDist',	// Account Dist (Char-1)
   'batnbr'	=> 'BatNbr',	// Bat Number (ZString-7)
   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
 
   'cmmnpct'	=> 'CmmnPct',	// Cmmn Percent (Float-8)
   'cnvfact'	=> 'CnvFact',	// Cnv Fact (Float-8)
   'costtype'	=> 'CostType',	// Cost Type (ZString-3)
   'custid'	=> 'CustId',	// Customer ID (ZString-11)
 
   'drcr'	=> 'DrCr',	// Debit Credit (Char-1)
   'except'	=> 'Except',	// Except (Char-1)
   'extcost'	=> 'ExtCost',	// Ext Cost (Float-8)
   'invtid'	=> 'InvtId',	// Inventory ID (ZString-21)
 
   'jobid'	=> 'JobId',	// Job ID (ZString-11)
   'jobrate'	=> 'JobRate',	// Job Rate (Float-8)
   'jrnltype'	=> 'JrnlType',	// Jrnl Type (ZString-4)
   'lineid'	=> 'LineId',	// Line ID (Integer-4)
 
   'linenbr'	=> 'LineNbr',	// Line Number (Integer-4)
   'lotsernbr'	=> 'LotSerNbr',	// Lot Ser Number (ZString-16)
   'paidamt'	=> 'PaidAmt',	// Paid Amt (Float-8)
   'perent'	=> 'PerEnt',	// Period Ent (ZString-7)
 
   'perpost'	=> 'PerPost',	// Period Post (ZString-7)
   'phaseid'	=> 'PhaseId',	// Phase ID (ZString-9)
   'qty'	=> 'Qty',	// Quantity (Float-8)
   'ratebaseflg'	=> 'RateBaseFlg',	// Rate Base Flg (Char-1)
 
   'refnbr'	=> 'RefNbr',	// Ref Number (ZString-7)
   'rlsed'	=> 'Rlsed',	// Rlsed (Char-1)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'siteid'	=> 'SiteId',	// Site ID (ZString-7)
 
   'slsperid'	=> 'SlsperId',	// Sales Person ID (ZString-11)
   'sub'	=> 'Sub',	// Subaccount (ZString-25)
   'tranamt'	=> 'TranAmt',	// Tran Amt (Float-8)
   'tranbal'	=> 'TranBal',	// Tran Balance (Float-8)
 
   'trandate'	=> 'TranDate',	// Tran Date (Date-4)
   'trandesc'	=> 'TranDesc',	// Tran Desc (ZString-31)
   'trantype'	=> 'TranType',	// Tran Type (ZString-3)
   'unitdescr'	=> 'UnitDescr',	// Unit Descr (ZString-7)
 
   'unitprice'	=> 'UnitPrice',	// Unit Price (Float-8)
   'upduserid'	=> 'UpdUserId',	// Update User ID (ZString-4)
   'user1'	=> 'User1',	// User 1 (ZString-31)
   'user2'	=> 'User2',	// User 2 (ZString-31)
 
   'user3'	=> 'User3',	// User 3 (Float-8)
   'user4'	=> 'User4',	// User 4 (Float-8)
   'whseloc'	=> 'WhseLoc',	// Whse Loc (ZString-9)

);
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    $openSQL =  "select ";
    $cols = array_keys($this->accessorNames);  
    $openSQL .= reset($cols);
    while($col = next($cols))
      $openSQL .= ', "' . $col . '"';
    $openSQL .= ' from ARTRAN ' ;
    return $openSQL;
  // Filter by keys or ranges here. Example:
  // where  ARTranId=$this->ARTranId  
  // and Batnbr='$this->Batnbr'
  // and Custid='$this->Custid'
  // and Drcr='$this->Drcr'
  // and Invtid='$this->Invtid'
  // and Jrnltype='$this->Jrnltype'
  // and Lineid='$this->Lineid'
  // and Linenbr='$this->Linenbr'
  // and Lotsernbr='$this->Lotsernbr'
  // and Refnbr='$this->Refnbr'
  // and Rlsed='$this->Rlsed'
  // and Siteid='$this->Siteid'
  // and Slsperid='$this->Slsperid'
  // and Sub='$this->Sub'
  // and Perent>='$this->beginPerent'
  // and Perent<='$this->endPerent'
  // and Perpost>='$this->beginPerpost'
  // and Perpost<='$this->endPerpost'
  // and Trandate>='$this->beginTrandate'
  // and Trandate<='$this->endTrandate'
  }

  protected function getInsertSQL($current)
  {
    if($current->Chksum == '') $current->Chksum = 0;
    if($current->CmmnPct == '') $current->CmmnPct = 0;
    if($current->CnvFact == '') $current->CnvFact = 0;
    if($current->ExtCost == '') $current->ExtCost = 0;
    if($current->JobRate == '') $current->JobRate = 0;
    if($current->LineId == '') $current->LineId = 0;
    if($current->LineNbr == '') $current->LineNbr = 0;
    if($current->PaidAmt == '') $current->PaidAmt = 0;
    if($current->Qty == '') $current->Qty = 0;
    if($current->TranAmt == '') $current->TranAmt = 0;
    if($current->TranBal == '') $current->TranBal = 0;
    if($current->UnitPrice == '') $current->UnitPrice = 0;
    if($current->User3 == '') $current->User3 = 0;
    if($current->User4 == '') $current->User4 = 0;
    
    $insSQL = "insert into ARTRAN( ";
    $cols = array_keys($this->accessorNames);  
    $insSQL .= '"' . reset($cols) . '"';
    while($col = next($cols))
      $insSQL .= ', "' . $col . '"';
    $insSQL .= " ) Values ( 
  '$current->Acct',       '$current->AcctDist',   '$current->BatNbr',     $current->Chksum,
  $current->CmmnPct,   $current->CnvFact,    '$current->CostType',   '$current->CustId',
  '$current->DrCr',       '$current->Except',     $current->ExtCost,    '$current->InvtId',
  '$current->JobId',      $current->JobRate,    '$current->JrnlType',   $current->LineId,
  $current->LineNbr,    '$current->LotSerNbr',  $current->PaidAmt,    '$current->PerEnt',
  '$current->PerPost',    '$current->PhaseId',    $current->Qty,        '$current->RateBaseFlg',
  '$current->RefNbr',     '$current->Rlsed',      '$current->ScrnNbr',    '$current->SiteId',
  '$current->SlsperId',   '$current->Sub',        $current->TranAmt,    $current->TranBal,
  '$current->TranDate',   '$current->TranDesc',   '$current->TranType',   '$current->UnitDescr',
  $current->UnitPrice,  'Moe',                  '$current->User1',      '$current->User2',      
  $current->User3,      $current->User4,      '$current->WhseLoc')";
  return $insSQL;
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update ARTRAN set
  acct='$current->Acct',
  acctdist='$current->AcctDist',
  batnbr='$current->BatNbr',
  chksum='$current->Chksum',
  cmmnpct='$current->CmmnPct',
  cnvfact='$current->CnvFact',
  costtype='$current->CostType',
  custid='$current->CustId',
  drcr='$current->DrCr',
  except='$current->Except',
  extcost='$current->ExtCost',
  invtid='$current->InvtId',
  jobid='$current->JobId',
  jobrate='$current->JobRate',
  jrnltype='$current->JrnlType',
  lineid='$current->LineId',
  linenbr='$current->LineNbr',
  lotsernbr='$current->LotSerNbr',
  paidamt='$current->PaidAmt',
  perent='$current->PerEnt',
  perpost='$current->PerPost',
  phaseid='$current->PhaseId',
  qty='$current->Qty',
  ratebaseflg='$current->RateBaseFlg',
  refnbr='$current->RefNbr',
  rlsed='$current->Rlsed',
  scrnnbr='$current->ScrnNbr',
  siteid='$current->SiteId',
  slsperid='$current->SlsperId',
  sub='$current->Sub',
  tranamt='$current->TranAmt',
  tranbal='$current->TranBal',
  trandate='$current->TranDate',
  trandesc='$current->TranDesc',
  trantype='$current->TranType',
  unitdescr='$current->UnitDescr',
  unitprice='$current->UnitPrice',
  upduserid='$current->UpdUserId',
  user1='$current->User1',
  user2='$current->User2',
  user3='$current->User3',
  user4='$current->User4',
  whseloc='$current->WhseLoc'";
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from ARTRAN
  where  ARTranId='$this->ARTranId'  
  and Batnbr='$this->Batnbr'
  and Custid='$this->Custid'
  and Drcr='$this->Drcr'
  and Invtid='$this->Invtid'
  and Jrnltype='$this->Jrnltype'
  and Lineid='$this->Lineid'
  and Linenbr='$this->Linenbr'
  and Lotsernbr='$this->Lotsernbr'
  and Refnbr='$this->Refnbr'
  and Rlsed='$this->Rlsed'
  and Siteid='$this->Siteid'
  and Slsperid='$this->Slsperid'
  and Sub='$this->Sub'
  and Perent>='$this->beginSub'
  and Perent<='$this->endSub'
  and Perpost>='$this->beginSub'
  and Perpost<='$this->endSub'
  and Trandate>='$this->beginSub'
  and Trandate<='$this->endSub'
  ";
  }
} // class ARTran

?>
