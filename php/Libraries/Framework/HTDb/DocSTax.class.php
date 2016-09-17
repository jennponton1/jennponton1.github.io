<?php
/**
 * DocSTax - class
 * This class provides access to the DOCSTAX table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class DocSTax extends SolModel
  {
  private $Refnbr;
  /**
   * $Refnbr - Primary index used to uniquely 
   *  identify a DocSTax object.
   */  

  /**
   * Keys - data members used to filter the object list
   */   
  private $Doctype;
  
  public function __construct($in_Refnbr = '')
  {
    $this->Refnbr = $in_Refnbr;
    parent::__construct($this); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setDoctype($inDoctype)
  {
    $this->Doctype=$inDoctype;
    return $this->Doctype;
  }
  public function getDoctype()
  {
    return $this->Doctype;
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

  /**
   * Associate DocSTax accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'custvendid'	=> 'CustVendId',	// Customer Vend ID (ZString-11)
   'doctot'	=> 'DocTot',	// Document Total (Float-8)
   'doctype'	=> 'DocType',	// Document Type (ZString-3)
   'refnbr'	=> 'RefNbr',	// Ref Number (ZString-7)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'taxadjflg'	=> 'TaxAdjFlg',	// Tax Adj Flg (Char-1)
   'taxcntr1'	=> 'TaxCntr1',	// Tax Counter 1 (Integer-2)
   'taxcntr2'	=> 'TaxCntr2',	// Tax Counter 2 (Integer-2)
   'taxcntr3'	=> 'TaxCntr3',	// Tax Counter 3 (Integer-2)
   'taxcntr4'	=> 'TaxCntr4',	// Tax Counter 4 (Integer-2)
   'taxid1'	=> 'TaxId1',	// Tax ID 1 (ZString-4)
   'taxid2'	=> 'TaxId2',	// Tax ID 2 (ZString-4)
   'taxid3'	=> 'TaxId3',	// Tax ID 3 (ZString-4)
   'taxid4'	=> 'TaxId4',	// Tax ID 4 (ZString-4)
   'taxtot1'	=> 'TaxTot1',	// Tax Total 1 (Float-8)
   'taxtot2'	=> 'TaxTot2',	// Tax Total 2 (Float-8)
   'taxtot3'	=> 'TaxTot3',	// Tax Total 3 (Float-8)
   'taxtot4'	=> 'TaxTot4',	// Tax Total 4 (Float-8)
   'taxtype'	=> 'TaxType',	// Tax Type (Char-1)
   'txbltot1'	=> 'TxblTot1',	// Txbl Total 1 (Float-8)
   'txbltot2'	=> 'TxblTot2',	// Txbl Total 2 (Float-8)
   'txbltot3'	=> 'TxblTot3',	// Txbl Total 3 (Float-8)
   'txbltot4'	=> 'TxblTot4',	// Txbl Total 4 (Float-8)
   'upduserid'	=> 'UpdUserId',	// Update User ID (ZString-4)

);
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
  $where = ($this->Refnbr == '') ? '' : " where refnbr='$this->Refnbr' and doctype='IN' ";
  $sql =  "select  
  chksum,
  custvendid,
  doctot,
  doctype,
  refnbr,
  scrnnbr,
  taxadjflg,
  taxcntr1,
  taxcntr2,
  taxcntr3,
  taxcntr4,
  taxid1,
  taxid2,
  taxid3,
  taxid4,
  taxtot1,
  taxtot2,
  taxtot3,
  taxtot4,
  taxtype,
  txbltot1, 
  txbltot2,
  txbltot3,
  txbltot4,
  upduserid
  from DOCSTAX
  $where";
  // Filter by keys or ranges here. Example:
  // where  DocSTaxId=$this->DocSTaxId  
  // and Doctype='$this->Doctype'
  // and Refnbr='$this->Refnbr'
  //die($sql);
  return $sql;
  }

  protected function getInsertSQL($current)
  {
    return 
    "insert into DOCSTAX( 
  chksum,
  custvendid,
  doctot,
  doctype,
  refnbr,
  scrnnbr,
  taxadjflg,
  taxcntr1,
  taxcntr2,
  taxcntr3,
  taxcntr4,
  taxid1,
  taxid2,
  taxid3,
  taxid4,
  taxtot1,
  taxtot2,
  taxtot3,
  taxtot4,
  taxtype,
  txbltot1,
  txbltot2,
  txbltot3,
  txbltot4,
  upduserid)
  values(
  '$current->Chksum',
  '$current->CustVendId',
  '$current->DocTot',
  '$current->DocType',
  '$current->RefNbr',
  '$current->ScrnNbr',
  '$current->TaxAdjFlg',
  '$current->TaxCntr1',
  '$current->TaxCntr2',
  '$current->TaxCntr3',
  '$current->TaxCntr4',
  '$current->TaxId1',
  '$current->TaxId2',
  '$current->TaxId3',
  '$current->TaxId4',
  '$current->TaxTot1',
  '$current->TaxTot2',
  '$current->TaxTot3',
  '$current->TaxTot4',
  '$current->TaxType',
  '$current->TxblTot1',
  '$current->TxblTot2',
  '$current->TxblTot3',
  '$current->TxblTot4',
  '$current->UpdUserId')";
  
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update DOCSTAX set
  chksum='$current->Chksum',
  custvendid='$current->CustVendId',
  doctot='$current->DocTot',
  doctype='$current->DocType',
  refnbr='$current->RefNbr',
  scrnnbr='$current->ScrnNbr',
  taxadjflg='$current->TaxAdjFlg',
  taxcntr1='$current->TaxCntr1',
  taxcntr2='$current->TaxCntr2',
  taxcntr3='$current->TaxCntr3',
  taxcntr4='$current->TaxCntr4',
  taxid1='$current->TaxId1',
  taxid2='$current->TaxId2',
  taxid3='$current->TaxId3',
  taxid4='$current->TaxId4',
  taxtot1='$current->TaxTot1',
  taxtot2='$current->TaxTot2',
  taxtot3='$current->TaxTot3',
  taxtot4='$current->TaxTot4',
  taxtype='$current->TaxType',
  txbltot1='$current->TxblTot1',
  txbltot2='$current->TxblTot2',
  txbltot3='$current->TxblTot3',
  txbltot4='$current->TxblTot4',
  upduserid='$current->UpdUserId'";
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from DOCSTAX
  where  DocSTaxId='$this->DocSTaxId'  
  and Doctype='$this->Doctype'
  and Refnbr='$this->Refnbr'
  ";
  }
} // class DocSTax

?>
