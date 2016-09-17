<?php
//****************************************************MODELS WOODIDMODEL**********************************************
class PartNbrModel extends SolModel
{
  // public methods
  public $woodType;
  public $criteriaId;
  public $idType; // Used to determine if the criteriaID is an InvtID or a woodid
  public function __construct($woodType='')
  {
    $this->setWoodType($woodType);
    $this->idType="";
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
  	if ($this->idType=="")
  	  $this->idType="invtid"; // assume that this is a part #
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
	'invtid'=>'invtid',
	'stkitem'=>'stkitem',
	'discprc'=>'discprc',
	'dfltwhseloc'=>'dfltwhseloc',
	'descr'=>'descr',
	'stkunit'=>'stkunit',
	'invtacct'=>'invtacct',
	'invtsub'=>'invtsub',
	'cogsacct'=>'cogsacct',
	'cogssub'=>'cogssub',
	'stdcost'=>'stdcost',
	'valmthd'=>'valmthd',
	'replmthd'=>'replmthd',
	'compsalesflag'=>'compsalesflag',
	'user1'=>'user1',
	'batnbr'=>'batnbr',
	'batflag'=>'batflag',
	'dfltsite'=>'dfltsite',
	'classid'=>'classid',
	'kitflag'=>'kitflag'
	);

  protected final function getOpenSQL()
  {
    $criteria="";
    if ($this->idType=="" || $this->idType=="invtid") 
      $fld = "invtid";
    else $fld=$this->idType;
    if ($this->woodType != "") {
    	$criteria = "where invtid like '$this->woodType%'";	
    }
    else
    if ($this->idType == "woodid") {
    	$critFilter = substr($this->criteriaId,0,1)."___".substr($this->criteriaId,1);
    	$criteria = "where invtid like '$critFilter'";	
    }
    else 
    if ($this->idType == "invtid") {
      $criteria = " where invtid like '$this->criteriaId%' ";
    }
    else $criteria = "";
    $sql= "select  *
            from invntory
			$criteria
			order by invtid
            ";  
            //die($sql." ".$this->woodType." ".$this->idType." ".$this->criteriaId." ".$fld);
    return $sql;
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
  		$valList .= "'".str_replace("'","''",$newRow->$field)."'";
  		if ($fldList != "") $fldList .= ", ";
  		$fldList.= "$col";
  	}
  	$sql =  "insert into invntory ($fldList) values ($valList)";
  	//die ($sql);
  	return $sql;
  } 
  
} // End of Model Class Definition

//****************************************************END OF WOODIDMODEL**********************************************
?>
