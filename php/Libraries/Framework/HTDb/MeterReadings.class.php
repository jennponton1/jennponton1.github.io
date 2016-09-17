<?php
/**
 * MeterReadings - class
 * Provides access to kiln fuel meter readings by the date the meter was read
 * @package HTFramework
 * @subpackage HTDb
 */  
class MeterReadings extends DwhModel
{
  public $BegRDate;
  public $EndRDate;
  public $BeginPer;
  public $EndPer;

  public $siteId;
  
  public function __construct($inSite = '', $inBeg='', $inEnd='')
  {
    $this->setDtRange($inBeg, $inEnd);
    $this->siteId = $inSite;
    parent::__construct(); // must call parent constructor 
  }
  public function setDtRange($inBeg='', $inEnd='')
  {
    if($inBeg=='' || $inEnd=='')
    {
      $this->BegRDate = date('Y-m-d');
      $this->EndRDate = date('Y-m-d');
    }
    else
    { 
      $mdy = explode('/', $inBeg);
      $tm = mktime(0, 0, 0, (int)$mdy[0], (int)$mdy[1], (int)$mdy[2]);
      $this->BegRDate = date('Y-m-d', $tm);
      $mdy = explode('/', $inEnd);
      $tm = mktime(0, 0, 0, (int)$mdy[0], (int)$mdy[1], (int)$mdy[2]);
      $this->EndRDate = date('Y-m-d', $tm);
    }
  }
  public function setAcctPerRange($inBeg='', $inEnd='')
  {
    if($inBeg=='' || $inEnd=='')
    {
      throw new Exception("setAcctPer::setAcctPer($begin, $end) - must set begin and end period.");
    }
    else
    {
      $this->BeginPer = $inBeg;
      $this->EndPer = $inEnd;
    }    
  }
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'ReadingId'   =>  'ReadingId',
    'SiteId'      =>  'SiteId',
    'FaceReading' =>  'FaceReading',
    'ReadingComment'     =>  'Comment',
    'MeterId'     =>  'MeterId',
    'EnteredBy'   =>  'EnteredBy',
    'EnteredDate' =>  'EnteredDate',
    'ReadingDate' =>  'ReadingDate',
    'ReadingAcctPeriod' => 'AcctPer',
    'Multiplier'  =>  'Multiplier',
    'MeterDesc'        =>  'MeterDesc');
  protected function getOpenSQL()
  {
    $siteFilter = ($this->siteId == '') || ($this->siteId == 'ALL') ? '' : 
                                            "and r.SiteId = '$this->siteId'";
    $rangeFilter = '';
    if($this->BegRDate!='' && $this->EndRDate!='')
    {
      $rangeFilter = " 
            and ReadingDate >= '$this->BegRDate'
            and ReadingDate <= '$this->EndRDate'";
    }
    if($this->BeginPer!='' && $this->EndPer!='')
    {
      $rangeFilter = " 
            and ReadingAcctPeriod >= '$this->BeginPer'
            and ReadingAcctPeriod <= '$this->EndPer'";
    }
    
    return "select  ReadingId, FaceReading, ReadingComment, m.MeterId,
            r.EnteredBy, r.EnteredDate, ReadingDate, ReadingAcctPeriod, 
            m.MeterDesc, m.Multiplier, r.SiteId
            from MeterReadings r, Meters m
            where r.MeterId = m.MeterId
            $rangeFilter
            $siteFilter
            order by SiteId, r.MeterId, ReadingDate";  
  }
  protected function getInsertSQL($current)
  {
    return 
    "insert into MeterReadings 
    (MeterId, SiteId, ReadingId, FaceReading, ReadingComment, EnteredBy, 
      EnteredDate, ReadingDate, ReadingAcctPeriod) 
    values
    ('$current->MeterId',
    '$current->SiteId',
    '$current->ReadingId',
    '$current->FaceReading',
    '$current->Comment',
    '$current->EnteredBy',
    '$current->EnteredDate',
    '$current->ReadingDate',
    '$current->AcctPer')";
  }
  protected function getUpdateSQL($current)
  {
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
  protected function getDeleteSQL($current)
  {
    return
    "delete from MeterReadings
    where ReadingId='$current->ReadingId'";
  }
}
?>
