<?php
/**
 * negunrecstat - class
 * Provides access to Statdet table to view negative value unreceived materail
 * @package HTFramework
 * @subpackage HTDb
 */  
 
class negunrecstat extends DwhModel{

  /**
  * $siteID contains the siteid to search agentst
  * $bffilter contains a number relating to the borad foot to search agenst.
  */
  public $siteId;
  public $bffilter;
  
  public function __construct($siteId, $bffilter){
    $this->siteId = $siteId;
    $this->bffilter = $bffilter;
    parent::__construct(); // must call parent constructor 
  }

  /**
   *  Accessors used in the SQL statements.
  */
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'ordnbr'  =>  'ordnbr',
    'siteid'  =>  'siteid',
    'invtid'  =>  'invtid',
    'status'  =>  'status',
    'pcs'     =>  'pcs',
    'bf'      =>  'bf'
  );

/**
  * runs the SQL statement.. Will contain more statements in the future.
  */
  protected function getOpenSQL(){
    if ($this->siteId != 'ALL')
      $where_site = "siteid = '$this->siteId' and";
    else
      $where_site = '';

    $sql =  "Select * from statdet
            Where  $where_site bf < $this->bffilter
              and (status = '--' or status = 'NM')
            Order by siteid, ordnbr, invtid";
    return $sql;
  }

  /**
  *  Not used at this time!!!!
  */
  protected function getInsertSQL($current){
    return "insert into MeterReadings
              (MeterId, SiteId, ReadingId, FaceReading, ReadingComment, EnteredBy,
            EnteredDate, ReadingDate, ReadingAcctPeriod)
            values(
              '$current->MeterId',
              '$current->SiteId',
              '$current->ReadingId',
              '$current->FaceReading',
              '$current->Comment',
              '$current->EnteredBy',
              '$current->EnteredDate',
              '$current->ReadingDate',
              '$current->AcctPer'
            )";
  }
  
  /**
  *  Not used at this time!!!!
  */
  protected function getUpdateSQL($current){
    return 
    "update MeterReadings set
    FaceReading ='$current->FaceReading',
    ReadingComment='$current->Comment',
    MeterId='$current->MeterId',
    EnteredBy='$current->EnteredBy',
    EnteredDate='$current->EnteredDate',
    ReadingDate='$current->ReadingDate',
    ReadingAcctPer='$current->AcctPer',
    SiteId='$current->SiteId'
    where ReadingId='$current->ReadingId'";
  }

  /**
  *  Not used at this time!!!!
  **/
  protected function getDeleteSQL($current){
    return
    "delete from MeterReadings
    where ReadingId='$current->ReadingId'";
  }
}
?>
