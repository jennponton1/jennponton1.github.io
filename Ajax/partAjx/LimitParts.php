<?php
/*******************************************************************************************
  Program:     LimitParts.php
  Purpose:     To limit the part selection based on user choices 
  Written by:  Ann Jackson
  Date:        March 28, 2006
  Input from:  DoLineItem.php
  Output to:   xml dataset
*********************************************************************************************/

function PullChemcats(&$data)
{
  $siteid = '';
  $fstltr = '';
  $drying = '';
  if (isset($_REQUEST['siteid']))
    $siteid = $_REQUEST['siteid'];
    
  if (isset($_REQUEST['fstltr']))
    $fstltr = $_REQUEST['fstltr'];
    
  if (isset($_REQUEST['drying']))
    $drying = $_REQUEST['drying'];
    
  if ($siteid == '')
    return;   
   
  $conn = odbc_connect('adohtwsol', '', '');
  if ($fstltr == 'A')
    $cat2 = 'Lbr';
  else if ($fstltr == 'B')
    $cat2 = 'Ply';
    
  $sql = "select distinct chemcat from htinprod where cat2 = '$cat2'";
  if ($drying == 'Y')
    $sql .= " and drying > 0 ";
  else if ($drying == 'N')
    $sql .= " and drying = 0 ";
  $sql .= "order by chemcat ";
  
  $ds = odbc_exec($conn, $sql);
  
  $data = "<data>\n";
  
  while (odbc_fetch_row($ds))
  {
    $data .= "<updid>chemcat</updid>\n";
    $data .= "<chemcat>".htmlentities(odbc_result($ds, 'chemcat'))."</chemcat>\n";
  }  //end while 
      
  $data .= "</data>\n";
}

function PullTreatments(&$data)
{
  $siteid = '';
  $fstltr = '';
  $drying = '';
  $chemcat = '';
  
  if (isset($_REQUEST['siteid']))
    $siteid = $_REQUEST['siteid'];
    
  if (isset($_REQUEST['fstltr']))
    $fstltr = $_REQUEST['fstltr'];
    
  if (isset($_REQUEST['drying']))
    $drying = $_REQUEST['drying'];
  
  if (isset($_REQUEST['chemcat']))
    $chemcat = $_REQUEST['chemcat'];
    
  if ($siteid == '')
    return;   

  $conn = odbc_connect('adohtwsol', '', '');
  if ($fstltr == 'A')
    $cat2 = 'Lbr';
  else if ($fstltr == 'B')
    $cat2 = 'Ply';
    
  $sql = "select distinct prodcat from htinprod where chemcat = '$chemcat' and 
          cat2 = '$cat2'";
  if ($drying == 'Y')
    $sql .= " and drying > 0 ";
  else if ($drying == 'N')
    $sql .= " and drying = 0 ";
  $sql .= "order by prodcat ";
  
  $ds = odbc_exec($conn, $sql);
  
  $data = "<data>\n";
  
  while (odbc_fetch_row($ds))
  {
    $data .= "<updid>trtmt</updid>\n";
    $data .= "<trtmt>".htmlentities(odbc_result($ds, 'prodcat'))."</trtmt>\n";
  }  //end while 
      
  $data .= "</data>\n";

}  //end function PullTreatments

function PullStockingParts(&$data)
{ 
  $siteid = '';
  $fstltr = '';
  $drying = '';
  $chemcat = '';
  $trtmt = '';
  
  if (isset($_REQUEST['siteid']))
    $siteid = $_REQUEST['siteid'];
    
  if (isset($_REQUEST['fstltr']))
    $fstltr = $_REQUEST['fstltr'];
    
  if (isset($_REQUEST['drying']))
    $drying = $_REQUEST['drying'];
    
  if (isset($_REQUEST['chemcat']))
    $chemcat = $_REQUEST['chemcat'];
    
  if (isset($_REQUEST['trtmt']))
    $trtmt = $_REQUEST['trtmt'];

  if (($siteid == '') || ($trtmt == ''))
    return;   
    
   $sql = "Select distinct invtid, descr from htinprod h, invntory i, htstklvl l 
           where i.classid = h.prodcat and
           i.invtid = l.invtid and 
           l.siteid = '$siteid' and  
           prodcat = '$trtmt' 
           order by descr";
           
  $conn = odbc_connect('adohtwsol', '', '');         
  $ds = odbc_exec($conn, $sql);
  
  $data = "<data>\n";
  
  $counter = 0;
  while (odbc_fetch_row($ds))
  {
    $data .= "<updid>prtSel</updid>\n";
    $data .= "<prtSel>".htmlentities(odbc_result($ds, 'invtid'))."</prtSel>\n";
    $data .= "<prtDesc>".htmlentities(odbc_result($ds, 'descr'))."</prtDesc>\n";
    $counter ++;
  }  //end while 
      
  if ($counter == 0)
    {
    $data .= "<updid>prtSel</updid>\n";
    $data .= "<prtSel>".htmlentities('No items avail for selections')."</prtSel>\n";
    $data .= "<prtDesc>".htmlentities('No items avail for selections')."</prtDesc>\n";
    }  //end if     
  $data .= "</data>\n";

}  //end function PullStockingParts

function PullNonstockingParts(&$data)
{
  $siteid = '';
  $fstltr = '';
  $drying = '';
  $chemcat = '';
  $trtmt = '';
  
  if (isset($_REQUEST['siteid']))
    $siteid = $_REQUEST['siteid'];
    
  if (isset($_REQUEST['fstltr']))
    $fstltr = $_REQUEST['fstltr'];
    
  if (isset($_REQUEST['drying']))
    $drying = $_REQUEST['drying'];
    
  if (isset($_REQUEST['chemcat']))
    $chemcat = $_REQUEST['chemcat'];
    
  if (isset($_REQUEST['trtmt']))
    $trtmt = $_REQUEST['trtmt'];
    
  if ($siteid == '')
    return;   
   
   $sql = "Select distinct invtid from htinprod h, invntory i
           where i.classid = h.prodcat and prodcat = '$trtmt' and 
           invtid not in 
           ( Select distinct invtid from htinprod h, invntory i, htstklvl l 
             where i.invtid = l.invtid and 
           l.siteid = '$siteid' and  
           prodcat = '$trtmt' )
           order by invtid ";
 
  $conn = odbc_connect('adohtwsol', '', '');         
  $ds = odbc_exec($conn, $sql);
  
  $data = "<data>\n";
  
  $counter = 0;
  while (odbc_fetch_row($ds))
  {
    $data .= "<updid>prtSel</updid>\n";
    $data .= "<prtSel>".htmlentities(odbc_result($ds, 'invtid'))."</prtSel>\n";
    $counter ++;
  }  //end while 
      
  if ($counter == 0)
    {
    $data .= "<updid>prtSel</updid>\n";
    $data .= "<prtSel>".htmlentities('No items avail for selections')."</prtSel>\n";
    $data .= "<prtDesc>".htmlentities('No items avail for selections')."</prtDesc>\n";
    }  //end if     
  $data .= "</data>\n";

}  //end function PullNonstockingParts


header("Content-type: text/xml; charset=utf-8");

$todo = $_REQUEST['todo'];
$data = '';

switch ($todo)
  {
    case 'chemcats':
      PullChemcats($data);
      break;
    case 'trtmts':
      PullTreatments($data);
      break;
    case 'stkparts':
      PullStockingParts($data);
      break;
    case 'nsparts':
      PullNonstockingParts($data);
      break;      
  }  //end switch
  
echo $data;
  
?>
