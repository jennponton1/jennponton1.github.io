<?php
/**
 * SlsSum - class
 * Provides access to Daily, Export Monthly and Monthly Sales Summary forms
 * @package HTFramework
 * @subpackage HTDb
 */  
	class SlsSum extends SolModel{
    private $sqlType;
    private $subAcct;
    private $begdate;
    private $enddate;

    public function __construct() { 
      parent::__construct($this); // must call parent constructor
    }

    public function setDateRange($in_begindate, $in_enddate) {
      $this->begdate = $in_begindate;
      $this->enddate = $in_enddate;
    }

    public function setSubAcct($in_subAcct)
    {
      if($in_subAcct == 'PB')
        $in_subAcct = 'PBA';
      $this->subAcct = $in_subAcct;
    }

    public function setSQLType($in_sqlType)
    {
      $this->sqlType = $in_sqlType;
    }

    protected $accessorNames = array(
      /* column name  =>  accessor name */
       'bf'          => 'bf',
       'chemcat'     => 'chemcat',
       'classid'     => 'classid',
       'cost'        => 'cost',
       'custid'      => 'custid',
       'doctype'     => 'DocType',     // Document Type (ZString-3)
       'extpriceinvc'=> 'extpriceinvc',
       'invcnbr'     => 'invcnbr',
       'invtid'      => 'invtid',
       'ordnbr'      => 'ordnbr',
       'ordtype'     => 'ordtype',
       'refnbr'      => 'RefNbr',      // Ref Number (ZString-7)
       'site'        => 'Site',
       'sf'          => 'sf',
       'slsprice'    => 'slsprice',
       'stkitem'     => 'stkitem',
       'trantype'    => 'TranType',
       'TranAmt'     => 'tranamt',
       'user1'       => 'misc',
       'user2'       => 'pcsship',
       'user3'       => 'freight',
       'whseloc'     => 'whseloc');      

    protected function getOpenSQL(){
      switch ($this->sqlType){
        case "MSS1":
          if(($this->enddate == '') || ($this->enddate == $this->begdate)){
  		      $sql = "select d.refnbr, t.trantype,
                        t.sub as site, t.tranamt, d.doctype
  		                from ardoc d,
  		                     artran t
  		               where d.BatNbr = t.BatNbr
  		                 and d.RefNbr = t.RefNbr
  		                 and d.PerPost = '$this->begdate'
  		                 and d.DocType in ('IN', 'CM', 'DM')
                       and t.sub = '$this->subAcct'";
          }
          else{
            $sql = "select d.refnbr, t.trantype, t.sub as site, t.tranamt, d.doctype
                        
  		                from ardoc d,
  		                     artran t
  		               where d.BatNbr = t.BatNbr
  		                 and d.RefNbr = t.RefNbr
  		                 and d.PerPost between '$this->begdate' and '$this->enddate'
  		                 and d.DocType in ('IN', 'CM', 'DM')
                       and t.sub = '$this->subAcct'";
          }
        break;
        case "MSS2":
           $sql = 
  "select t.sub as site, invcnbr,
   ordnbr,
   ordtype,
   bocntr,
   d.user1,
   d.user3,
   d.user2,
   h.custid,
   d.cost,
   d.invtid,
   d.slsprice,
   d.extpriceinvc,
   d.whseloc,
   v.bf,
   v.sf,
   i.stkitem,
   i.classid,
   p.chemcat
from artran t,
     ardoc a, 
     salesord h,
	   sodet d,
	   invntory i,
	   htinprod p,
	   htinconv v
where 
   a.PerPost between '$this->begdate' and '$this->enddate'
   and a.DocType in ('IN', 'CM', 'DM')
   and t.trantype <> 'TX'
   and t.sub = '$this->subAcct'
   
   and a.BatNbr = t.BatNbr
   and a.RefNbr = t.RefNbr
   and a.refnbr = h.invcnbr

   and t.linenbr = d.linenbr

   and h.ordnbr = d.ordnbr
   and h.ordtype = d.ordtype
   and h.bocntr = d.bocntr

   and d.invtid = i.invtid
   and i.invtid = v.invtid
   and i.classid = p.prodcat";
         break;
        default:
          throw new Exception('SlsSum::getOpenSQL() Unknown sqltype');
      }
      return $sql;
    }
  }
?>
