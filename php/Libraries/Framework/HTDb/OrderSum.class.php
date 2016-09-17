<?php
 /**
  * OrderSum - Provides access to the orddet table.
  *
  * This class extends the  DwhModel class which is part
  * of the HTFramework class libarary.
  */
  class OrderSum extends DwhModel
  {
  /**
   * Ranges - filters that define a begin/end value pair.
   * 
   * These are typically used for open() only. 
   */   
  private $beginWeekEnded;
  private $endWeekEnded;
  private $beginOrdDate;
  private $endOrdDate;
 /**
  * __construct - Constructs OrderSum objects,
  * optionally specifying an order date range filter.
  */
  public function __construct($in_BeginOrdDate = '', $in_EndOrdDate = '')
  {
    $this->beginOrdDate = $in_BeginOrdDate;
    $this->endOrdDate = $in_EndOrdDate;
    parent::__construct($this); // must call parent constructor 
  }
  /**
   * Ranges - get and set methods
   */   
  public function setWeekEndedRange($in_BeginWeekEnded, $in_EndWeekEnded)
  {
    $this->beginWeekEnded = $in_BeginWeekEnded;
    $this->endWeekEnded = $in_EndWeekEnded;
  }
  public function getBeginWeekEndedRange()
  {
    return $this->beginWeekEnded;
  }
  public function getEndWeekEndedRange()
  {
    return $this->endWeekEnded;
  }
  public function setOrdDateRange($in_BeginOrdDate, $in_EndOrdDate)
  {
    $this->beginOrdDate = $in_BeginOrdDate;
    $this->endOrdDate = $in_EndOrdDate;
  }
  public function getBeginOrdDateRange()
  {
    return $this->beginOrdDate;
  }
  public function getEndOrdDateRange()
  {
    return $this->endOrdDate;
  }

  /**
   * Associate OrderSum accessor methods with database column names
   */   
  protected $accessorNames = array(
  // OrdHdr - Order Header table 
  /* column name  =>  accessor name */
  'ORDDATE' => 'OrdDate',
  // OrdDet - Order Detail table 
  /* column name  =>  accessor name */
  'ORDTYPE' => 'OrdType',		
  'BOCNTR' => 'BackOrderCount',		
  'INVTID' => 'InventoryID',		
  'ORDQTY' => 'OrdQty',		
  'PCSORD' => 'Pieces',		
  'SITEID' => 'SiteID',		
  'BFOPEN' => 'BFOpen',		
  'PRODCAT' => 'ProdCat',		
  'BILLUNITS' => 'BillingUnits',		
  'CNVFACT' => 'ConvFactor',		
  'weekended' => 'WeekEnded',
  'CustType' => 'CustType'		
  );
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    $where = '';
    
    if(($this->beginWeekEnded != '') && ($this->endWeekEnded != '')) {
      if((($this->beginWeekEnded = Date('Ymd', strtotime($this->beginWeekEnded)))===false)
          || (($this->endWeekEnded = Date('Ymd', strtotime($this->endWeekEnded)))===false))
          throw new HTException("OrderSum given invalid WeekEnded range:
                        $this->beginWeekEnded:$this->endWeekEnded");
      $where = "weekended between '$this->beginWeekEnded' and '$this->endWeekEnded'";
    }
    if(($this->beginOrdDate != '') && ($this->endOrdDate != '')) {
      if((($this->beginOrdDate = Date('Ymd', strtotime($this->beginOrdDate)))===false)
          || (($this->endOrdDate = Date('Ymd', strtotime($this->endOrdDate)))===false))
          throw new HTException("OrderSum given invalid OrdDate range:
                        $this->beginOrdDate:$this->endOrdDate");
      $where = "ORDDATE between '$this->beginOrdDate' and '$this->endOrdDate'";
    }
    if($where != '')
      $where = ' where ' . $where;
    $orderBy = $this->getOrderByList();
    $sql = "select 
    DATE_FORMAT(h.ORDDATE, '%m/%d/%Y') as ORDDATE,  
    d.ORDTYPE,  
    d.BOCNTR,  
    d.INVTID,  
    d.ORDQTY,  
    d.PCSORD,  
    d.SITEID,  
    d.BFOPEN,  
    d.PRODCAT,  
    d.BILLUNITS,  
    d.CNVFACT,  
    DATE_FORMAT(d.weekended, '%m/%d/%Y')as weekended,
  if(c.user3 between 2 and 9,'EXP','DOM') as CustType
From ordhdr h, orddet d, cust c
 $where and
 h.ordnbr=d.ordnbr and
 h.ordtype=d.ordtype and
 h.bocntr=d.bocntr and
 h.custid=c.custid
 $orderBy";
    return $sql;
  }
}  // end OrderSum class definition
?> 