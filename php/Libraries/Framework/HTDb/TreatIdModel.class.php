<?php
//****************************************************MODELS TREATIDMODEL**********************************************
class TreatIdModel extends DwhModel
{
  // public methods
  public $woodType;
  public $criteriaId;
  public $unused;
  public function __construct($woodType='')
  {
    $this->setWoodType($woodType);
    $this->unused = false;
    DwhModel::__construct(); // must call parent constructor 
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
  public function setIDCriteria($treatId){
  	$this->criteriaId=$treatId;
  }
  
  public function setUnusedIds(){
  	$this->unused=true;
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
    'treatid'	=>  'treatId',
    'descr'		=>  'descr',
    'invacct' => 'invAcct',
    'cogsacct'=> 'cogsAcct'
	);

  protected final function getOpenSQL()
  {
    $criteria="";
    if ($this->unused) {
		$woodid=$this->criteriaId;
		if ($woodid=="") throw new HTException("You must set a woodid to use the Unused criteria",HTFRK_EX_STOP);
		$woodid=substr($woodid,1);
		$sql = "select x.* 
				from treatids x  left outer join invent c
				on ( concat(x.treatid,'$woodid') = c.invtid )
				where 
				 c.invtid is null
				order by treatid";
    }
    else {
	    if ($this->criteriaId != "") $criteria = "where treatid='$this->criteriaId'";
	    else
	    if ($this->woodType != "") $criteria = "where treatid like '$this->woodType%'";
	    else $criteria = "";
	    $sql = "select  *
	            from treatids
				$criteria
				order by treatid
	            ";
    } // Dont do the unused query
    return $sql;  
  }

  protected final function getUpdateSQL($newRow){
  	
  	$setList = "";
  	
  	$woodId = $newRow->treatId;
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($col != "treatid") {
	  		if ($setList != "") $setList.=", ";
	  		$setList .= " $col='".$newRow->$field."'";
  		}
  	}
  	$sql = "update treatids set $setList where treatid='$woodId'";
  	//die("Dont know how to deal with this yet - $sql");
  	return  $sql;
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
  	return  "insert into treatids ($fldList) values ($valList)";
  } 
  
} // End of Model Class Definition

//****************************************************END OF TREATIDMODEL**********************************************
?>