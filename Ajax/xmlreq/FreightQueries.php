<?PHP
/*******************************************************************************************
  Program:     PullCities.php
  Purpose:     Returns xml dataset with cities
*********************************************************************************************/

//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 FUCNTIONS 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
function LookupCities($myconn, $state)
{
  $state = trim(strtoupper($state));
  
   $sql = "select distinct city from freightrates where state = '$state'
           order by city";
   $ds = odbc_exec($myconn, $sql);
   $data = "<data>\n";
   $count = 0;
    
   while (odbc_fetch_row($ds))
     {  $count++;
        $tmpval = trim(odbc_result($ds, 'city'));
        if ($tmpval <> '')
          $data.="<city>".htmlentities($tmpval)."</city>\n";
        else $data.="<city>blank</city>\n";
     }  //end while 
   
   if ($count == 0)
       $data.="<city>None available</city>\n";
   $data .= "</data>\n";
   return $data;
}  //end function LookupCities

function PullBFPerTruck($myconn, $siteid, $invtid)
{  $invtid = trim(strtoupper($invtid));
   
   $sql = "select * from trkfcts where siteid = '$siteid' and invtid = '$invtid'";
   $ds = odbc_exec($myconn, $sql);
   $data = "<data>\n";
   $count = 0;
    
   while (odbc_fetch_row($ds))
     {  $count++;
        $tmpval = odbc_result($ds, 'infact');
        if ($tmpval <> '')
          $data.="<infact>".htmlentities($tmpval)."</infact>\n";
        else $data.="<infact>0</infact>\n";
        
        $tmpval = odbc_result($ds, 'outfact');
        if ($tmpval <> '')
          $data.="<outfact>".htmlentities($tmpval)."</outfact>\n";
        else $data.="<outfact>0</outfact>\n";

     }  //end while 
   
   if ($count == 0)
       {
       $data.="<infact>0</infact>\n";
       $data.="<outfact>0</outfact>\n";       
       }  //end if 
   $data .= "</data>\n";
   return $data;

}  //end function PullBFPerTruck

//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//888888888888888888888888888888888888 MAIN CODE 88888888888888888888888888888888888888888888
//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
   $myconn = odbc_connect('inet dwh my', 'root', '');
   $data = '';
   $query = '';
   
   if (isset($_REQUEST['query']))
     $query = $_REQUEST['query'];
     
     
   switch ($query)
   {
   case 'cities':
     
     if (isset($_REQUEST['state']))
       {
       	$state = $_REQUEST['state'];
        $data = LookupCities($myconn, $state);
       }  //end if 
     break;
      
      
    case 'FT':
      $invtid = '';
      $siteid = '';
      if (isset($_REQUEST['invtid']))
        $invtid = $_REQUEST['invtid'];
      if (isset($_REQUEST['siteid']))
        $siteid = $_REQUEST['siteid'];
      $data = PullBFPerTruck($myconn, $siteid, $invtid);
          
      break;
    }  //end switch
      
   $data = "<xml>\n".$data."</xml>\n";

header("Content-type: text/xml; charset=utf-8");
echo $data;
?>
