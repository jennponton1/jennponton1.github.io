<?php
 /**
  * HTExportCertModel - Provides access to the htlctbl table.
  *
  * This class extends the SolModel class which is part
  * of the HTFramework class libarary.
  */
  class HTExportCertModel extends SolModel
  {
  /**
   * Filters - data members used to filter the object list
   */   
  private $deltcktno;
 /**
  * __construct - Constructs HTExportCertModel objects.
  */
  public function __construct()
  {
    parent::__construct($this); // must call parent constructor 
  }
  public function setDelTcktNo($in_deltcktno)
  {
    $this->deltcktno=$in_deltcktno;
    return $this->deltcktno;
  }
  
  /**
   * Associate HTExportCertModel accessor methods with database column names
   */   
  protected $accessorNames = array(
  /* column name  =>  accessor name */
  'BankLine1' => 'BankLine1',		// array('ZString','1342'),
  'BankLine2' => 'BankLine2',		// array('ZString','1423'),
  'BankLine3' => 'BankLine3',		// array('ZString','1504'),
  'BankLine4' => 'BankLine4',		// array('ZString','1585'),
  'BankLine5' => 'BankLine5',		// array('ZString','1666'),
  'BankLine6' => 'BankLine6',		// array('ZString','1747'),
  'BefCertStm' => 'BefCertStm',		// array('ZString','2149'),
  'container' => 'Container',		// array('ZString','55'),
  'CustID' => 'CustID',		// array('ZString','21'),
  'CustLine1' => 'CustLine1',		// array('ZString','32'),
  'CustLine2' => 'CustLine2',		// array('ZString','113'),
  'CustLine3' => 'CustLine3',		// array('ZString','194'),
  'CustLine4' => 'CustLine4',		// array('ZString','275'),
  'CustLine5' => 'CustLine5',		// array('ZString','356'),
  'CustLine6' => 'CustLine6',		// array('ZString','437'),
  'deltcktno' => 'DelTcktNo',		// array('ZString','0'),
  'DescServGd' => 'DescServGd',		// array('ZString','2404'),
  'DescServGd2' => 'DescServGd2',		// array('ZString','2664'),
  'DestLine1' => 'DestLine1',		// array('ZString','1018'),
  'DestLine2' => 'DestLine2',		// array('ZString','1099'),
  'DestLine3' => 'DestLine3',		// array('ZString','1180'),
  'DestLine4' => 'DestLine4',		// array('ZString','1261'),
  'dunnage' => 'Dunnage',		// array('ZString','203'),
  'HTWLine1' => 'HTWLine1',		// array('ZString','518'),
  'HTWLine2' => 'HTWLine2',		// array('ZString','599'),
  'HTWLine3' => 'HTWLine3',		// array('ZString','680'),
  'HTWLine4' => 'HTWLine4',		// array('ZString','761'),
  'HTWLine5' => 'HTWLine5',		// array('ZString','842'),
  'HTWLine6' => 'HTWLine6',		// array('ZString','923'),
  'HTWPhone' => 'HTWPhone',		// array('ZString','1004'),
  'IssBankName' => 'IssBankName',		// array('ZString','2919'),
  'LastShipDt' => 'LastShipDt',		// array('Date','2145'),
  'LatePresDt' => 'LatePresDt',		// array('Integer','2663'),
  'LCAmt' => 'LCAmt',		// array('Float','2121'),
  'LCClosed' => 'LCClosed',		// array('Date','2659'),
  'LCDate' => 'LCDate',		// array('Date','1828'),
  'LCExp' => 'LCExp',		// array('Date','1832'),
  'LCNbr' => 'LCNbr',		// array('ZString','0'),
  'LCNotes1' => 'LCNotes1',		// array('ZString','1878'),
  'LCNotes2' => 'LCNotes2',		// array('ZString','1959'),
  'LCNotes3' => 'LCNotes3',		// array('ZString','2040'),
  'LCTerms' => 'LCTerms',		// array('ZString','1836'),
  'LCTolerOver' => 'LCTolerOver',		// array('Float','2129'),
  'LCTolerUndr' => 'LCTolerUndr',		// array('Float','2137'),
  'Nominal' => 'Nominal'		// array('Integer','170'),
  );
  
  /**
   * Define SQL used to open, insert, update and delete
   */  
  protected function getOpenSQL()
    {
      $sql = "select distinct a.*, h.nominal, h.lcnbr, h.custid, l.custline1, 
      l.custline2, l.custline3, l.custline4, l.custline5,
       l.custline6
       from htxdt a, htpfidet d, htpfihdr h, htlctbl l
       where a.deltcktno = '$this->deltcktno' and
       a.ordnbr=d.ordnbr and
       d.pfinvcnbr=h.pfinvcnbr and
       h.lcnbr=l.lcnbr(+)";
      return $sql;     
//   protected function getOpenSQL()
//   {
//     $sql = "select  
//     BankLine1,  BankLine2,  BankLine3,  BankLine4,  BankLine5,  BankLine6,  
//     BefCertStm,  CustID,  
//     CustLine1,  CustLine2,  CustLine3,  CustLine4,  CustLine5,  CustLine6,  
//     DescServGd,  DescServGd2,  
//     DestLine1,  DestLine2,  DestLine3,  DestLine4,  
//     HTWLine1,  HTWLine2,  HTWLine3,  HTWLine4,  HTWLine5,  HTWLine6,  
//     HTWPhone,  
//     IssBankName,  
//     LastShipDt,  
//     LatePresDt,  
//     LCAmt,  
//     LCClosed,  
//     LCDate,  
//     LCExp,  
//     LCNbr,  
//     LCNotes1, LCNotes2,  LCNotes3,  
//     LCTerms,  
//     LCTolerOver,  
//     LCTolerUndr    
//     from htxdt a, htpfidet d, htpfihdr h, htlctbl l
//     where a.deltcktno = '$this->deltcktno' and
//     a.ordnbr=d.ordnbr and
//     d.pfinvcnbr=h.pfinvcnbr and
//     h.lcnbr=l.lcnbr(+)";
//     return $sql;
  }
}  // end HTExportCertModel class definition

?>
