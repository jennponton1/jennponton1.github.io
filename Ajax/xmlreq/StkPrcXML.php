<?PHP
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 FUCNTIONS 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
function LookupPart($conn, $invtid, $siteid)
{  
   $sql = "select * from invntory i, htinconv v where 
           i.invtid = v.invtid and invtid = '$invtid'";
   $ds = odbc_exec($conn, $sql);

   $count = 0;
   $bffac = 0;
   $bndl  = 0;
   $stkitem = 'N';
   $sffac = 0;
   $descr = '';
   
   while (odbc_fetch_row($ds))
     {  $count++;
        $bffac = odbc_result($ds, 'bf');
        if (substr($invtid, 0, 1) == 'B')
          $sffac = odbc_result($ds, 'sf');
        else $sffac = '0';  
        $bndl = odbc_result($ds, 'bndl');
        $trtCode = odbc_result($ds, 'user2');
        $descr = odbc_result($ds, 'descr');     
        $stkitem = odbc_result($ds, 'stkitem');    
     }  //end while
   if ($count > 0)
     $valid = 'YES';
   else
     $valid = 'NO';
 
   $data  ="<data>\n<validpart>".htmlentities($valid)."</validpart>\n";  
   $data .= "<bffac>".htmlentities($bffac)."</bffac>\n";  
   $data .= "<sffac>".htmlentities($sffac)."</sffac>\n";  
   $data .= "<bndlsz>".htmlentities($bndl)."</bndlsz>\n";
   $data .= "<descr>".htmlentities($descr)."</descr>\n";  
   $data .= "<stkitem>".htmlentities($stkitem)."</stkitem>\n";  

   $sql = "Select
		  p.woodid, p.price as WdPrice, substring(s.invtid,2,3) as Trt,
						substring(s.invtid,1,4) as Trt2, s.invtid,
		  t.price as TrtPrice
			From htwdprc p, htstklvl s, invntory i, httrprc t
			where
			 p.siteid='$siteid' and
			 s.invtid=i.invtid and
			 s.invtid =  '$invtid' and 
			 p.woodid=i.user1 and
			 p.siteid=s.siteid and
			 i.user2=t.trtid and
			 p.siteid=t.siteid";
			 			   
   $ds = odbc_exec($conn, $sql);
   $wdprc = 0;
   $trtprice = 0;
   
   $wdprc = odbc_result($ds, 'WdPrice');
   if ($wdprc == '')
     $wdprc = 0;
   $data.="<wdprice>".htmlentities($wdprc)."</wdprice>\n";
   
   $trtprice = odbc_result($ds, 'TrtPrice');
   if ($trtprice == '')
     $trtprice = 0;
   $data.="<trtprice>".htmlentities($trtprice)."</trtprice>\n";
   
   if (($trtprice == 0) && ($wdprc == 0))
     $data.="<stocking>NO</stocking>\n";
   else
     $data.="<stocking>YES</stocking>\n";  
      
   $data .= "</data>\n";
   return $data;

}
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 MAIN CODE 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888

//called by DoLineItem.php
//called by LineItemFuncs.js:  checkPart
//returns xml data to DoLineItem.php


//will be able to pull and send pricing info, bf, sf factors here too!!!

   $conn = odbc_connect('adohtwsol', '', '');
   $data = '';

   $siteid = ''; 
   if (isset($_REQUEST['siteid']))
     $siteid = $_REQUEST['siteid'];
     
  
   if (isset($_REQUEST['invtid']))
     {
     	$invtid = $_REQUEST['invtid'];
      $data = LookupPart($conn, $invtid, $siteid);
     }
   $data = "<xml>\n".$data."</xml>\n";

header("Content-type: text/xml; charset=utf-8");
echo $data;
?>

