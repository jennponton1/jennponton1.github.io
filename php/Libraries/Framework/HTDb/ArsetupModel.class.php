<?php

class ArsetupModel extends SolModel{

    function __construct(){
    	parent::__construct($this);
    }
    function getOpenSql(){
    	$sql = "Select * From arsetup";
    	return $sql;
    }
    protected $accessorNames=array (
		'setupid'=>'setupid', 
		'init'=>'init', 
		'autobat'=>'autobat', 
		'lastbatnbr'=>'lastbatnbr', 
		'summpost'=>'summpost', 
		'pernbr'=>'pernbr', 
		'autoref'=>'autoref', 
		'compsales'=>'compsales', 
		'aracct'=>'aracct', 
		'arsub'=>'arsub', 
		'discacct'=>'discacct', 
		'discsub'=>'discsub', 
		'finchrgacct'=>'finchrgacct', 
		'finchrgsub'=>'finchrgsub', 
		'lastrefnbr'=>'lastrefnbr', 
		'minfinchrg'=>'minfinchrg', 
		'chrgmin'=>'chrgmin', 
		'compdfinchrg'=>'compdfinchrg', 
		'annfinchrg'=>'annfinchrg', 
		'chkacct'=>'chkacct', 
		'chksub'=>'chksub', 
		'dfltclass'=>'dfltclass', 
		'openitem'=>'openitem', 
		'dfltstmtcycle'=>'dfltstmtcycle', 
		'incacct'=>'incacct', 
		'incsub'=>'incsub', 
		'perretdoc'=>'perretdoc', 
		'custviewdflt'=>'custviewdflt', 
		'accrualmthd'=>'accrualmthd', 
		'finchrgfirst'=>'finchrgfirst', 
		'retavgday'=>'retavgday', 
		'binary'=>'binary', 
		'trandescdft'=>'trandescdft', 
		'slstax'=>'slstax', 
		'slstaxdft'=>'slstaxdft', 
		'creditholdtp'=>'creditholdtp', 
		'dayspastdue'=>'dayspastdue', 
		'overlimamt'=>'overlimamt', 
		'overlimtyp'=>'overlimtyp', 
    );
    
}
?>
