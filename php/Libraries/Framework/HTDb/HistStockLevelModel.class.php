<?php

class HistStockLevelModel extends DwhModel {

    protected $critDate;
    function HistStockLevelModel() {
    	$this->critDate="";
    	parent::__construct();
    }
    
    function setWhseDate($critDate=""){
    	$this->critDate=$critDate;
    }
    
    protected $accessorNames = array(
      "siteid"=>"siteid",
      "invtid"=>"invtid",
      "stklvl"=>"stklvl",
      "whsedate"=>"whsedate",
    );
    
  protected final function getInsertSQL($newRow){
  	
  	$fldList = "";
  	$valList = "";
  	
  	foreach ($this->accessorNames as $col=>$field) {
  		if ($valList != "") $valList.=", ";
  		$valList .= "'".$newRow->$field."'";
  		if ($fldList != "") $fldList .= ", ";
  		$fldList.= "$col";
  	}
  	$sql =  "insert into hist_stklvl ($fldList) values ($valList)";
  	//die ($sql);
  	return $sql;
  } 
    
    public final function getOpenSql(){
    	if  ($this->critDate == "" ) $where = "";
    	else $where = " where whsedate = '$this->critDate' "; 
    	$sql = "select * From hist_stklvl $where ";
    	return $sql;
    }
    
    public final function getDeleteSql($row){
    	if  ($this->critDate == "" ) 
    	  throw new HTException("You must specify a date to delete!!",HTFRK_EX_STOP);
    	$sql = "delete from hist_stklvl where whsedate='$this->critDate'";
    	//die($sql);
    	return $sql;
    }
    
}
?>