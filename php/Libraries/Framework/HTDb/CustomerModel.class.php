<?php

class CustomerModel extends SolModel{

	protected $critCust;
    function CustomerModel() {
    	$this->critCust="";
    	parent::__construct();
    }
    function setCustid($custid){
    	$this->critCust=$custid;
    }
    function getOpenSql(){
			if($this->critCust == '')
    	$sql = "Select c.*, a.* From customer c, address a where 
        c.addrid = a.addrid order by lastname";
      else
    	$sql = "Select c.*, a.* From customer c, address a where c.custid='$this->critCust'
        and c.addrid = a.addrid";
      return $sql;
    }
    protected $accessorNames = array(
		'custid'=>'custid', 
		'aracct'=>'aracct', 
		'arsub'=>'arsub', 
		'slsacct'=>'slsacct', 
		'slssub'=>'slssub', 
		'openitem'=>'openitem', 
		'prtstmt'=>'prtstmt', 
		'dunmsg'=>'dunmsg', 
		'applfinchrg'=>'applfinchrg', 
		'slsperid'=>'slsperid', 
		'prclvlid'=>'prclvlid', 
		'tradedisc'=>'tradedisc', 
		'lastinvcdate'=>'lastinvcdate', 
		'laststmtdate'=>'laststmtdate', 
		'cmprdata'=>'cmprdata', 
		'terms'=>'terms', 
		'crlimit'=>'crlimit', 
		'priorytdsales'=>'priorytdsales', 
		'priorytdcogs'=>'priorytdcogs', 
		'lastfinchrgbal'=>'lastfinchrgbal', 
		'lastagebal'=>'lastagebal', 
		'ptdsales'=>'ptdsales', 
		'ptdcogs'=>'ptdcogs', 
		'ytdcogs'=>'ytdcogs', 
		'begbal'=>'begbal', 
		'ytdsls'=>'ytdsls', 
		'ytdpymt'=>'ytdpymt', 
		'ytddrmemo'=>'ytddrmemo', 
		'ytdcrmemo'=>'ytdcrmemo', 
		'ytddisc'=>'ytddisc', 
		'ytdfinchrg'=>'ytdfinchrg', 
		'stmtcycleid'=>'stmtcycleid', 
		'lastactdate'=>'lastactdate', 
		'currbal'=>'currbal', 
		'agebal1'=>'agebal1', 
		'agebal2'=>'agebal2', 
		'agebal3'=>'agebal3', 
		'totopenord'=>'totopenord', 
		'shipcmplt'=>'shipcmplt', 
		'invtsubst'=>'invtsubst', 
		'tax1'=>'tax1', 
		'tax2'=>'tax2', 
		'tax3'=>'tax3', 
		'user1'=>'user1', 
		'user3'=>'user3', 
		'avgdaytopay'=>'avgdaytopay', 
		'futurebal'=>'futurebal', 
		'user2'=>'user2', 
		'user4'=>'user4', 
		'lastname'=>'lastname', 
		'firstname'=>'firstname', 
		'addrid'=>'addrid', 
		'tax4'=>'tax4', 
		'taxdflt'=>'taxdflt', 
		'taxregnbr'=>'taxregnbr', 
		'taxlocnbr'=>'taxlocnbr', 
		'status'=>'status', 
		'qmcreated'=>'qmcreated', 
		'classid'=>'classid', 
		'Addr1' => 'Addr1',		// array('ZString','146'),
    'Addr2' => 'Addr2',		// array('ZString','177'),
    'AddrId' => 'AddrId',		// array('ZString','0'),
    'Attn' => 'Attn',		// array('ZString','84'),
    'Chksum' => 'Chksum',		// array('Integer','460'),
    'City' => 'City',		// array('ZString','208'),
    'Fax' => 'Fax',		// array('ZString','280'),
    'FirstName' => 'FirstName',		// array('ZString','53'),
    'LastName' => 'LastName',		// array('ZString','22'),
    'Phone' => 'Phone',		// array('ZString','243'),
    'Salut' => 'Salut',		// array('ZString','115'),
    'ScrnNbr' => 'ScrnNbr',		// array('ZString','462'),
    'State' => 'State',		// array('ZString','239'),
    'TaxId1' => 'TaxId1',		// array('ZString','412'),
    'TaxId2' => 'TaxId2',		// array('ZString','416'),
    'TaxId3' => 'TaxId3',		// array('ZString','420'),
    'TaxId4' => 'TaxId4',		// array('ZString','424'),
    'TaxLocNbr' => 'TaxLocNbr',		// array('ZString','444'),
    'TaxRegNbr' => 'TaxRegNbr',		// array('ZString','428'),
    'Telex' => 'Telex',		// array('ZString','259'),
    'UpdUserId' => 'UpdUserId',		// array('ZString','467'),
    'User1' => 'User1',		// array('ZString','296'),
    'User2' => 'User2',		// array('ZString','327'),
    'User3' => 'User3',		// array('ZString','373'),
    'User4' => 'User4',		// array('Float','404'),
    'Zip' => 'Zip'		// array('ZString','11'),
    );
}
?>
