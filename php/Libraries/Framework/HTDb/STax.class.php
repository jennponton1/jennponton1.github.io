<?php
/**
 * STax - class
 * This class provides access to the STAX table which contains 
 * state tax information. 
 * @package HTFramework
 * @subpackage HTDb
 */  
  class STax extends SolModel
  {
  /**
   * STaxId - Primary index used to uniquely 
   *  identify a STax object.
   */  
  private $TaxId;
  /**
   * Keys - data members used to filter the object list
   */   
  private $Ids;
  private $LongId;
  private $Taxrcvdacct;
  private $Taxrcvdsub;
  
  public function __construct($in_TaxId = '')
  {
    $this->TaxId = $in_TaxId;
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setLongId($inLongId)
  {
    $this->LongId = $inLongId;
    return $this->LongId;
  }
  public function getLongId()
  {
    return $this->LongId;
  }

  public function setTaxId($inTaxId)
  {
    $this->TaxId=$inTaxId;
    return $this->TaxId;
  }
  public function getTaxId()
  {
    return $this->TaxId;
  }

  public function setTaxrcvdacct($inTaxrcvdacct)
  {
    $this->Taxrcvdacct=$inTaxrcvdacct;
    return $this->Taxrcvdacct;
  }
  public function getTaxrcvdacct()
  {
    return $this->Taxrcvdacct;
  }

  public function setTaxrcvdsub($inTaxrcvdsub)
  {
    $this->Taxrcvdsub=$inTaxrcvdsub;
    return $this->Taxrcvdsub;
  }
  public function getTaxrcvdsub()
  {
    return $this->Taxrcvdsub;
  }

  /**
   * Associate STax accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'catexcept2'	=> 'CatExcept2',	// Cat Except 2 (ZString-4)
   'catexcept3'	=> 'CatExcept3',	// Cat Except 3 (ZString-4)
   'catexcept4'	=> 'CatExcept4',	// Cat Except 4 (ZString-4)
   'catexcept5'	=> 'CatExcept5',	// Cat Except 5 (ZString-4)
   'catexcept6'	=> 'CatExcept6',	// Cat Except 6 (ZString-4)
   'catflag'	=> 'CatFlag',	// Cat Flag (Char-1)
   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'descr'	=> 'Descr',	// Descr (ZString-31)
   'inclfrtmisc'	=> 'InclFrtMisc',	// Incl Frt Misc (Char-1)
   'longid'	=> 'LongId',	// Long ID (ZString-16)
   'lvl2exempt'	=> 'Lvl2Exempt',	// Level 2 Exempt (Char-1)
   'newratedate'	=> 'NewRateDate',	// New Rate Date (Date-4)
   'newtaxrate'	=> 'NewTaxRate',	// New Tax Rate (Float-8)
   'oldtaxrate'	=> 'OldTaxRate',	// Old Tax Rate (Float-8)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'slstaxacct'	=> 'SlsTaxAcct',	// Sales Tax Account (ZString-7)
   'slstaxclass'	=> 'SlsTaxClass',	// Sales Tax Class (Char-1)
   'slstaxsub'	=> 'SlsTaxSub',	// Sales Tax Subaccount (ZString-25)
   'taxbasis'	=> 'TaxBasis',	// Tax Basis (Char-1)
   'taxcalclvl'	=> 'TaxCalcLvl',	// Tax Calc Level (Char-1)
   'taxid'	=> 'TaxId',	// Tax ID (ZString-4)
   'taxrate'	=> 'TaxRate',	// Tax Rate (Float-8)
   'taxrcvdacct'	=> 'TaxRcvdAcct',	// Tax Rcvd Account (ZString-7)
   'taxrcvdsub'	=> 'TaxRcvdSub',	// Tax Rcvd Subaccount (ZString-25)
   'taxround'	=> 'TaxRound',	// Tax Round (Char-1)
   'upduserid'	=> 'UpdUserId',	// Update User ID (ZString-4)

);
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    if(is_array($this->TaxId) && (count($this->TaxId)>0) && (reset($this->TaxId)<>''))
    {
      $id = current($this->TaxId);
      $where = " where taxid='$id'" ;
      while($id = next($this->TaxId))
        $where .= " or taxid='$id' ";
    }
    else
      $where = (isset($this->TaxId) && ($this->TaxId<>'')) ? " where taxid='$this->TaxId' " : '';
    $sql =  "select  
  catexcept2,
  catexcept3,
  catexcept4,
  catexcept5,
  catexcept6,
  catflag,
  chksum,
  descr,
  inclfrtmisc,
  longid,
  lvl2exempt,
  newratedate,
  newtaxrate,
  oldtaxrate,
  scrnnbr,
  slstaxacct,
  slstaxclass,
  slstaxsub,
  taxbasis,
  taxcalclvl,
  taxid,
  taxrate,
  taxrcvdacct,
  taxrcvdsub,
  taxround,
  upduserid
  from STAX
  $where ";
  return $sql;
  // Filter by keys or ranges here. Example:
  // where  STaxId=$this->STaxId  
  // and Longid='$this->Longid'
  // and Taxid='$this->Taxid'
  // and Taxrcvdacct='$this->Taxrcvdacct'
  // and Taxrcvdsub='$this->Taxrcvdsub'
  }

  protected function getInsertSQL($current)
  {
    return 
    "insert into STAX( 
  catexcept2,
  catexcept3,
  catexcept4,
  catexcept5,
  catexcept6,
  catflag,
  chksum,
  descr,
  inclfrtmisc,
  longid,
  lvl2exempt,
  newratedate,
  newtaxrate,
  oldtaxrate,
  scrnnbr,
  slstaxacct,
  slstaxclass,
  slstaxsub,
  taxbasis,
  taxcalclvl,
  taxid,
  taxrate,
  taxrcvdacct,
  taxrcvdsub,
  taxround,
  upduserid)
  values(
  '$current->CatExcept2',
  '$current->CatExcept3',
  '$current->CatExcept4',
  '$current->CatExcept5',
  '$current->CatExcept6',
  '$current->CatFlag',
  '$current->Chksum',
  '$current->Descr',
  '$current->InclFrtMisc',
  '$current->LongId',
  '$current->Lvl2Exempt',
  '$current->NewRateDate',
  '$current->NewTaxRate',
  '$current->OldTaxRate',
  '$current->ScrnNbr',
  '$current->SlsTaxAcct',
  '$current->SlsTaxClass',
  '$current->SlsTaxSub',
  '$current->TaxBasis',
  '$current->TaxCalcLvl',
  '$current->TaxId',
  '$current->TaxRate',
  '$current->TaxRcvdAcct',
  '$current->TaxRcvdSub',
  '$current->TaxRound',
  '$current->UpdUserId')";
  
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update STAX set
  catexcept2='$current->CatExcept2',
  catexcept3='$current->CatExcept3',
  catexcept4='$current->CatExcept4',
  catexcept5='$current->CatExcept5',
  catexcept6='$current->CatExcept6',
  catflag='$current->CatFlag',
  chksum='$current->Chksum',
  descr='$current->Descr',
  inclfrtmisc='$current->InclFrtMisc',
  longid='$current->LongId',
  lvl2exempt='$current->Lvl2Exempt',
  newratedate='$current->NewRateDate',
  newtaxrate='$current->NewTaxRate',
  oldtaxrate='$current->OldTaxRate',
  scrnnbr='$current->ScrnNbr',
  slstaxacct='$current->SlsTaxAcct',
  slstaxclass='$current->SlsTaxClass',
  slstaxsub='$current->SlsTaxSub',
  taxbasis='$current->TaxBasis',
  taxcalclvl='$current->TaxCalcLvl',
  taxid='$current->TaxId',
  taxrate='$current->TaxRate',
  taxrcvdacct='$current->TaxRcvdAcct',
  taxrcvdsub='$current->TaxRcvdSub',
  taxround='$current->TaxRound',
  upduserid='$current->UpdUserId'";
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from STAX
  where  STaxId='$this->STaxId'  
  and Longid='$this->Longid'
  and Taxid='$this->Taxid'
  and Taxrcvdacct='$this->Taxrcvdacct'
  and Taxrcvdsub='$this->Taxrcvdsub'
  ";
  }
} // class STax


?>
