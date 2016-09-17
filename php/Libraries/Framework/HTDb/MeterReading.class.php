<?php
/**
 * MeterReading - class
 * Provides access to one kiln fuel meter reading by id
 * @package HTFramework
 * @subpackage HTDb
 */  
class MeterReading extends DwhModel
{
  private $readingId;
  // public methods
  public function __construct($inId = '')
  {
    if(!isset($inId))
      throw new HTException('MeterReading::__construct(...) - unset id.');
    $this->readingId = $inId;
    DwhModel::__construct(); // must call parent constructor 
  }
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'ReadingId'   =>  'ReadingId',
    'FaceReading' =>  'FaceReading',
    'ReadingComment'     =>  'Comment',
    'MeterId'     =>  'MeterId',
    'EnteredBy'   =>  'EnteredBy',
    'EnteredDate' =>  'EnteredDate',
    'ReadingDate' =>  'ReadingDate',
    'MeterDesc'   =>  'MeterDesc',
    'Multiplier'  =>  'Multiplier',
    'SiteId'      =>  'SiteId',
    'ReadingAcctPeriod' => 'AcctPeriod');
  protected function getOpenSQL()
  {
    return "select  ReadingId, FaceReading, ReadingComment, m.MeterId, 
            m.Multiplier, r.EnteredBy, r.EnteredDate, ReadingAcctPeriod, 
            ReadingDate, m.MeterDesc, r.SiteId
            from MeterReadings r, Meters m
            where r.MeterId = m.MeterId
            and ReadingId = '$this->readingId'";
  }
  protected function getInsertSQL($current)
  {
    
    return 
    "insert into MeterReadings 
    (MeterId, FaceReading, ReadingAcctPeriod, ReadingComment, EnteredBy, EnteredDate, 
     ReadingDate, SiteId) 
    values
    ('$current->MeterId',
    '$current->FaceReading',
    '$current->AcctPeriod',
    '$current->Comment',
    '$current->EnteredBy',
    '$current->EnteredDate',
    '$current->ReadingDate',
    '$current->SiteId')";
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
    ReadingAcctPeriod='$current->AcctPeriod',
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
