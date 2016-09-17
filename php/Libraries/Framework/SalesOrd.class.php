<?php
/**
 *  salesOrd - class
 * This class provides access to the SALESORD table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class SalesOrd extends SolModel
  {
  /**
   * Keys - data members used to filter the object list
   */   
  private $BOCntr;
  private $CustId;
  private $CustOrdNbr;
  private $InvcNbr;
  private $OpenSO;
  private $OrdNbr = '';
  private $OrdType;
  private $OurPONbr;
  private $SlsperId;
  private $Status;
  private $SiteID = '';
  private $Terms;
  /**
   * Ranges - data members used to filter the object list
   */   
  private $beginOrdDate;
  private $endOrdDate;
  private $beginPerClosed;
  private $endPerClosed;
  private $beginPerEnt;
  private $endPerEnt;
  private $beginShipDate;
  private $endShipDate;
  
  public function __construct()
  {
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setBOCntr($inBOCntr)
  {
    $this->BOCntr=$inBOCntr;
    return $this->BOCntr;
  }
  public function getBOCntr()
  {
    return $this->BOCntr;
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

  public function setInvcNbr($inInvcNbr)
  {
    $this->InvcNbr=$inInvcNbr;
    return $this->InvcNbr;
  }
  public function getInvcNbr()
  {
    return $this->InvcNbr;
  }

  public function setOpenSO($inOpenSO)
  {
    $this->OpenSO=$inOpenSO;
    return $this->OpenSO;
  }
  public function getOpenSO()
  {
    return $this->OpenSO;
  }

  public function setOrdNbr($inOrdNbr)
  {
    $this->OrdNbr=$inOrdNbr;
    return $this->OrdNbr;
  }
  public function getOrdNbr()
  {
    return $this->OrdNbr;
  }

  public function setOrdType($inOrdType)
  {
    $this->OrdType=$inOrdType;
    return $this->OrdType;
  }
  public function getOrdType()
  {
    return $this->OrdType;
  }

  public function setOurPONbr($inOurPONbr)
  {
    $this->OurPONbr=$inOurPONbr;
    return $this->OurPONbr;
  }
  public function getOurPONbr()
  {
    return $this->OurPONbr;
  }

  public function setSiteID($inSiteID)
  {
    $this->SiteID=$inSiteID;
    return $this->SiteID;
  }
  public function getSiteID()
  {
    return $this->SiteID;
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

  public function setStatus($inStatus)
  {
    $this->Status=$inStatus;
    return $this->Status;
  }
  public function getStatus()
  {
    return $this->Status;
  }

  public function setTerms($inTerms)
  {
    $this->Terms=$inTerms;
    return $this->Terms;
  }
  public function getTerms()
  {
    return $this->Terms;
  }

  /**
   * Ranges - get set methods
   */   
  public function setOrdDateRange($inBeginOrdDate, $inEndOrdDate)
  {
    $this->beginOrdDate = $inBeginOrdDate;
    $this->endOrdDate = $inEndOrdDate;
  }
  public function getBeginOrdDateRange()
  {
    return $this->beginOrdDate;
  }
  public function getEndOrdDateRange()
  {
    return $this->endOrdDate;
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

  public function setShipDateRange($inBeginShipDate, $inEndShipDate)
  {
    $this->beginShipDate = $inBeginShipDate;
    $this->endShipDate = $inEndShipDate;
  }
  public function getBeginShipDateRange()
  {
    return $this->beginShipDate;
  }
  public function getEndShipDateRange()
  {
    return $this->endShipDate;
  }

  /**
   * Associate salesOrd accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'billaddr2'	 => 'BillAddr2',	// Bill Address 2 (ZString-31)
   'billcity'	=> 'BillCity',	// Bill City (ZString-31)
   'billfirstname'	=> 'BillFirstName',	// Bill First Name (ZString-31)
   'billlastname'	=> 'BillLastName',	// Bill Last Name (ZString-31)
   'billstate'	=> 'BillState',	// Bill State (ZString-4)
   'billzip'	=> 'BillZip',	// Bill Zip (ZString-11)
   'blktordnbr'	=> 'BlktOrdNbr',	// Blkt Order Number (ZString-7)
   'bocntr'	=> 'BOCntr',	// BO Counter (Integer-2)
   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'cmmnpct'	=> 'CmmnPct',	// Cmmn Percent (Float-8)
   'creditchk'	=> 'CreditChk',	// Credit Chk (Char-1)
   'custid'	=> 'CustId',	// Customer ID (ZString-11)
   'custordnbr'	=> 'CustOrdNbr',	// Customer Order Number (ZString-16)
   'docdesc'	=> 'DocDesc',	// Document Desc (ZString-31)
   'fob'	=> 'FOB',	// FOB (ZString-16)
   'freight'	=> 'Freight',	// Freight (Float-8)
   'invcnbr'	=> 'InvcNbr',	// Invoice Number (ZString-7)
   'invctot'	=> 'InvcTot',	// Invoice Total (Float-8)
   'linecntr'	=> 'LineCntr',	// Line Counter (Integer-4)
   'miscchrg'	=> 'MiscChrg',	// Misc Charge (Float-8)
   'openso'	=> 'OpenSO',	// Open SO (Char-1)
   'orddate'	=> 'OrdDate',	// Order Date (Date-4)
   'ordnbr'	=> 'OrdNbr',	// Order Number (ZString-7)
   'ordtot'	=> 'OrdTot',	// Order Total (Float-8)
   'ordtype'	=> 'OrdType',	// Order Type (ZString-3)
   'ourponbr'	=> 'OurPONbr',	// Our PO Number (ZString-7)
   'perclosed'	=> 'PerClosed',	// Period Closed (ZString-7)
   'perent'	=> 'PerEnt',	// Period Ent (ZString-7)
   'prevordnbr'	=> 'PrevOrdNbr',	// Previous Order Number (ZString-7)
   'prevordtype'	=> 'PrevOrdType',	// Previous Order Type (ZString-3)
   'prt'	=> 'Prt',	// Printed (Char-1)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'shipaddr1'	=> 'ShipAddr1',	// Shipment Address 1 (ZString-31)
   'shipaddr2'	=> 'ShipAddr2',	// Shipment Address 2 (ZString-31)
   'shipaddressid'	=> 'ShipAddressId',	// Shipment Address ID (ZString-11)
   'shipcity'	=> 'ShipCity',	// Shipment City (ZString-31)
   'shipcmplt'	=> 'ShipCmplt',	// Shipment Complete (Char-1)
   'shipdate'	=> 'ShipDate',	// Shipment Date (Date-4)
   'shipfirstname'	=> 'ShipFirstName',	// Shipment First Name (ZString-31)
   'shiplastname'	=> 'ShipLastName',	// Shipment Last Name (ZString-31)
   'shipstate'	=> 'ShipState',	// Shipment State (ZString-4)
   'shipvia'	=> 'ShipVia',	// Shipment Via (ZString-16)
   'shipzip'	=> 'ShipZip',	// Shipment Zip (ZString-11)
   'slsperid'	=> 'SlsperId',	// Sales Person ID (ZString-11)
   'status'	=> 'Status',	// Status (Char-1)
   'terms'	=> 'Terms',	// Terms (ZString-3)
   'tradedisc'	=> 'TradeDisc',	// Trade Discount (Float-8)
   'upduserid'	=> 'UpdUserId',	// Update User ID (ZString-4)
   'user1'	=> 'SiteType',	// Site Type in User 1 (ZString-31)
   'user2'	=> 'User2',	// User 2 (ZString-31)
   'user3'	=> 'User3',	// User 3 (Float-8)
   'user4'	=> 'User4',	// User 4 (Float-8)
);
  
  // Calculated data members. HTResult objects owned by this class call these
  // methods to calculate values when they are accessed.
  public function ARSubAcct($knowns)
  {
    $site = 'ERR';
    switch (substr($knowns['SiteType'],0,1)) {
    	case "T" : $site="THO"; break;
    	case "P" : $site="PBA"; break;
    	case "M" : $site="MIL"; break;
    	case "D" : $site="DET"; break;
    	case "W" : $site="WIN"; break;
    	default : throw new Exception("SalesOrd cannot calulate ARSubAcct");
    }
    return $site;
  }
  /**
   * Define SQL used to open, insert, update and delete
   */       
  public function getOpenSQL()
  {
  if($this->OpenSO != '') $flts[] = " OpenSO='$this->OpenSO'";
  if(($this->beginOrdDate != '') && ($this->endOrdDate != ''))
    $flts[] = " OrdDate>='$this->beginOrdDate' and OrdDate<='$this->endOrdDate'";
  if($this->Status != '') $flts[] = " status='$this->Status'";
  if($this->OrdNbr != '') $flts[] = " OrdNbr='$this->OrdNbr'";
  if($this->SiteID != '')
  {
    $usite = strtoupper($this->SiteID);
    $siteChr = substr($usite, 0, 1);
    $filts[] = " OrdNbr like '$siteChr%'";
  }
  if(count($flts)>0)
  { 
    $where = "where " . reset($flts);
    while($flt = next($flts))
    {
      $where .= " and " . $flt;
    }
  }
  else
    $where = '';
  
    return "select  
  BillAddr2,
  BillCity,
  BillFirstName,
  BillLastName,
  BillState,
  BillZip,
  BlktOrdNbr,
  BOCntr,
  Chksum,
  CmmnPct,
  CreditChk,
  CustId,
  CustOrdNbr,
  DocDesc,
  FOB,
  Freight,
  InvcNbr,
  InvcTot,
  LineCntr,
  MiscChrg,
  OpenSO,
  OrdDate,
  OrdNbr,
  OrdTot,
  OrdType,
  OurPONbr,
  PerClosed,
  PerEnt,
  PrevOrdNbr,
  PrevOrdType,
  Prt,
  ScrnNbr,
  ShipAddr1,
  ShipAddr2,
  ShipAddressId,
  ShipCity,
  ShipCmplt,
  ShipDate,
  ShipFirstName,
  ShipLastName,
  ShipState,
  ShipVia,
  ShipZip,
  SlsperId,
  Status,
  Terms,
  TradeDisc,
  UpdUserId,
  User1,
  User2,
  User3,
  User4
  from SALESORD
  $where
  order by OrdDate";

  // Filter by keys or ranges here. Example:
  // where  salesOrdId=$this->salesOrdId  
  // and BOCntr='$this->BOCntr'
  // and CustId='$this->CustId'
  // and CustOrdNbr='$this->CustOrdNbr'
  // and InvcNbr='$this->InvcNbr'
  // and OpenSO='$this->OpenSO'
  // and OrdNbr='$this->OrdNbr'
  // and OrdType='$this->OrdType'
  // and OurPONbr='$this->OurPONbr'
  // and SlsperId='$this->SlsperId'
  // and Status='$this->Status'
  // and Terms='$this->Terms'
  // and OrdDate>='$this->beginOrdDate'
  // and OrdDate<='$this->endOrdDate'
  // and PerClosed>='$this->beginPerClosed'
  // and PerClosed<='$this->endPerClosed'
  // and PerEnt>='$this->beginPerEnt'
  // and PerEnt<='$this->endPerEnt'
  // and ShipDate>='$this->beginShipDate'
  // and ShipDate<='$this->endShipDate'
  }

  protected function getInsertSQL($current)
  {
    return 
    "insert into SALESORD( 
  BillAddr2,
  BillCity,
  BillFirstName,
  BillLastName,
  BillState,
  BillZip,
  BlktOrdNbr,
  BOCntr,
  Chksum,
  CmmnPct,
  CreditChk,
  CustId,
  CustOrdNbr,
  DocDesc,
  FOB,
  Freight,
  InvcNbr,
  InvcTot,
  LineCntr,
  MiscChrg,
  OpenSO,
  OrdDate,
  OrdNbr,
  OrdTot,
  OrdType,
  OurPONbr,
  PerClosed,
  PerEnt,
  PrevOrdNbr,
  PrevOrdType,
  Prt,
  ScrnNbr,
  ShipAddr1,
  ShipAddr2,
  ShipAddressId,
  ShipCity,
  ShipCmplt,
  ShipDate,
  ShipFirstName,
  ShipLastName,
  ShipState,
  ShipVia,
  ShipZip,
  SlsperId,
  Status,
  Terms,
  TradeDisc,
  UpdUserId,
  User1,
  User2,
  User3,
  User4)
  values(
  '$current->BillAddr2',
  '$current->BillCity',
  '$current->BillFirstName',
  '$current->BillLastName',
  '$current->BillState',
  '$current->BillZip',
  '$current->BlktOrdNbr',
  '$current->BOCntr',
  '$current->Chksum',
  '$current->CmmnPct',
  '$current->CreditChk',
  '$current->CustId',
  '$current->CustOrdNbr',
  '$current->DocDesc',
  '$current->FOB',
  '$current->Freight',
  '$current->InvcNbr',
  '$current->InvcTot',
  '$current->LineCntr',
  '$current->MiscChrg',
  '$current->OpenSO',
  '$current->OrdDate',
  '$current->OrdNbr',
  '$current->OrdTot',
  '$current->OrdType',
  '$current->OurPONbr',
  '$current->PerClosed',
  '$current->PerEnt',
  '$current->PrevOrdNbr',
  '$current->PrevOrdType',
  '$current->Prt',
  '$current->ScrnNbr',
  '$current->ShipAddr1',
  '$current->ShipAddr2',
  '$current->ShipAddressId',
  '$current->ShipCity',
  '$current->ShipCmplt',
  '$current->ShipDate',
  '$current->ShipFirstName',
  '$current->ShipLastName',
  '$current->ShipState',
  '$current->ShipVia',
  '$current->ShipZip',
  '$current->SlsperId',
  '$current->Status',
  '$current->Terms',
  '$current->TradeDisc',
  '$current->UpdUserId',
  '$current->User1',
  '$current->User2',
  '$current->User3',
  '$current->User4')";
  
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update SALESORD set
  BillAddr2='$current->BillAddr2',
  BillCity='$current->BillCity',
  BillFirstName='$current->BillFirstName',
  BillLastName='$current->BillLastName',
  BillState='$current->BillState',
  BillZip='$current->BillZip',
  BlktOrdNbr='$current->BlktOrdNbr',
  BOCntr='$current->BOCntr',
  Chksum='$current->Chksum',
  CmmnPct='$current->CmmnPct',
  CreditChk='$current->CreditChk',
  CustId='$current->CustId',
  CustOrdNbr='$current->CustOrdNbr',
  DocDesc='$current->DocDesc',
  FOB='$current->FOB',
  Freight='$current->Freight',
  InvcNbr='$current->InvcNbr',
  InvcTot='$current->InvcTot',
  LineCntr='$current->LineCntr',
  MiscChrg='$current->MiscChrg',
  OpenSO='$current->OpenSO',
  OrdDate='$current->OrdDate',
  OrdNbr='$current->OrdNbr',
  OrdTot='$current->OrdTot',
  OrdType='$current->OrdType',
  OurPONbr='$current->OurPONbr',
  PerClosed='$current->PerClosed',
  PerEnt='$current->PerEnt',
  PrevOrdNbr='$current->PrevOrdNbr',
  PrevOrdType='$current->PrevOrdType',
  Prt='$current->Prt',
  ScrnNbr='$current->ScrnNbr',
  ShipAddr1='$current->ShipAddr1',
  ShipAddr2='$current->ShipAddr2',
  ShipAddressId='$current->ShipAddressId',
  ShipCity='$current->ShipCity',
  ShipCmplt='$current->ShipCmplt',
  ShipDate='$current->ShipDate',
  ShipFirstName='$current->ShipFirstName',
  ShipLastName='$current->ShipLastName',
  ShipState='$current->ShipState',
  ShipVia='$current->ShipVia',
  ShipZip='$current->ShipZip',
  SlsperId='$current->SlsperId',
  Status='$current->Status',
  Terms='$current->Terms',
  TradeDisc='$current->TradeDisc',
  UpdUserId='$current->UpdUserId',
  User1='$current->User1',
  User2='$current->User2',
  User3='$current->User3',
  User4='$current->User4'";
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from SALESORD
  where  salesOrdId='$this->salesOrdId'  
  and BOCntr='$this->BOCntr'
  and CustId='$this->CustId'
  and CustOrdNbr='$this->CustOrdNbr'
  and InvcNbr='$this->InvcNbr'
  and OpenSO='$this->OpenSO'
  and OrdNbr='$this->OrdNbr'
  and OrdType='$this->OrdType'
  and OurPONbr='$this->OurPONbr'
  and SlsperId='$this->SlsperId'
  and Status='$this->Status'
  and Terms='$this->Terms'
  and OrdDate>='$this->beginTerms'
  and OrdDate<='$this->endTerms'
  and PerClosed>='$this->beginTerms'
  and PerClosed<='$this->endTerms'
  and PerEnt>='$this->beginTerms'
  and PerEnt<='$this->endTerms'
  and ShipDate>='$this->beginTerms'
  and ShipDate<='$this->endTerms'
  ";
  }
} // class salesOrd

