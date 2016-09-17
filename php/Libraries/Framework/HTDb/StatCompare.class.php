<?php
/**
 * TruckView - class
 * Provides access to Truck Request views
 * @package HTFramework
 * @subpackage HTDb
 */  
 
//include $_SERVER["DOCUMENT_ROOT"].'/Inetpub/php/Libraries/Framework/DwhModel.class.php';
//class MeterReadings extends DwhModel
class StatCompare extends DwhModel{

  public $pordnbr;
  public $pinvtid;
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
    'siteid'  =>  'siteid',
    'invtid'  =>  'invtid',
    'totpcs'  =>  'totpcs',
    'pcsrem'  =>  'pcsrem',
    'pcsship' =>  'pcsship',
    'spcs'    =>  'spcs',
    'pcs'     => 'pcs',
    'status'  => 'status'
  );
  /* */

  protected function getOpenSQL(){
    if ($this->siteId != 'ALL')
      $where_site = "h.siteid = '$this->siteId' and";
    else
      $where_site = '';

    switch ($this->statdoc){
      case "Y":
        $sql = "select h.ordnbr, h.pcsrem, h.pcsship, d.invtid, d.pcs, d.status
                from stathdr h ,statdet d
                where h.ordnbr = d.ordnbr and h.invtid = d.invtid and
                  h.ordnbr = '$this->pordnbr' and d.invtid = '$this->pinvtid'";
        break;
      default:
        $sql = "Select h.ordnbr, h.siteid, h.invtid, h.pcsrem, h.pcsship,
                  (h.pcsrem + h.pcsship) as totpcs, sum(d.pcs) as spcs
                From stathdr h, statdet d
                Where $where_site h.invtid = d.invtid and h.ordnbr = d.ordnbr
                  and h.siteid = d.siteid
                Group by d.siteid, d.ordnbr, d.invtid
                Order by h.siteid, d.ordnbr, d.invtid";
               // Order changed by rsk for report - 2/2/07 
//                Order by h.siteid, d.invtid, d.ordnbr";
    }
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
