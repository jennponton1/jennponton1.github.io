<?php
/*
This script was generated on 2006-09-25 at 11:01:07
The generating script used was /test/blester/frameworkmodelgen.php
It was run on server devnew.htwp.com
The template file name was FrameWorkModelGen.tpl
The Smarty version was 2.6.14
dbTable   HTTREAT
className Treatment
*/
/**
 *  - class
 * This class provides access to the HTTREAT table
 * @package HTFramework
 * @subpackage HTDb
 */  

  class Treatment extends SolModel
  {
  /**
   * TreatmentId - Primary index used to uniquely 
   *  identify a Treatment object.
   */  
  private $TreatmentId;
  /**
   * Keys - data members used to filter the object list
   */   
  private $BatNbr;
  private $Chgid;
  private $Custid;
  private $Cylnbr;
  private $Invtid;
  private $KilnID;
  private $Ordnbr;
  private $Retention;
  private $Siteid;
  private $Trtmt;
  private $TrtType;
  private $Whseloc;
  /**
   * Ranges - data members used to filter the object list
   */   
  private $beginBTrtDt;
  private $endBTrtDt;
  private $beginChgdt;
  private $endChgdt;
  private $beginDueDt;
  private $endDueDt;
  private $beginETrtDt;
  private $endETrtDt;
  private $beginPerEnt;
  private $endPerEnt;
  private $beginPerpost;
  private $endPerpost;
  
  public function __construct($in_TreatmentId = '')
  {
    $this->TreatmentId = $in_TreatmentId;
    parent::__construct(); // must call parent constructor 
  }

  /**
   * Keys - get and set methods
   */   
  public function setBatNbr($inBatNbr)
  {
    $this->BatNbr=$inBatNbr;
    return $this->BatNbr;
  }
  public function getBatNbr()
  {
    return $this->BatNbr;
  }

  public function setChgid($inChgid)
  {
    $this->Chgid=$inChgid;
    return $this->Chgid;
  }
  public function getChgid()
  {
    return $this->Chgid;
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

  public function setCylnbr($inCylnbr)
  {
    $this->Cylnbr=$inCylnbr;
    return $this->Cylnbr;
  }
  public function getCylnbr()
  {
    return $this->Cylnbr;
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

  public function setKilnID($inKilnID)
  {
    $this->KilnID=$inKilnID;
    return $this->KilnID;
  }
  public function getKilnID()
  {
    return $this->KilnID;
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

  public function setRetention($inRetention)
  {
    $this->Retention=$inRetention;
    return $this->Retention;
  }
  public function getRetention()
  {
    return $this->Retention;
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

  public function setTrtmt($inTrtmt)
  {
    $this->Trtmt=$inTrtmt;
    return $this->Trtmt;
  }
  public function getTrtmt()
  {
    return $this->Trtmt;
  }

  public function setTrtType($inTrtType)
  {
    $this->TrtType=$inTrtType;
    return $this->TrtType;
  }
  public function getTrtType()
  {
    return $this->TrtType;
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
   * Ranges - get set methods
   */   
  public function setBTrtDtRange($inBeginBTrtDt, $inEndBTrtDt)
  {
    $this->beginBTrtDt = $inBeginBTrtDt;
    $this->endBTrtDt = $inEndBTrtDt;
  }
  public function getBeginBTrtDtRange()
  {
    return $this->beginBTrtDt;
  }
  public function getEndBTrtDtRange()
  {
    return $this->endBTrtDt;
  }

  public function setChgdtRange($inBeginChgdt, $inEndChgdt)
  {
    $this->beginChgdt = $inBeginChgdt;
    $this->endChgdt = $inEndChgdt;
  }
  public function getBeginChgdtRange()
  {
    return $this->beginChgdt;
  }
  public function getEndChgdtRange()
  {
    return $this->endChgdt;
  }

  public function setDueDtRange($inBeginDueDt, $inEndDueDt)
  {
    $this->beginDueDt = $inBeginDueDt;
    $this->endDueDt = $inEndDueDt;
  }
  public function getBeginDueDtRange()
  {
    return $this->beginDueDt;
  }
  public function getEndDueDtRange()
  {
    return $this->endDueDt;
  }

  public function setETrtDtRange($inBeginETrtDt, $inEndETrtDt)
  {
    $this->beginETrtDt = $inBeginETrtDt;
    $this->endETrtDt = $inEndETrtDt;
  }
  public function getBeginETrtDtRange()
  {
    return $this->beginETrtDt;
  }
  public function getEndETrtDtRange()
  {
    return $this->endETrtDt;
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

  /**
   * Associate Treatment accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */

   'chgdt'	=> 'Chgdt',	// chgdt (Date-4)
   'retentrnd'	=> 'RetentRnd',	// Retention (Float-8)
   'siteid'	=> 'Siteid',	// Site ID (ZString-11)
   'trtmt'	=> 'Trtmt',	// Treatment (ZString-6)
   'lbsusedrnd' => 'LbsUsed'
  );
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    return "select  
  chgdt, 
  round(retention,2) as retentrnd,
  siteid,
  trtmt,
  round(sum(lbsused), 2) as lbsusedrnd
  from HTTREAT
  where
  chgdt>='$this->beginChgdt'
  and chgdt<='$this->endChgdt'
  group by siteid, trtmt, retentrnd, chgdt
  ";
  // Filter by keys or ranges here. Example:
  // where  TreatmentId='$this->TreatmentId'  
  // and BatNbr='$this->BatNbr'
  // and Chgid='$this->Chgid'
  // and Custid='$this->Custid'
  // and Cylnbr='$this->Cylnbr'
  // and Invtid='$this->Invtid'
  // and KilnID='$this->KilnID'
  // and Ordnbr='$this->Ordnbr'
  // and Retention='$this->Retention'
  // and Siteid='$this->Siteid'
  // and Trtmt='$this->Trtmt'
  // and TrtType='$this->TrtType'
  // and Whseloc='$this->Whseloc'
  // and BTrtDt>='$this->beginBTrtDt'
  // and BTrtDt<='$this->endBTrtDt'
  // and Chgdt>='$this->beginChgdt'
  // and Chgdt<='$this->endChgdt'
  // and DueDt>='$this->beginDueDt'
  // and DueDt<='$this->endDueDt'
  // and ETrtDt>='$this->beginETrtDt'
  // and ETrtDt<='$this->endETrtDt'
  // and PerEnt>='$this->beginPerEnt'
  // and PerEnt<='$this->endPerEnt'
  // and Perpost>='$this->beginPerpost'
  // and Perpost<='$this->endPerpost'
  }

  protected function getInsertSQL($current)
  {
    $name = get_class($this);
    throw new Exception("$name is a read only class.");
  }
  
  protected function getUpdateSQL($current)
  {
    $name = get_class($this);
    throw new Exception("$name is a read only class.");
  }
  
  protected function getDeleteSQL($current)
  {
    $name = get_class($this);
    throw new Exception("$name is a read only class.");
  }
} // class Treatment

