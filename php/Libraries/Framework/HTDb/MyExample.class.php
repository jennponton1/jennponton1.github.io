<?php
/**
 * My - class
 * Provides access to My 
 * @package HTFramework
 * @subpackage HTDb
 */  
class My extends DwhModel
{
  // public methods
  public $siteId;
  public $myId;
  public function __construct($inSite = '', $inMyId = '')
  {
    $this->siteId = $inSite;
    $this->myId = $inMyId;
    DwhModel::__construct(); // must call parent constructor 
  }
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'MyId'     =>  'MyId',
    'SiteId'      =>  'SiteId',
    'EnteredBy'   =>  'EnteredBy',
    'EnteredDate' =>  'EnteredDate');
  protected function getOpenSQL()
  {
    $idFilter = ($this->myId == '') ? '' : "where MyId = '$this->myId'";
    $siteFilter = ($this->siteId == '') ? '' : "where SiteId = '$this->siteId'";
    $filter = (($idFilter<>"") && ($siteFilter<>"")) ? 
                    $idFilter." and ".$siteFilter : // connect with and  
                    $idFilter." ".$siteFilter;      // one or both empty
    return "select  SiteId, MyId, EnteredBy, EnteredDate
            from My  
            $filter";
  }
  protected function getInsertSQL($current)
  {
    // Note <...>Id is an autoincrement key 
    return 
    "insert into My 
    (SiteId, EnteredBy, EnteredDate) 
    values
    ('$current->SiteId',
    '$current->EnteredBy',
    '$current->EnteredDate')";
  }
  protected function getUpdateSQL($current)
  {
    // Note that generally, changing SiteId is not done
    return 
    "update My set
    EnteredBy='$current->EnteredBy',
    EnteredDate='$current->EnteredDate'
    where MyId='$current->MyId'";
  }
  protected function getDeleteSQL($current)
  {
    return
    "delete from My
    where MyId='$current->MyId'";
  }
}

?>
