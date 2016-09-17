<?PHP
/*******************************************************************************************
  Program:     GetAddress.php
  Purpose:     Returns xml dataset with addressing info
  Written by:  Ann Jackson
  Date:        March, 2006
*********************************************************************************************/

//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 FUCNTIONS 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
/***************************************************************************************
  Function:   LookupShipToAddress
  Purpose:    Returns xml dataset with ShipTo address info
  Input from: address id
  Output to:  xml dataset
***************************************************************************************/
function LookupShipToAddress($conn, $addrid)
{
   $sql = "select * from address where addrid = '$addrid'";
   $ds = odbc_exec($conn, $sql);
   $count = 0;
   $data = "<data>\n";
     
   if (odbc_fetch_row($ds))
     {  $count++;
        $tmpval = trim(odbc_result($ds, 'lastname').' '.odbc_result($ds, 'firstname'));
        if ($tmpval <> '')
          $data.="<shipaddr1>".htmlentities($tmpval)."</shipaddr1>\n";
        else $data.="<shipaddr1>blank</shipaddr1>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr1'));
        if ($tmpval <> '')
          $data.="<shipaddr2>".htmlentities($tmpval)."</shipaddr2>\n";
        else $data.="<shipaddr2>blank</shipaddr2>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr2'));
        if ($tmpval <> '')
          $data.="<shipaddr3>".htmlentities($tmpval)."</shipaddr3>\n";
        else $data.="<shipaddr3>blank</shipaddr3>\n";
        
        $tmpval = trim(odbc_result($ds, 'city'));
        if ($tmpval <> '')
          $data.="<shipcity>".htmlentities($tmpval)."</shipcity>\n";
        else $data.="<shipcity>blank</shipcity>\n";
        
        $tmpval = trim(odbc_result($ds, 'state'));
        if ($tmpval <> '')
          $data.="<shipstate>".htmlentities($tmpval)."</shipstate>\n";
        else $data.="<shipstate>blank</shipstate>\n";
        
        $tmpval = trim(odbc_result($ds, 'zip'));
        if ($tmpval <> '')
          $data.="<shipzip>".htmlentities($tmpval)."</shipzip>\n";
        else $data.="<shipzip>blank</shipzip>\n";
        
        $tmpval = trim(odbc_result($ds, 'attn'));
        if ($tmpval <> '')
          $data.="<shipattn>".htmlentities($tmpval)."</shipattn>\n";
        else $data.="<shipattn>blank</shipattn>\n";
        
        $tmpval = trim(odbc_result($ds, 'salut'));
        if ($tmpval <> '')
          $data.="<shipsalut>".htmlentities($tmpval)."</shipsalut>\n";
        else $data.="<shipsalut>blank</shipsalut>\n";
        
        $tmpval = trim(odbc_result($ds, 'phone'));
        if ($tmpval <> '')
          $data.="<shipphone>".htmlentities($tmpval)."</shipphone>\n";
        else $data.="<shipphone>blank</shipphone>\n";
        
        $tmpval = trim(odbc_result($ds, 'telex'));
        if ($tmpval <> '')
          $data.="<shiptelex>".htmlentities($tmpval)."</shiptelex>\n";
        else $data.="<shiptelex>blank</shiptelex>\n";
        
        $tmpval = trim(odbc_result($ds, 'fax'));
        if ($tmpval <> '')
          $data.="<shipfax>".htmlentities($tmpval)."</shipfax>\n";
        else $data.="<shipfax>blank</shipfax>\n";
     }  //end if 
     
   if ($count > 0)
     $valid = 'YES';
   else
     $valid = 'NO';

   $data  .="<validship>".htmlentities($valid)."</validship>\n";
   $data .= "</data>\n";
   return $data;
}  //end function LookupShipToAddress
/***************************************************************************************
  Function:   LookupCustAddress
  Purpose:    Returns xml dataset with ShipTo & BillTo address info for a customer
  Input from: customer id
  Output to:  xml dataset
***************************************************************************************/

function LookupCustAddress($conn, $custid)
{  if ($custid <> '')
   {
   $sql = "select addrid from multship where custid = '$custid'";
   $ds = odbc_exec($conn, $sql);
   
   $addrid = odbc_result($ds, 'addrid');
   $sql = "Select * from address where addrid = '$addrid'";
   $ds = odbc_exec($conn, $sql);
   
   $data = "<data>\n";
   
   $count = 0;
   while (odbc_fetch_row($ds))
     {  $count++;
        $tmpval = trim(odbc_result($ds, 'lastname').' '.odbc_result($ds, 'firstname'));
        if ($tmpval <> '')
          $data.="<shipaddr1>".htmlentities($tmpval)."</shipaddr1>\n";
        else $data.="<shipaddr1>blank</shipaddr1>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr1'));
        if ($tmpval <> '')
          $data.="<shipaddr2>".htmlentities($tmpval)."</shipaddr2>\n";
        else $data.="<shipaddr2>blank</shipaddr2>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr2'));
        if ($tmpval <> '')
          $data.="<shipaddr3>".htmlentities($tmpval)."</shipaddr3>\n";
        else $data.="<shipaddr3>blank</shipaddr3>\n";
        
        $tmpval = trim(odbc_result($ds, 'city'));
        if ($tmpval <> '')
          $data.="<shipcity>".htmlentities($tmpval)."</shipcity>\n";
        else $data.="<shipcity>blank</shipcity>\n";
        
        $tmpval = trim(odbc_result($ds, 'state'));
        if ($tmpval <> '')
          $data.="<shipstate>".htmlentities($tmpval)."</shipstate>\n";
        else $data.="<shipstate>blank</shipstate>\n";
        
        $tmpval = trim(odbc_result($ds, 'zip'));
        if ($tmpval <> '')
          $data.="<shipzip>".htmlentities($tmpval)."</shipzip>\n";
        else $data.="<shipzip>blank</shipzip>\n";
        
        $tmpval = trim(odbc_result($ds, 'attn'));
        if ($tmpval <> '')
          $data.="<shipattn>".htmlentities($tmpval)."</shipattn>\n";
        else $data.="<shipattn>blank</shipattn>\n";
        
        $tmpval = trim(odbc_result($ds, 'salut'));
        if ($tmpval <> '')
          $data.="<shipsalut>".htmlentities($tmpval)."</shipsalut>\n";
        else $data.="<shipsalut>blank</shipsalut>\n";
        
        $tmpval = trim(odbc_result($ds, 'phone'));
        if ($tmpval <> '')
          $data.="<shipphone>".htmlentities($tmpval)."</shipphone>\n";
        else $data.="<shipphone>blank</shipphone>\n";
        
        $tmpval = trim(odbc_result($ds, 'telex'));
        if ($tmpval <> '')
          $data.="<shiptelex>".htmlentities($tmpval)."</shiptelex>\n";
        else $data.="<shiptelex>blank</shiptelex>\n";
        
        $tmpval = trim(odbc_result($ds, 'fax'));
        if ($tmpval <> '')
          $data.="<shipfax>".htmlentities($tmpval)."</shipfax>\n";
        else $data.="<shipfax>blank</shipfax>\n";
     }  //end if
  
   $sql = "select * from address where addrid = '$custid'";
   $ds = odbc_exec($conn, $sql);
     
        while (odbc_fetch_row($ds))
     {  $count++;
        $tmpval = trim(odbc_result($ds, 'lastname').' '.odbc_result($ds, 'firstname'));
        if ($tmpval <> '')
          $data.="<billaddr1>".htmlentities($tmpval)."</billaddr1>\n";
        else $data.="<billaddr1>blank</billaddr1>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr1'));
        if ($tmpval <> '')
          $data.="<billaddr2>".htmlentities($tmpval)."</billaddr2>\n";
        else $data.="<billaddr2>blank</billaddr2>\n";
        
        $tmpval = trim(odbc_result($ds, 'addr2'));
        if ($tmpval <> '')
          $data.="<billaddr3>".htmlentities($tmpval)."</billaddr3>\n";
        else $data.="<billaddr3>blank</billaddr3>\n";
        
        $tmpval = trim(odbc_result($ds, 'city'));
        if ($tmpval <> '')
          $data.="<billcity>".htmlentities($tmpval)."</billcity>\n";
        else $data.="<billcity>blank</billcity>\n";
        
        $tmpval = trim(odbc_result($ds, 'state'));
        if ($tmpval <> '')
          $data.="<billstate>".htmlentities($tmpval)."</billstate>\n";
        else $data.="<billstate>blank</billstate>\n";
        
        $tmpval = trim(odbc_result($ds, 'zip'));
        if ($tmpval <> '')
          $data.="<billzip>".htmlentities($tmpval)."</billzip>\n";
        else $data.="<billzip>blank</billzip>\n";
        
        $tmpval = trim(odbc_result($ds, 'attn'));
        if ($tmpval <> '')
          $data.="<billattn>".htmlentities($tmpval)."</billattn>\n";
        else $data.="<billattn>blank</billattn>\n";
        
        $tmpval = trim(odbc_result($ds, 'salut'));
        if ($tmpval <> '')
          $data.="<billsalut>".htmlentities($tmpval)."</billsalut>\n";
        else $data.="<billsalut>blank</billsalut>\n";
        
        $tmpval = trim(odbc_result($ds, 'phone'));
        if ($tmpval <> '')
          $data.="<billphone>".htmlentities($tmpval)."</billphone>\n";
        else $data.="<billphone>blank</billphone>\n";
        
        $tmpval = trim(odbc_result($ds, 'telex'));
        if ($tmpval <> '')
          $data.="<billtelex>".htmlentities($tmpval)."</billtelex>\n";
        else $data.="<billtelex>blank</billtelex>\n";
        
        $tmpval = trim(odbc_result($ds, 'fax'));
        if ($tmpval <> '')
          $data.="<billfax>".htmlentities($tmpval)."</billfax>\n";
        else $data.="<billfax>blank</billfax>\n";
     }  //end if

   if ($count > 0)
     $valid = 'YES';
   else
     $valid = 'NO';

   $data  .="<validcust>".htmlentities($valid)."</validcust>\n";
   $data .= "</data>\n";
   return $data;
}  //end if 

}
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 MAIN CODE 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
   $conn = odbc_connect('adohtwsol', '', '');
   $data = '';

   if (isset($_REQUEST['custid']))
     {
     	$custid = $_REQUEST['custid'];
        $data = LookupCustAddress($conn, $custid);
     }
     
  if (isset($_REQUEST['addrid']))
     {
       $addrid = $_REQUEST['addrid'];
       $data = LookupShipToAddress($conn, $addrid);
     }  //end if   

   $data = "<xml>\n".$data."</xml>\n";

header("Content-type: text/xml; charset=utf-8");
echo $data;
?>
