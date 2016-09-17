<?php
/*
This script was generated on 2006-09-22 at 09:25:07
The generating script used was /test/blester/frameworkmodelgen.php
It was run on server devnew.htwp.com
The template file name was FrameWorkModelGen.tpl
The Smarty version was 2.6.14
dbTable   ARDOC
className ARDoc
*/
/**
 * ARDoc - class
 * This class provides access to the ARDOC table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class ARDoc extends SolModel
  {
  /**
   * Keys - data members used to filter the object list
   */   
  private $ArYear;
  private $BatNbr;
  private $CustId;
  private $CustOrdNbr;
  private $DocClass;
  private $DocType;
  private $OpenDoc;
  private $RefNbr;
  private $Rlsed;
  private $SlsperId;
  /**
   * Ranges - data members used to filter the object list
   */   
  private $beginArYear;
  private $endArYear;
  private $beginDocDate;
  private $endDocDate;
  private $beginPerClosed;
  private $endPerClosed;
  private $beginPerEnt;
  private $endPerEnt;
  private $beginPerPost;
  private $endPerPost;
  
  public function __construct()
  {
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setArYear($inArYear)
  {
    $this->ArYear=$inArYear;
    return $this->ArYear;
  }
  public function getArYear()
  {
    return $this->ArYear;
  }

  public function setBatNbr($inBatNbr)
  {
    $this->BatNbr=$inBatNbr;
    return $this->BatNbr;
  }
  public function getBatNbr()
  {
    return $this->BatNbr;
  }

  public function setCustId($inCustId)
  {
    $this->CustId=$inCustId;
    return $this->CustId;
  }
  public function getCustId()
  {
    return $this->CustId;
  }

  public function setCustOrdNbr($inCustOrdNbr)
  {
    $this->CustOrdNbr=$inCustOrdNbr;
    return $this->CustOrdNbr;
  }
  public function getCustOrdNbr()
  {
    return $this->CustOrdNbr;
  }

  public function setDocClass($inDocClass)
  {
    $this->DocClass=$inDocClass;
    return $this->DocClass;
  }
  public function getDocClass()
  {
    return $this->DocClass;
  }

  public function setDocType($inDocType)
  {
    $this->DocType=$inDocType;
    return $this->DocType;
  }
  public function getDocType()
  {
    return $this->DocType;
  }

  public function setOpenDoc($inOpenDoc)
  {
    $this->OpenDoc=$inOpenDoc;
    return $this->OpenDoc;
  }
  public function getOpenDoc()
  {
    return $this->OpenDoc;
  }

  public function setRefNbr($inRefNbr)
  {
    $this->RefNbr=$inRefNbr;
    return $this->RefNbr;
  }
  public function getRefNbr()
  {
    return $this->RefNbr;
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

  public function setSlsperId($inSlsperId)
  {
    $this->SlsperId=$inSlsperId;
    return $this->SlsperId;
  }
  public function getSlsperId()
  {
    return $this->SlsperId;
  }

  /**
   * Ranges - get set methods
   */   
  public function setArYearRange($inBeginArYear, $inEndArYear)
  {
    $this->beginArYear = $inBeginArYear;
    $this->endArYear = $inEndArYear;
  }
  public function getBeginArYearRange()
  {
    return $this->beginArYear;
  }
  public function getEndArYearRange()
  {
    return $this->endArYear;
  }

  public function setDocDateRange($inBeginDocDate, $inEndDocDate)
  {
    $this->beginDocDate = $inBeginDocDate;
    $this->endDocDate = $inEndDocDate;
  }
  public function getBeginDocDateRange()
  {
    return $this->beginDocDate;
  }
  public function getEndDocDateRange()
  {
    return $this->endDocDate;
  }

  public function setPerClosedRange($inBeginPerClosed, $inEndPerClosed)
  {
    $this->beginPerClosed = $inBeginPerClosed;
    $this->endPerClosed = $inEndPerClosed;
  }
  public function getBeginPerClosedRange()
  {
    return $this->beginPerClosed;
  }
  public function getEndPerClosedRange()
  {
    return $this->endPerClosed;
  }

  public function setPerEntRange($inBeginPerEnt, $inEndPerEnt)
  {
    $this->beginPerEnt = $inBeginPerEnt;
    $this->endPerEnt = $inEndPerEnt;
  }
  public function getBeginPerEntRange()
  {
    return $this->beginPerEnt;
  }
  public function getEndPerEntRange()
  {
    return $this->endPerEnt;
  }

  public function setPerPostRange($inBeginPerPost, $inEndPerPost)
  {
    $this->beginPerPost = $inBeginPerPost;
    $this->endPerPost = $inEndPerPost;
  }
  public function getBeginPerPostRange()
  {
    return $this->beginPerPost;
  }
  public function getEndPerPostRange()
  {
    return $this->endPerPost;
  }

  /**
   * Associate ARDoc accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'AgeClose'	=> 'AgeClose',	// Age Close (Char-1)
   'ApplAmt'	=> 'ApplAmt',	// Applied Amt (Float-8)
   'ArYear'	=> 'ArYear',	// Accounts Receivable Year (Char-1)
   'BatNbr'	=> 'BatNbr',	// Bat Number (ZString-7)
   'Chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'CmmnAmt'	=> 'CmmnAmt',	// Cmmn Amt (Float-8)
   'CmmnPct'	=> 'CmmnPct',	// Cmmn Percent (Float-8)
   'Current'	=> 'Current',	// Current (Char-1)
   'CustId'	=> 'CustId',	// Customer ID (ZString-11)
   'CustOrdNbr'	=> 'CustOrdNbr',	// Customer Order Number (ZString-16)
   'Cycle'	=> 'Cycle',	// Cycle (Integer-2)
   'DiscApplAmt'	=> 'DiscApplAmt',	// Discount Applied Amt (Float-8)
   'DiscBal'	=> 'DiscBal',	// Discount Balance (Float-8)
   'DiscDate'	=> 'DiscDate',	// Discount Date (Date-4)
   'DocBal'	=> 'DocBal',	// Document Balance (Float-8)
   'DocClass'	=> 'DocClass',	// Document Class (Char-1)
   'DocDate'	=> 'DocDate',	// Document Date (Date-4)
   'DocDesc'	=> 'DocDesc',	// Document Desc (ZString-31)
   'DocSort'	=> 'DocSort',	// Document Sort (Char-1)
   'DocType'	=> 'DocType',	// Document Type (ZString-3)
   'DueDate'	=> 'DueDate',	// Due Date (Date-4)
   'JobCounter'	=> 'JobCounter',	// Job Counter (Integer-2)
   'LineCntr'	=> 'LineCntr',	// Line Counter (Integer-4)
   'NbrCycle'	=> 'NbrCycle',	// Number Cycle (Integer-2)
   'OpenDoc'	=> 'OpenDoc',	// Open Document (Char-1)
   'OrigDocAmt'	=> 'OrigDocAmt',	// Orig Document Amt (Float-8)
   'PerClosed'	=> 'PerClosed',	// Period Closed (ZString-7)
   'PerEnt'	=> 'PerEnt',	// Period Ent (ZString-7)
   'PerPost'	=> 'PerPost',	// Period Post (ZString-7)
   'RefNbr'	=> 'RefNbr',	// Ref Number (ZString-7)
   'Rlsed'	=> 'Rlsed',	// Rlsed (Char-1)
   'ScrnNbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'SlsperId'	=> 'SlsperId',	// Sales Person ID (ZString-11)
   'Sub'	=> 'Sub',	// Subaccount (ZString-25)
   'Terms'	=> 'Terms',	// Terms (ZString-3)
   'UpdUserId'	=> 'UpdUserId',	// Update User ID (ZString-4)
   'User1'	=> 'User1',	// User 1 (ZString-31)
   'User2'	=> 'User2',	// User 2 (ZString-31)
   'User3'	=> 'User3',	// User 3 (Float-8)
   'User4'	=> 'User4',	// User 4 (Float-8)

);
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    $refNbrFilter = ($this->RefNbr == '') ? '' : "RefNbr='$this->RefNbr'";
    $whereClause = ($refNbrFilter == '') ? '' : "where $refNbrFilter";
    $openSQL =  "select ";  
    $cols = array(
  'AgeClose',   'ApplAmt',      'ArYear',       'BatNbr',
  'Chksum',     'CmmnAmt',      'CmmnPct',      'Current',
  'CustId',     'CustOrdNbr',   'Cycle',        'DiscApplAmt',
  'DiscBal',    'DiscDate',     'DocBal',       'DocClass',
  'DocDate',    'DocDesc',      'DocSort',      'DocType',
  'DueDate',    'JobCounter',   'LineCntr',     'NbrCycle',
  'OpenDoc',    'OrigDocAmt',   'PerClosed',    'PerEnt',
  'PerPost',    'RefNbr',       'Rlsed',        'ScrnNbr',
  'SlsperId',   'Sub',          'Terms',        'UpdUserId',
  'User1',      'User2',        'User3',        'User4');
    $openSQL .= reset($cols);
    while($col = next($cols))
      $openSQL .= ', "' . $col . '"';
    $openSQL .= ' from ARDOC ' . $whereClause;
    return $openSQL;
  }

  protected function getInsertSQL($current)
  {
    $current->UpdUserId='Moe';
    
    $current->Chksum = 0;
    $current->User3 = 0;
    $current->User4 = 0;
    $insSQL = 'insert into ardoc (';
    $cols = array(
  'AgeClose',   'ApplAmt',      'ArYear',       'BatNbr',
  'Chksum',     'CmmnAmt',      'CmmnPct',      'Current',
  'CustId',     'CustOrdNbr',   'Cycle',        'DiscApplAmt',
  'DiscBal',    'DiscDate',     'DocBal',       'DocClass',
  'DocDate',    'DocDesc',      'DocSort',      'DocType',
  'DueDate',    'JobCounter',   'LineCntr',     'NbrCycle',
  'OpenDoc',    'OrigDocAmt',   'PerClosed',    'PerEnt',
  'PerPost',    'RefNbr',       'Rlsed',        'ScrnNbr',
  'SlsperId',   'Sub',          'Terms',        'UpdUserId',
  'User1',      'User2',        'User3',        'User4');
    $insSQL .= reset($cols);
    while($col = next($cols))
      $insSQL .= ', "' . $col . '"';
    $insSQL .= 
  ") values ( 
  '$current->AgeClose',   $current->ApplAmt,    '$current->ArYear',   '$current->BatNbr',
  $current->Chksum,   $current->CmmnAmt,    $current->CmmnPct,    '$current->Current',
  '$current->CustId',   '$current->CustOrdNbr',   $current->Cycle,    $current->DiscApplAmt,
  $current->DiscBal,    '$current->DiscDate',   $current->DocBal,   '$current->DocClass',
  '$current->DocDate',    '$current->DocDesc',    '$current->DocSort',    '$current->DocType',
  '$current->DueDate',    $current->JobCounter,   $current->LineCntr,   $current->NbrCycle,
  '$current->OpenDoc',    $current->OrigDocAmt,   '$current->PerClosed',    '$current->PerEnt',
  '$current->PerPost',    '$current->RefNbr',   '$current->Rlsed',    '$current->ScrnNbr',
  '$current->SlsperId',   '$current->Sub',    '$current->Terms',    'Moe',
  '$current->User1',    '$current->User2',    $current->User3,    $current->User4)";
//  if($current->RefNbr == 'M70187')
//    return 'What tha ...';
  return $insSQL;
  }
  
  protected function getUpdateSQL($current)
  {
    // update for ardoc.linecntr
   /* update ardoc h
     set h.LineCntr=(select count(d.linenbr) from artran d where D.refnbr=h.refnbr)
    where h.refnbr in ('X20969','X20971','X20972')
  */
    $current->UpdUserId='Moe';
    if(($current->LineCntr <> '') && ($current->LineCntr > 0))
      $sql = 
      "update ardoc h  
      set h.LineCntr=$current->LineCntr
      where h.refnbr = '$current->RefNbr' 
      and DocType='$current->DocType'";
    else
    {  
      $sql =  
      "update ARDOC set
    AgeClose='$current->AgeClose',    ApplAmt='$current->ApplAmt',    ArYear='$current->ArYear',    BatNbr='$current->BatNbr',
    Chksum='$current->Chksum',    CmmnAmt='$current->CmmnAmt',    CmmnPct='$current->CmmnPct',    Current='$current->Current',
    CustId='$current->CustId',    CustOrdNbr='$current->CustOrdNbr',    Cycle='$current->Cycle',    DiscApplAmt='$current->DiscApplAmt',
    DiscBal='$current->DiscBal',    DiscDate='$current->DiscDate',    DocBal='$current->DocBal',    DocClass='$current->DocClass',
    DocDate='$current->DocDate',    DocDesc='$current->DocDesc',    DocSort='$current->DocSort',    DocType='$current->DocType',
    DueDate='$current->DueDate',    JobCounter='$current->JobCounter',    LineCntr='$current->LineCntr',    NbrCycle='$current->NbrCycle',
    OpenDoc='$current->OpenDoc',    OrigDocAmt='$current->OrigDocAmt',    PerClosed='$current->PerClosed',    PerEnt='$current->PerEnt',
    PerPost='$current->PerPost',    RefNbr='$current->RefNbr',    Rlsed='$current->Rlsed',    ScrnNbr='$current->ScrnNbr',
    SlsperId='$current->SlsperId',    Sub='$current->Sub',    Terms='$current->Terms',    UpdUserId='$current->UpdUserId',
    User1='$current->User1',    User2='$current->User2',    User3='$current->User3',    User4='$current->User4'";
    }
    return $sql;
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from ARDOC
  where  ARDocId='$this->ARDocId'  
  and ArYear='$this->ArYear'
  and BatNbr='$this->BatNbr'
  and CustId='$this->CustId'
  and CustOrdNbr='$this->CustOrdNbr'
  and DocClass='$this->DocClass'
  and DocType='$this->DocType'
  and OpenDoc='$this->OpenDoc'
  and RefNbr='$this->RefNbr'
  and Rlsed='$this->Rlsed'
  and SlsperId='$this->SlsperId'
  and ArYear>='$this->beginSlsperId'
  and ArYear<='$this->endSlsperId'
  and DocDate>='$this->beginSlsperId'
  and DocDate<='$this->endSlsperId'
  and PerClosed>='$this->beginSlsperId'
  and PerClosed<='$this->endSlsperId'
  and PerEnt>='$this->beginSlsperId'
  and PerEnt<='$this->endSlsperId'
  and PerPost>='$this->beginSlsperId'
  and PerPost<='$this->endSlsperId'
  ";
  }
} // class ARDoc


?>
