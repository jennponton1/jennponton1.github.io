<?php
 /**
  * StatSumModel - Provides access to the statsum table.
  *
  * This class extends the  class which is part
  * of the HTFramework class libarary.
  */
  class StatSumModel extends DwhModel
  {
  /**
   * Filters - data members used to filter the object list
   */   
  private $ordnbr;
  private $site;
 /**
  * __construct - Constructs StatSumModel objects.
  */
  public function __construct()
  {
    parent::__construct($this); // must call parent constructor 
    $this->ordnbr="";
    $this->site="";
  }
  /**
   * Filters - get and set methods
   */   
  public function setOrdNbr($in_ordnbr)
  {
    $this->ordnbr=$in_ordnbr;
    return $this->ordnbr;
  }
  public function getordnbr()
  {
    return $this->ordnbr;
  }
  public function setSite($in_site){
    $this->site = $in_site;
    return $this->site;
  }

  /**
   * Associate StatSumModel accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */
  'siteid' => 'SiteID',		// array('YES',''),
  'ordnbr' => 'OrderNumber',		// array('YES',''),
  'trtmt' => 'Treatment',		// array('YES',''),
  'custname' => 'CustName',		// array('YES',''),
  'custordnbr' => 'CustOrdNbr',		// array('YES',''),
  'slsperid' => 'SlsPerId',		// array('YES',''),
  'orddate' => 'OrderDate',		// array('YES',''),
  'matlrcvddt' => 'MaterialRcvDate',		// array('YES',''),
  'dtduetoship' => 'DateDueToShip',		// array('YES',''),
  'status' => 'Status',		// array('YES',''),
  'dtrdy' => 'DateReady',		// array('YES',''),
  'carrier' => 'Carrier',		// array('YES',''),
  'totord' => 'TotalOrder',		// array('YES',''),
  'shipped' => 'Shipped',		// array('YES',''),
  'notes' => 'Notes'		// array('YES',''),
  );
  
  /**
   * Define SQL used to open, insert, update and delete
   */       
  protected function getOpenSQL()
  {
    $where = "";
    if ($this->ordnbr != "") $where = " ordnbr = '$this->ordnbr' ";
    if ($this->site != "")  {
      if ($where != "")  $where.=" and ";
      $where .= " siteid='$this->site' ";
    }
    if ($where != "") $where = "where $where";
    $sql = "select  
    siteid,  
    ordnbr,  
    trtmt,  
    custname,  
    custordnbr,  
    slsperid,  
    orddate,  
    matlrcvddt,  
    dtduetoship,  
    status,  
    dtrdy,  
    carrier,  
    totord,  
    shipped,  
    notes    
    from statsum
    $where ";
    //where ordnbr = '$this->ordnbr'";
    return $sql;
  }
  protected function getInsertSQL($row)
  {
//  	$colList = $this->getColumnList();
  	$colList = "(siteid,  
    ordnbr,  
    trtmt,  
    custname,  
    custordnbr,  
    slsperid,  
    orddate,  
    matlrcvddt,  
    dtduetoship,  
    status,  
    dtrdy,  
    carrier,  
    totord,  
    shipped,  
    notes)";
  	$valuesClause = "('$row->SiteID',  
    '$row->OrderNumber',  
    '$row->Treatment',  
    '$row->CustName',  
    '$row->CustOrdNbr',  
    '$row->SlsPerId',  
    '$row->OrderDate',  
    '$row->MaterialRcvDate',  
    '$row->DateDueToShip',  
    '$row->Status',  
    '$row->DateReady',  
    '$row->Carrier',  
    '$row->TotalOrder',  
    '$row->Shipped',  
    '$row->Notes')";  
    $sql = "insert into  
    statsum
    $colList values $valuesClause";
    return $sql;
  }
}  // end StatSumModel class definition
?>
