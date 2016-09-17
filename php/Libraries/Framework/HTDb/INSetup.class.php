<?php
/*
This script was generated on 2006-12-05 at 13:36:57
The generating script used was /test/blester/FrameWorkModelGen.php
It was run on server devnew.htwp.com
The template file name was FrameWorkModelGen.tpl
The Smarty version was 2.6.14
dbTable   INSETUP
className INSetup
*/
/**
 *  - class
 * This class provides access to the INSETUP table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class INSetup extends SolModel
  {
  /**
   * INSetupId - Primary index used to uniquely 
   *  identify a INSetup object.
   */  
  private $INSetupId;
  /**
   * Keys - data members used to filter the object list
   */   
  private $Dfltcogsacct;
  private $Dfltcogssub;
  private $Dfltinvtacct;
  private $Dfltinvtsub;
  private $Dfltsite;
  private $Dfltvaracct;
  private $Dfltvarsub;
  private $Invtcogssub;
  private $Lastbatnbr;
  private $Pernbr;
  private $Setupid;
  
  public function __construct($in_INSetupId = '')
  {
    $this->INSetupId = $in_INSetupId;
    parent::__construct(); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setDfltcogsacct($inDfltcogsacct)
  {
    $this->Dfltcogsacct=$inDfltcogsacct;
    return $this->Dfltcogsacct;
  }
  public function getDfltcogsacct()
  {
    return $this->Dfltcogsacct;
  }

  public function setDfltcogssub($inDfltcogssub)
  {
    $this->Dfltcogssub=$inDfltcogssub;
    return $this->Dfltcogssub;
  }
  public function getDfltcogssub()
  {
    return $this->Dfltcogssub;
  }

  public function setDfltinvtacct($inDfltinvtacct)
  {
    $this->Dfltinvtacct=$inDfltinvtacct;
    return $this->Dfltinvtacct;
  }
  public function getDfltinvtacct()
  {
    return $this->Dfltinvtacct;
  }

  public function setDfltinvtsub($inDfltinvtsub)
  {
    $this->Dfltinvtsub=$inDfltinvtsub;
    return $this->Dfltinvtsub;
  }
  public function getDfltinvtsub()
  {
    return $this->Dfltinvtsub;
  }

  public function setDfltsite($inDfltsite)
  {
    $this->Dfltsite=$inDfltsite;
    return $this->Dfltsite;
  }
  public function getDfltsite()
  {
    return $this->Dfltsite;
  }

  public function setDfltvaracct($inDfltvaracct)
  {
    $this->Dfltvaracct=$inDfltvaracct;
    return $this->Dfltvaracct;
  }
  public function getDfltvaracct()
  {
    return $this->Dfltvaracct;
  }

  public function setDfltvarsub($inDfltvarsub)
  {
    $this->Dfltvarsub=$inDfltvarsub;
    return $this->Dfltvarsub;
  }
  public function getDfltvarsub()
  {
    return $this->Dfltvarsub;
  }

  public function setInvtcogssub($inInvtcogssub)
  {
    $this->Invtcogssub=$inInvtcogssub;
    return $this->Invtcogssub;
  }
  public function getInvtcogssub()
  {
    return $this->Invtcogssub;
  }

  public function setLastbatnbr($inLastbatnbr)
  {
    $this->Lastbatnbr=$inLastbatnbr;
    return $this->Lastbatnbr;
  }
  public function getLastbatnbr()
  {
    return $this->Lastbatnbr;
  }

  public function setPernbr($inPernbr)
  {
    $this->Pernbr=$inPernbr;
    return $this->Pernbr;
  }
  public function getPernbr()
  {
    return $this->Pernbr;
  }

  public function setSetupid($inSetupid)
  {
    $this->Setupid=$inSetupid;
    return $this->Setupid;
  }
  public function getSetupid()
  {
    return $this->Setupid;
  }

  /**
   * Associate INSetup accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'binary'	=> 'Binary',	// Binary (Char-100)
   'chksum'	=> 'Chksum',	// Checksum (Integer-2)
   'cmprsls'	=> 'CmprSls',	// Comparative Sales (Char-1)
   'dfltcogsacct'	=> 'DfltCOGSAcct',	// Dflt Cost Of Goods Sold Account (ZString-7)
   'dfltcogssub'	=> 'DfltCOGSSub',	// Dflt Cost Of Goods Sold Subaccount (ZString-25)
   'dfltinvtacct'	=> 'DfltInvtAcct',	// Dflt Inventory Account (ZString-7)
   'dfltinvtsub'	=> 'DfltInvtSub',	// Dflt Inventory Subaccount (ZString-25)
   'dfltprodclass'	=> 'DfltProdClass',	// Dflt Prod Class (ZString-7)
   'dfltsite'	=> 'DfltSite',	// Dflt Site (ZString-7)
   'dfltvalmthd'	=> 'DfltValMthd',	// Dflt Val Mthd (Char-1)
   'dfltvaracct'	=> 'DfltVarAcct',	// Dflt Var Account (ZString-7)
   'dfltvarsub'	=> 'DfltVarSub',	// Dflt Var Subaccount (ZString-25)
   'init'	=> 'Init',	// Init (Char-1)
   'invtcogssub'	=> 'InvtCOGSSub',	// Inventory Cost Of Goods Sold Subaccount (Char-1)
   'lastbatnbr'	=> 'LastBatNbr',	// Last Bat Number (ZString-7)
   'multwhse'	=> 'MultWhse',	// Mult Whse (Char-1)
   'negqty'	=> 'NegQty',	// Neg Quantity (Char-1)
   'nonkitasm'	=> 'NonKitAsm',	// Non Kit Asm (Char-1)
   'pernbr'	=> 'PerNbr',	// Period Number (ZString-7)
   'scrnnbr'	=> 'ScrnNbr',	// Screen Number (ZString-5)
   'setupid'	=> 'SetupId',	// Setup ID (ZString-3)
   'summpost'	=> 'SummPost',	// Summ Post (Char-1)
   'upduserid'	=> 'UpdUserId',	// Update User ID (ZString-4)

);
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    return "select  
  binary,
  chksum,
  cmprsls,
  dfltcogsacct,
  dfltcogssub,
  dfltinvtacct,
  dfltinvtsub,
  dfltprodclass,
  dfltsite,
  dfltvalmthd,
  dfltvaracct,
  dfltvarsub,
  init,
  invtcogssub,
  lastbatnbr,
  multwhse,
  negqty,
  nonkitasm,
  pernbr,
  scrnnbr,
  setupid,
  summpost,
  upduserid
  from INSETUP";
  // Filter by keys or ranges here. Example:
  // where  INSetupId=$this->INSetupId  
  // and Dfltcogsacct='$this->Dfltcogsacct'
  // and Dfltcogssub='$this->Dfltcogssub'
  // and Dfltinvtacct='$this->Dfltinvtacct'
  // and Dfltinvtsub='$this->Dfltinvtsub'
  // and Dfltsite='$this->Dfltsite'
  // and Dfltvaracct='$this->Dfltvaracct'
  // and Dfltvarsub='$this->Dfltvarsub'
  // and Invtcogssub='$this->Invtcogssub'
  // and Lastbatnbr='$this->Lastbatnbr'
  // and Pernbr='$this->Pernbr'
  // and Setupid='$this->Setupid'
  }

  protected function getInsertSQL($current)
  {
    return 
    "insert into INSETUP( 
  binary,
  chksum,
  cmprsls,
  dfltcogsacct,
  dfltcogssub,
  dfltinvtacct,
  dfltinvtsub,
  dfltprodclass,
  dfltsite,
  dfltvalmthd,
  dfltvaracct,
  dfltvarsub,
  init,
  invtcogssub,
  lastbatnbr,
  multwhse,
  negqty,
  nonkitasm,
  pernbr,
  scrnnbr,
  setupid,
  summpost,
  upduserid)
  values(
  '$current->Binary',
  '$current->Chksum',
  '$current->CmprSls',
  '$current->DfltCOGSAcct',
  '$current->DfltCOGSSub',
  '$current->DfltInvtAcct',
  '$current->DfltInvtSub',
  '$current->DfltProdClass',
  '$current->DfltSite',
  '$current->DfltValMthd',
  '$current->DfltVarAcct',
  '$current->DfltVarSub',
  '$current->Init',
  '$current->InvtCOGSSub',
  '$current->LastBatNbr',
  '$current->MultWhse',
  '$current->NegQty',
  '$current->NonKitAsm',
  '$current->PerNbr',
  '$current->ScrnNbr',
  '$current->SetupId',
  '$current->SummPost',
  '$current->UpdUserId')";
  
  }
  
  protected function getUpdateSQL($current)
  {
    return 
    "update INSETUP set
  binary='$current->Binary',
  chksum='$current->Chksum',
  cmprsls='$current->CmprSls',
  dfltcogsacct='$current->DfltCOGSAcct',
  dfltcogssub='$current->DfltCOGSSub',
  dfltinvtacct='$current->DfltInvtAcct',
  dfltinvtsub='$current->DfltInvtSub',
  dfltprodclass='$current->DfltProdClass',
  dfltsite='$current->DfltSite',
  dfltvalmthd='$current->DfltValMthd',
  dfltvaracct='$current->DfltVarAcct',
  dfltvarsub='$current->DfltVarSub',
  init='$current->Init',
  invtcogssub='$current->InvtCOGSSub',
  lastbatnbr='$current->LastBatNbr',
  multwhse='$current->MultWhse',
  negqty='$current->NegQty',
  nonkitasm='$current->NonKitAsm',
  pernbr='$current->PerNbr',
  scrnnbr='$current->ScrnNbr',
  setupid='$current->SetupId',
  summpost='$current->SummPost',
  upduserid='$current->UpdUserId'";
  }
  
  protected function getDeleteSQL($current)
  {
  // Caution: The filter clause here must uniquely identify one row
  // to avoid accidental deletions.
    return
    "delete 
    from INSETUP
  where  INSetupId='$this->INSetupId'  
  and Dfltcogsacct='$this->Dfltcogsacct'
  and Dfltcogssub='$this->Dfltcogssub'
  and Dfltinvtacct='$this->Dfltinvtacct'
  and Dfltinvtsub='$this->Dfltinvtsub'
  and Dfltsite='$this->Dfltsite'
  and Dfltvaracct='$this->Dfltvaracct'
  and Dfltvarsub='$this->Dfltvarsub'
  and Invtcogssub='$this->Invtcogssub'
  and Lastbatnbr='$this->Lastbatnbr'
  and Pernbr='$this->Pernbr'
  and Setupid='$this->Setupid'
  ";
  }
} // class INSetup


?>
