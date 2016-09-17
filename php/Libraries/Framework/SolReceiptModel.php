<?php

require  "HTFramework.inc.php";
include "../framework/htwapp.class.php";

class SolReceiptDetailModel extends SolModel {

  public $recNbr;


  public function __construct($recNbr='')
  {
    $this->setReceiptNumber($recNbr);
    parent::__construct(); // must call parent constructor 
  }
  public function setReceiptNumber($recNbr)
  {
    if($recNbr=='')
    {
    	die("You must include a beginning and ending period number");
    }
    else
    {    
      $this->recNbr = $recNbr;
    }
  }	
}

function check_numeric($var) {
	// First remove all , AFTER the first character
	$tmp = substr($var,0,1);
	$tmp2 = substr($var,1);
	$tmp2 = str_replace(",","",$tmp2);
	$var = $tmp.$tmp2;
	//die("<br>".$var);
	return is_numeric($var);
} // check_numeric


class SolReceiptModel extends SolModel
{
  // public methods
  public $begPerNbr;
  public $endPerNbr;
  public function __construct($inBeg='', $inEnd='')
  {
    $this->setPerNbrRange($inBeg, $inEnd);
    SolModel::__construct(); // must call parent constructor 
  }
  public function setPerNbrRange($inBeg='', $inEnd='')
  {
    if($inBeg=='' || $inEnd=='')
    {
    	die("You must include a beginning and ending period number");
    }
    else
    {    
      $this->begPerNbr = $inBeg;
      $this->endPerNbr = $inEnd;
    }
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
    'rcptnbr'   =>  'rcptnbr',
    'rcptdate' =>  'rcptdate',
    'siteid'     =>  'siteid',
    'ponbr'     =>  'ponbr',
    'invtid'   =>  'invtid'
	);

  protected final function getOpenSQL()
  {
    return "select  *
            from htrthdr h, htrtdet d
            where
			 h.perpost between '$this->begPerNbr' and '$this->endPerNbr' and 
			h.rcptnbr=d.rcptnbr and
 			h.siteid=d.siteid";  
  }
}

/*function __autoload($class_name) {
   if (substr($class_name,0,3)=="cls") $class_name=substr($class_name,3);
   require_once $class_name . '.class.php';
}*/

$xpOrders = new SolReceiptModel('200605','200605');

set_time_limit(300);

$xpOrders->Open();

$det=array();
$curRow = 0;
$hdrs[] = "RC #";
$hdrs[] = "PONbr";
$hdrs[] = "Rec Date";
$hdrs[] = "Site";
$hdrs[] = "invtid";
foreach ($hdrs as $ndx=>$hdr) {
	$widths[]=100;
}

while ($xpOrders->valid()){
	$row = $xpOrders->current();
	$det[$curRow][]=$row->rcptnbr;
	$det[$curRow][]=$row->ponbr;
	$det[$curRow][]=date("m/d/Y",strtotime($row->rcptdate));
	$det[$curRow][]=$row->siteid;
	$det[$curRow][]=$row->invtid;
	$xpOrders->next();
	$curRow++;
}

$htwApp->makeTable($hdrs,$widths,500,$det);

?>
