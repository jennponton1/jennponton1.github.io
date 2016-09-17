<?php
/**
 * AcctPeriods - class
 * Provides access to Accounting Periods 
 * @package HTFramework
 * @subpackage HTDb
 */  
class AcctPeriods extends DwhModel
{
  // public attributes
  public $periodId;
  public $cntDate;
  
  /**
   *  __construct($inPerId = '')
   * Construct an AcctPeriods with a period id. If you only want the period
   * that contains a specific date, use setContainedDate after construction.
   */        
  public function __construct($inPerId = '')
  {
    $this->periodId = $inPerId;
    DwhModel::__construct(); // must call parent constructor 
  }
  /**
   * setContainedDate($inDate)
   * NOTE: Resets periodId to empty. When contained date is set, only the period
   * containing the date is retrieved on open() - or the current open period.
   */             
  public function setContainedDate($inCntDate)
  {
    $this->cntDate = $inCntDate;
    $this->periodId = '';
  }
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'PerID'     =>  'MyId',
    'FiscYear'  =>  'FiscYear',
    'PerEnd'    =>  'PerEnd',
    'PerNbr' =>  'PerNbr',
    'PerClose'  => 'PerClose',
    'EnteredBy' => 'EnteredBy',
    'EnteredDate' =>  'EnteredDate',
    'IsOpen'  => 'IsOpen'
    );
  protected function getOpenSQL()
  {
    if($this->cntDate == '')
    {    
      $idFilter = ($this->periodId == '') ? '' : "where MyId = '$this->periodId'";
      return "select  PerId, FiscYear, PerEnd, PerNbr, PerClose, IsOpen, EnteredBy, 
                      EnteredDate
              from AcctPeriods  
              $idFilter
              order by PerNbr";
    }
    else
    { // If there is no period ended after given date return the current open period
      return "select * from acctperiods where PerId =
              (SELECT IFNULL(
                (SELECT PerId from acctperiods where PerEnd >= '$this->cntDate' 
                                                    order by PerEnd limit 1),
                (SELECT PerId from acctperiods where IsOpen=true)))";
    }
  }
  protected function getInsertSQL($current)
  {
    // Note <...>Id is an autoincrement key 
    return 
    "insert into AcctPeriods 
    (FiscYear, PerEnd, PerNbr, PerClose, EnteredBy, EnteredDate) 
    values
    ('$current->FiscYear',
    '$current->PerEnd',
    '$current->PerNbr',
    '$current->PerClose',
    '$current->EnteredBy',
    '$current->EnteredDate')";
  }
  protected function getUpdateSQL($current)
  {
    // Note that generally, changing SiteId is not done
    return 
    "update AcctPeriods set
    FiscYear='$current->FiscYear',
    PerEnd='$current->PerEnd',
    PerNbr='$current->PerNbr',
    PerClose='$current->PerClose',
    EnteredBy='$current->EnteredBy',
    EnteredDate='$current->EnteredDate',
    IsOpen='$current->IsOpen'
    where PerID='$current->PerId'";
  }
  protected function getDeleteSQL($current)
  {
    return
    "delete from AcctPeriods
    where PerID='$current->PerId'";
  }
}

?>
