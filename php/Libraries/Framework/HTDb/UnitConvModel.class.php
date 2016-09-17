<?php
//****************************************************MODELS WOODIDMODEL**********************************************
class UnitConvModel extends SolModel
{
  // public methods
  public $woodType;
  public $criteriaId;
  public function __construct($woodType='')
  {
    $this->setWoodType($woodType);
    SolModel::__construct(); // must call parent constructor 
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
		'unitdesc'=>'unitdesc',
		'cnvfact'=>'cnvfact',
		'invtid'=>'invtid'
	);

  protected final function getOpenSQL()
  {
    $criteria="";
    if ($this->woodType != "") $criteria = "where invtid like '$this->woodType%'";
    else
    if ($this->criteriaId != "") $criteria = "where invtid='$this->criteriaId'";
    else $criteria = "";
    return "select  *
            from invntory
			$criteria
			order by invtid
            ";  
  }

  protected final function getUpdateSQL($newRow){
  	
  	$setList = "";
  	
  	$woodId = $newRow->woodId;
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($col != "woodid") {
	  		if ($setList != "") $setList.=", ";
	  		$setList .= " $col='".$newRow->$field."'";
  		}
  	}
  	$sql = "";
  	die("Dont know how to deal with this yet - $sql");
  	//return  $sql;
  }
  
  protected final function getInsertSQL($newRow){
  	
  	$fldList = "";
  	$valList = "";
  	
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($valList != "") $valList.=", ";
  		$valList .= "'".$newRow->$field."'";
  		if ($fldList != "") $fldList .= ", ";
  		$fldList.= "$col";
  	}
  	$sql =  "insert into unit ($fldList) values ($valList)";
  	//die ($sql);
  	return $sql;
  } 
  
} // End of Model Class Definition

//****************************************************END OF WOODIDMODEL**********************************************
?>