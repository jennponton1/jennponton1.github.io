<?php
/**
 * Meters - class
 * Provides access to kiln fuel meters 
 * @package HTFramework
 * @subpackage HTDb
 */  
class Meters extends DwhModel
{
  // public methods
  public $meterId;
  public $siteId;
  public function __construct($inSite = '', $inMeterId = '')
  {
    $this->siteId = $inSite;
    $this->meterId = $inMeterId;
    DwhModel::__construct(); // must call parent constructor 
  }
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'MeterId'     =>  'MeterId',
    'SiteId'      =>  'SiteId',
    'MeterDesc' =>  'MeterDesc',
    'UnitDesc'     =>  'UnitDesc',
    'EnteredBy'   =>  'EnteredBy',
    'EnteredDate' =>  'EnteredDate',
    'Multiplier'   =>  'Multiplier');
  protected function getOpenSQL()
  {
    $idFilter = ($this->meterId == '') ? '' : " MeterId = '$this->meterId'";
    $siteFilter = ($this->siteId == '') ? '' : " SiteId = '$this->siteId'";
    $filter = '';
		if(($idFilter<>"") && ($siteFilter<>""))
			$filter = $idFilter." and ".$siteFilter;
		else
    	if(($idFilter<>"") || ($siteFilter<>""))
				$filter = $idFilter." ".$siteFilter;
    $filter = ($filter<>'') ?  'where '. $filter : '';
    return "select  SiteId, MeterId, MeterDesc, UnitDesc, Multiplier, 
                    EnteredBy, EnteredDate
            from Meters  
            $filter
            order by SiteId, MeterDesc";
  }
  protected function getInsertSQL($current)
  {
    if(empty($current->Multiplier))
    	$current->Multiplier = 1;
		$sql =  
    "insert into Meters 
    (SiteId, MeterDesc, UnitDesc, Multiplier, EnteredBy, EnteredDate) 
    values
    ('$current->SiteId',
    '$current->MeterDesc',
    '$current->UnitDesc',
    $current->Multiplier,
    '$current->EnteredBy',
    '$current->EnteredDate')";
    return $sql;
  }

  protected function getUpdateSQL($current)
  {
    return 
    "update Meters set
    Multiplier='$current->Multiplier',
    MeterDesc='$current->MeterDesc',
    UnitDesc='$current->UnitDesc',
    EnteredBy='$current->EnteredBy',
    EnteredDate='$current->EnteredDate',
    SiteId='$current->SiteId'
    where MeterId='$current->MeterId'";
  }
  protected function getDeleteSQL($current)
  {
    return
    "delete from Meters
    where MeterId='$current->MeterId'";
  }
}

?>
