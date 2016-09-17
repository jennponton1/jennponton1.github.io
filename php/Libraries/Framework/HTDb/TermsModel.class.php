<?php
//****************************************************TERMSMODEL**********************************************
/**
 * TermsModel.class.php
 *  
 * @package HTFramework
 * @subpackage HTDb
 */
/**
 * TermsModel - class
 * This class provides access to the TERMS table
 * extends SolModel class 
 */ 
class TermsModel extends SolModel
{
/**
 * TermsId - primary key, (ZString-3) 
 * Example: 
 * TermsId, 	Descr, 	
 * 03	        C.O.D	
 * 04	        CASH	
 * 07	        ADF 1%10 NET 
 * 10	        CREDIT PENDING	
 * 11	        ADF 1%10TH PROX	
 *
 */ 
  public $TermsId;
  // public methods
  public function __construct($inTermsId='')
  {
    $this->TermsId=$inTermsId;
    parent::__construct($this); // must call parent constructor 
  }
  /**
   * protected $accessorNames array  
   * Associate TERMS accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */
	'termsid' 	=>	'TermsId' 	, 
	'descr' 	=>	'Descr' 	, 
	'discintrv' 	=>	'DiscIntrv' 	, 
	'discpct' 	=>	'DiscPct' 	, 
	'disctype' 	=>	'DiscType' 	, 
	'dueintrv' 	=>	'DueIntrv' 	, 
	'duetype' 	=>	'DueType' 	/*, 
	'chksum' 	=>	'chksum' 	, 
	'scrnnbr' 	=>	'scrnnbr' 	, 
	'upduserid' 	=>	'upduserid'*/ 	
	);
  /**
   *  getOpenSQL(), getUpdateSQL(), getInsertSQL()  
   * Define SQL used to open, insert, update
   * Note: we do not delete terms here.   
   */       
  protected final function getOpenSQL()
  {
  	if ($this->TermsId == "") $where = "";
  	else $where = "where termsid='$this->TermsId'";
  	$sql = "Select * From terms $where order by termsid";
  	return $sql;
  }

  protected final function getUpdateSQL($newRow){
  	"insert into TERMS( 
  descr,
  discintrv,
  discpct,
  disctype,
  dueintrv,
  duetype,
  scrnnbr,
  termsid,
  upduserid)
  values(
  '$current->Descr',
  '$current->DiscIntrv',
  '$current->DiscPct',
  '$current->DiscType',
  '$current->DueIntrv',
  '$current->DueType',
  '$current->ScrnNbr',
  '$current->TermsId',
  '$current->UpdUserId')";	//return  $sql;
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
  	$sql =  "insert into terms  ($fldList) values ($valList)";
  	//die ("NOT AN INSERTABLE MODEL YET".$sql);
  	return $sql;
  } 
  
} // End of Model Class Definition

//****************************************************END OF TERMSMODEL **********************************************
?>
