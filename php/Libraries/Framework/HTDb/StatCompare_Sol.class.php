<?php
/**
 * StatCompare_Sol - class
 * Provides access to Truck Request views
 * @package HTFramework
 * @subpackage HTDb
 */  

  class StatCompare_Sol extends SolModel{
    public $pordnbr;
    public $pinvtid;
    public $prawinvtid;
    public $siteId;
    public $bffilter;
    public $sitesearch;
    public $statdoc;

    public function __construct(){
      //$this->siteId = $inSite;
      //$this->bffilter = $bfamount;
      parent::__construct(); // must call parent constructor
    }

    protected $accessorNames = array(
    /* column name  =>  accessor name */
      'ordnbr'  =>  'ordnbr',
      'invtid'  =>  'invtid',
      'whseloc' => 'whseloc',
      'qtyonhand' =>'qtyonhand'
    );
    /* */

    protected function getOpenSQL(){
      $sql = "select * from htlocdet where ordnbr = '$this->pordnbr' and (invtid = '$this->pinvtid' or invtid = '$this->prawinvtid')";
      return $sql;
    }

    protected function getInsertSQL($current){
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

    protected function getDeleteSQL($current){
      return
      "delete from MeterReadings
      where ReadingId='$current->ReadingId'";
    }
  }
?>
