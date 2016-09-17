<?php
/**
 * salesOrderDetail - class
 * This class provides access to the SODET table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class salesOrderDetail extends SolModel
  {
  /**
   * salesOrderDetailId - Primary index used to uniquely 
   *  identify a salesOrderDetail object.
   */  
  private $salesOrderDetailId;
  /**
   * Keys - data members used to filter the object list
   */   
  private $Bocntr;
  private $Custid;
  private $Invtid;
  private $Lineid;
  private $Linenbr;
  private $Lotsernbr;
  private $Openline;
  private $Ordnbr;
  private $Ordtype;
  private $Siteid;
  private $Status;
  private $Whseloc;
  
  public function __construct($inOrdnbr = '', $inOrdtype = '', $inBocntr = '')
  {
    $this->Ordnbr = $inOrdnbr;
    $this->Ordtype=$inOrdtype;
    $this->Bocntr=$inBocntr;
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setBocntr($inBocntr)
  {
    $this->Bocntr=$inBocntr;
    return $this->Bocntr;
  }
  public function getBocntr()
  {
    return $this->Bocntr;
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

  public function setInvtid($inInvtid)
  {
    $this->Invtid=$inInvtid;
    return $this->Invtid;
  }
  public function getInvtid()
  {
    return $this->Invtid;
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

  public function setOpenline($inOpenline)
  {
    $this->Openline=$inOpenline;
    return $this->Openline;
  }
  public function getOpenline()
  {
    return $this->Openline;
  }

  public function setOrdnbr($inOrdnbr)
  {
    $this->Ordnbr=$inOrdnbr;
    return $this->Ordnbr;
  }
  public function getOrdnbr()
  {
    return $this->Ordnbr;
  }

  public function setOrdtype($inOrdtype)
  {
    $this->Ordtype=$inOrdtype;
    return $this->Ordtype;
  }
  public function getOrdtype()
  {
    return $this->Ordtype;
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

  public function setStatus($inStatus)
  {
    $this->Status=$inStatus;
    return $this->Status;
  }
  public function getStatus()
  {
    return $this->Status;
  }

  public function setWhseloc($inWhseloc)
  {
    $this->Whseloc=$inWhseloc;
    return $this->Whseloc;
  }
  public function getWhseloc()
  {
    return $this->Whseloc;
  }

  /**
   * Associate salesOrderDetail accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'bocntr'	=> 'BOCntr',	// BO Counter (Integer-2)
   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'cmmnpct'	=> 'CmmnPct',	// Cmmn Percent (Float-8)
   'cnvfact'	=> 'CnvFact',	// Cnv Fact (Float-8)
   'cost'	=> 'Cost',	// Cost (Float-8)
   'custid'	=> 'CustId',	// Customer ID (ZString-11)
   'descr'	=> 'Descr',	// Descr (ZString-61)
   'discamt'	=> 'DiscAmt',	// Discount Amt (Float-8)
   'extprice'	=> 'ExtPrice',	// Ext Price (Float-8)
   'extpriceinvc'	=> 'ExtPriceInvc',	// Ext Price Invoice (Float-8)
   'invtid'	=> 'InvtId',	// Inventory ID (ZString-21)
   'lineid'	=> 'LineId',	// Line ID (Integer-4)
   'linenbr'	=> 'LineNbr',	// Line Number (Integer-4)
   'lotsernbr'	=> 'LotSerNbr',	// Lot Ser Number (ZString-16)
   'openline'	=> 'OpenLine',	// Open Line (Char-1)
   'ordnbr'	=> 'OrdNbr',	// Order Number (ZString-7)
   'ordqty'	=> 'OrdQty',	// Order Quantity (Float-8)
   'ordtype'	=> 'OrdType',	// Order Type (ZString-3)
   'prcchngcode'	=> 'PrcChngCode',	// Price Chng Code (Char-1)
   'qtyship'	=> 'QtyShip',	// Quantity Shipment (Float-8)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'siteid'	=> 'SiteId',	// Site ID (ZString-7)
   'slsprice'	=> 'SlsPrice',	// Sales Price (Float-8)
   'status'	=> 'Status',	// Status (Char-1)
   'stkbaseprc'	=> 'StkBasePrc',	// Stk Base Price (Float-8)
   'sub'	=> 'Sub',	// Subaccount (ZString-25)
   'taxflag'	=> 'TaxFlag',	// Tax Flag (Char-1)
   'unitdesc'	=> 'UnitDesc',	// Unit Desc (ZString-7)
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
    $headerFilter = ($this->Ordnbr == '') ? '' :
  "Ordnbr='$this->Ordnbr'
  and Ordtype='$this->Ordtype'
  and Bocntr='$this->Bocntr'";
    $whereClause = ($headerFilter == '') ? '' : " where $headerFilter";
    $openSQL =  "select ";  
    $cols = array(
    'bocntr',       'chksum',       'cmmnpct',    'cnvfact',
    'cost',         'custid',       'descr',      'discamt',
    'extprice',     'extpriceinvc',   'invtid',   'lineid',
    'linenbr',      'lotsernbr',    'openline',   'ordnbr',
    'ordqty',       'ordtype',      'prcchngcode',    'qtyship',
    'scrnnbr',      'siteid',       'slsprice',   'status',
    'stkbaseprc',   'sub',          'taxflag',    'unitdesc',
    'upduserid',    'user1',        'user2',      'user3',
    'user4',        'whseloc');
    $openSQL .= reset($cols);
    while($col = next($cols))
      $openSQL .= ', "' . $col . '"';
    $openSQL .= ' from SODET ' . $whereClause;
    return $openSQL;
  }

  protected function getInsertSQL($current)
  {
    return 
    $insSQL = "insert into SODET ("; 
    $cols = array(
    'bocntr',       'chksum',       'cmmnpct',    'cnvfact',
    'cost',         'custid',       'descr',      'discamt',
    'extprice',     'extpriceinvc',   'invtid',   'lineid',
    'linenbr',      'lotsernbr',    'openline',   'ordnbr',
    'ordqty',       'ordtype',      'prcchngcode',    'qtyship',
    'scrnnbr',      'siteid',       'slsprice',   'status',
    'stkbaseprc',   'sub',          'taxflag',    'unitdesc',
    'upduserid',    'user1',        'user2',      'user3',
    'user4',        'whseloc');
    $insSQL .= reset($cols);
    while($col = next($cols))
      $insSQL .= ', "' . $col . '"';
    $insSQL .= 
  ") values ( 
  '$current->BOCntr',     '$current->Chksum',     '$current->CmmnPct',    '$current->CnvFact',
  '$current->Cost',       '$current->CustId',     '$current->Descr',      '$current->DiscAmt',
  '$current->ExtPrice',   '$current->ExtPriceInvc',   '$current->InvtId',   '$current->LineId',
  '$current->LineNbr',    '$current->LotSerNbr',    '$current->OpenLine',   '$current->OrdNbr',
  '$current->OrdQty',     '$current->OrdType',    '$current->PrcChngCode',    '$current->QtyShip',
  '$current->ScrnNbr',    '$current->SiteId',     '$current->SlsPrice',   '$current->Status',
  '$current->StkBasePrc',   '$current->Sub',      '$current->TaxFlag',    '$current->UnitDesc',
  '$current->UpdUserId',    '$current->User1',    '$current->User2',      '$current->User3',
  '$current->User4',      '$current->WhseLoc')";
  
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update SODET set
  bocntr='$current->BOCntr',
  chksum='$current->Chksum',
  cmmnpct='$current->CmmnPct',
  cnvfact='$current->CnvFact',
  cost='$current->Cost',
  custid='$current->CustId',
  descr='$current->Descr',
  discamt='$current->DiscAmt',
  extprice='$current->ExtPrice',
  extpriceinvc='$current->ExtPriceInvc',
  invtid='$current->InvtId',
  lineid='$current->LineId',
  linenbr='$current->LineNbr',
  lotsernbr='$current->LotSerNbr',
  openline='$current->OpenLine',
  ordnbr='$current->OrdNbr',
  ordqty='$current->OrdQty',
  ordtype='$current->OrdType',
  prcchngcode='$current->PrcChngCode',
  qtyship='$current->QtyShip',
  scrnnbr='$current->ScrnNbr',
  siteid='$current->SiteId',
  slsprice='$current->SlsPrice',
  status='$current->Status',
  stkbaseprc='$current->StkBasePrc',
  sub='$current->Sub',
  taxflag='$current->TaxFlag',
  unitdesc='$current->UnitDesc',
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
    from SODET
  where  salesOrderDetailId='$this->salesOrderDetailId'  
  and Bocntr='$this->Bocntr'
  and Custid='$this->Custid'
  and Invtid='$this->Invtid'
  and Lineid='$this->Lineid'
  and Linenbr='$this->Linenbr'
  and Lotsernbr='$this->Lotsernbr'
  and Openline='$this->Openline'
  and Ordnbr='$this->Ordnbr'
  and Ordtype='$this->Ordtype'
  and Siteid='$this->Siteid'
  and Status='$this->Status'
  and Whseloc='$this->Whseloc'
  ";
  }
} // class salesOrderDetail

