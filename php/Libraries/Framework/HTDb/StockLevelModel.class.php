<?php

class StockLevelModel extends SolModel {

	private $critSite; 
    function StockLevelModel($siteid="") {
    	if ($siteid!="") $this->critSite=$siteid;
    	else $this->critSite="";
    	parent::__construct();
    }
    
    public function getOpenSql(){
    	if ($this->critSite != "") $where = " where siteid='$this->critSite'";
    	else $where="";
    	$sql = "Select * From htstklvl $where";
    	return $sql;
    }
    
    protected $accessorNames = array(
    	"siteid"=>"siteid",
    	"invtid"=>"invtid",
    	"stklvl"=>"stklvl",
    );
    
}
?>