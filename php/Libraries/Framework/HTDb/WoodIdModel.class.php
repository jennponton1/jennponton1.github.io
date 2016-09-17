<?php
//****************************************************MODELS WOODIDMODEL**********************************************
class WoodIdModel extends DwhModel
{
  // public methods
  public $woodType;
  public $criteriaId;
  public $bf;
  public $sf;
  public $cf;
  public $wdType;
  public $netbf;
  public $m3d1;
  public $m3d2;
  public $m3d3;
  public $m3;
  public $expType;
  public function __construct($woodType='')
  {
    $this->setWoodType($woodType);
    DwhModel::__construct(); // must call parent constructor 
  }
  
  
  function calcFacs(){
	$row=$this->current();
	$this->wdType = substr($row->woodId,0,1);
	switch ($this->wdType) {
		case "A" :
					$this->bf = round( $row->nomDim1*$row->nomDim2*$row->nomDim3/12 , 4);
					$this->sf = 0;
					$this->cf = round( ($row->actDim1/12)*($row->actDim2/12)*$row->actDim3 , 4);
					$this->netbf =  round( $row->actDim1*$row->actDim2*$row->actDim3/12 , 4);
					$this->m3d1 = round($row->actDim1*2.54,1); 
					$this->m3d2 = round($row->actDim2*2.54,1); 
					$this->m3d3 = round($row->actDim3*12*2.54/100,2);
					$this->m3 = round($this->m3d1/100*$this->m3d2/100*$this->m3d3,6);
					$this->expType = "S4S";
					if (strstr($row->woodId,"RGH")) $this->expType="RGH";
					else if ($row->nomDim1 >=4 && $row->nomDim2 >=4) $this->expType="TBR"; 
		            break;
		case "B" :throw new HTException("Don't know how to handle plywood, guys!!!'",HTFRK_EX_STOP);
		            break;		        
	}
  }
  
  public function setWoodType($woodType='')
  {
    if($woodType=='' )
    {
      $this->woodType = "";
    }
    else
    {    
      $this->woodType = $woodType;
    }
  }
  public function setIDCriteria($woodId){
  	$this->criteriaId=$woodId;
  }
  public function setKey()
  {
  }
  public function setKeys($keys, $sort=false)
  {
  }
  public function sortByKey()
  {
  }
  
  protected $accessorNames = array(
  /* column name  =>  accessor name */
    'woodid'	=>  'woodId',
    'descr'		=>  'descr',
    'dimdescr'  =>  'dimdescr',
    'grade'     =>  'grade',
    'nomdim1'	=>  'nomDim1',
    'nomdim2'   =>  'nomDim2',
    'nomdim3'   =>  'nomDim3',
    'actdim1'   =>  'actDim1',
    'actdim2'   =>  'actDim2',
    'actdim3'   =>  'actDim3',
    'bndlsize' => 'bndlSize'
	);

  protected final function getOpenSQL()
  {
    $criteria="";
    if ($this->woodType != "") $criteria = "where woodid like '$this->woodType%'";
    else
    if ($this->criteriaId != "") $criteria = "where woodid='$this->criteriaId'";
    else $criteria = "";
    return "select  *
            from woodids
			$criteria
			order by woodid
            ";  
  }

  protected final function getUpdateSQL($newRow){
  	
  	$setList = "";
  	
  	$woodId = $newRow->woodId;
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($col != "woodid") {
	  		if ($setList != "") $setList.=", ";
	  		$setList .= " $col='".addslashes($newRow->$field)."'";
  		}
  	}
  	$sql = "update woodids set $setList where woodid='$woodId'";
  	//die("Dont know how to deal with this yet - $sql");
  	return  $sql;
  }
  
  protected final function getInsertSQL($newRow){
  	
  	$fldList = "";
  	$valList = "";
  	
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($valList != "") $valList.=", ";
  		$valList .= "'".addslashes( $newRow->$field )."'";
  		if ($fldList != "") $fldList .= ", ";
  		$fldList.= "$col";
  	}
  	return  "insert into woodids ($fldList) values ($valList)";
  } 
  
} // End of Model Class Definition

//****************************************************END OF WOODIDMODEL**********************************************
?>
