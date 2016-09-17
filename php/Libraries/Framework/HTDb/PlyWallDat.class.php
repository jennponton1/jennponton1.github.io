<?php
// @class PlyWallDat  Currently used in the PlyWall input/edit program

   class PlyWallDat extends DwhModel
{
   private $ordnum;
  
   public function __construct()
   {
     parent::__construct(); //$this, 'devnew', 'root', '', 'plywall');
   }
   public function setOrdNum($inOrdNum)
   {
     $this->ordnum=$inOrdNum;
     return $this->ordnum;
   } 
   protected $accessorNames = array(
//  plyordhdr
    'OrdNum'    => 'OrdNum',		  // array('',''),
    'PoNum'     => 'PoNum',	 	    // array('',''),
    'RepName'   => 'RepName',	    // array('',''),
    'OrdDate'   => 'OrdDate',	    // array('',''),
    'ShipDate'  => 'ShipDate',	  // array('',''),
    'CustName'  => 'CustName',	  // array('',''),
    'Company'   => 'Company',	    // array('',''),
    'BillAddr1' => 'BillAddr1',	  // array('',''),
    'BillAddr2' => 'BillAddr2',		// array('',''),
    'BillAddr3' => 'BillAddr3',		// array('',''),
    'BillCity'  => 'BillCity',		// array('',''),
    'BillState' => 'BillState', 	// array('',''),
    'BillZip'   => 'BillZip',	    // array('',''),
    'Phone'     => 'Phone',	  	  // array('',''),
    'Fax'       => 'Fax',	        // array('',''),
    'ShipAddr1' => 'ShipAddr1',	  // array('',''),
    'ShipAddr2' => 'ShipAddr2',		// array('',''),
    'ShipAddr3' => 'ShipAddr3',		// array('',''),
    'ShipCity'  => 'ShipCity',		// array('',''),
    'ShipState' => 'ShipState', 	// array('',''),
    'ShipZip'   => 'ShipZip',	    // array('',''),    
    'Mileage'   => 'Mileage',	    // array('',''),
    'Rate'      => 'Rate',	      // array('',''),
    'Truck'     => 'Truck',	      // array('',''),
    'Material'  => 'Material',	  // array('',''), 
    'SpInstr'   => 'SpInstr',	    // array('',''),
    'OrdStat'   => 'OrdStat',	    // array('',''),
    'ShipStat'  => 'ShipStat',	 	// array('',''),     
);
  protected function getOpenSQL()
  {
     $where = '';
   if($this->ordnum != '') {
      $where = "Where OrdNum = '$this->ordnum'";
   }
  
    $sql = "select
    OrdNum,    
    PoNum,     
    RepName,   
    OrdDate,   
    ShipDate,  
    CustName,  
    Company,   
    BillAddr1, 
    BillAddr2, 
    BillAddr3, 
    BillCity,  
    BillState, 
    BillZip,   
    Phone,     
    Fax,       
    ShipAddr1, 
    ShipAddr2, 
    ShipAddr3, 
    ShipCity,  
    ShipState, 
    ShipZip,   
    Mileage,   
    Rate,      
    Truck,     
    Material,  
    SpInstr,   
    OrdStat,   
    ShipStat
    From plywall.plyordhdr $where";
    return $sql;
  }
  protected function getUpdateSQL($current)
  {
    return 
    "update plywall.plyordhdr set
    OrdNum    = '$current->OrdNum',
    PoNum     = '$current->PoNum',
    RepName   = '$current->RepName',
    OrdDate   = '$current->OrdDate',
    ShipDate  = '$current->ShipDate',
    CustName  = '$current->CustName',
    Company   = '$current->Company',
    BillAddr1 = '$current->BillAddr1',
    BillAddr2 = '$current->BillAddr2',
    BillAddr3 = '$current->BillAddr3',
    BillCity  = '$current->BillCity',
    BillState = '$current->BillState',
    BillZip   = '$current->BillZip',
    Phone     = '$current->Phone',
    Fax       = '$current->Fax',
    ShipAddr1 = '$current->ShipAddr1',
    ShipAddr2 = '$current->ShipAddr2',
    ShipAddr3 = '$current->ShipAddr3',
    ShipCity  = '$current->ShipCity',
    ShipState = '$current->ShipState',
    ShipZip   = '$current->ShipZip',
    Mileage   =  $current->Mileage,
    Rate      =  $current->Rate,
    Material  =  $current->Material,
    SpInstr   = '$current->SpInstr',
    OrdStat   = '$current->OrdStat',
    ShipStat  = '$current->ShipStat',
    Truck     =  $current->Truck
    where  OrdNum  = '$current->OrdNum'";
  }
    
  protected function getInsertSQL($current)
  {
    return 
    "insert into plywall.plyordhdr( 
    OrdNum,    
    PoNum,     
    RepName,   
    OrdDate,  
    ShipDate,  
    CustName,  
    Company,   
    BillAddr1, 
    BillAddr2, 
    BillAddr3, 
    BillCity,  
    BillState, 
    BillZip,   
    Phone,     
    Fax,       
    ShipAddr1, 
    ShipAddr2, 
    ShipAddr3, 
    ShipCity, 
    ShipState, 
    ShipZip,   
    Mileage,   
    Rate,      
    Truck,     
    Material,  
    SpInstr,   
    OrdStat,   
    ShipStat)  
    values(
    '$current->OrdNum',
    '$current->PoNum',
    '$current->RepName',
    '$current->OrdDate',
    '$current->ShipDate',
    '$current->CustName',
    '$current->Company',
    '$current->BillAddr1',
    '$current->BillAddr2',
    '$current->BillAddr3',
    '$current->BillCity',
    '$current->BillState',
    '$current->BillZip',
    '$current->Phone',
    '$current->Fax',
    '$current->ShipAddr1',
    '$current->ShipAddr2',
    '$current->ShipAddr3',
    '$current->ShipCity',
    '$current->ShipState',
    '$current->ShipZip',
    '$current->Mileage',
    '$current->Rate',
    '$current->Truck',
    '$current->Material',
    '$current->SpInstr',
    '$current->OrdStat',
    '$current->ShipStat')";    
  }
}
?>
