<?php
//****************************************************MODELS WOODIDMODEL**********************************************
class INConvModel extends SolModel
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
  public function setInvtID($invtid=""){
    if ($invtid=="") throw new HTException("You must specify an InvtID!",HTFRK_EX_STOP);
    $this->criteriaId=$invtid;
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
		'invtid'=>'invtid',
		'bf'=>'bf',
		'sf'=>'sf',
		'bndl'=>'bndl',
		'cuft'=>'cuft',
		'ea'=>'ea'
	);

  protected final function getOpenSQL()
  {
    $criteria="";
    if ($this->woodType != "") $criteria = "where invtid like '$this->woodType%'";
    else
    if ($this->criteriaId != "") $criteria = "where invtid='$this->criteriaId'";
    else $criteria = "";
    $sql = "select  *
            from htinconv
			$criteria
			order by invtid
            ";
    return   $sql;
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
  	$sql =  "insert into htinconv ($fldList) values ($valList)";
  	//die ($sql);
  	return $sql;
  } 
  
} // End of Model Class Definition

//****************************************************END OF WOODIDMODEL**********************************************
?>
