<?php
/***************************************************************************************
  Function:   getParts
  Purpose:    To dynamically build a select list for user choice (this one's for 
              Part Numbers)
  Called by:  onkeyup event in Ajx.js
  Calls:      
  Input from: partially-filled input text box
              $arr = string with all request vars from calling form
              $resId = input id from which ajax component will be reading 
              $divId = id of div that will display results
              $updateId = id of div you may want to update
  Output to:  ajx div
***************************************************************************************/
function getParts($arr, $resId, $divId, $updateId){      

$suggestion_limit = 40;

$objResponse = new xajaxResponse();

$option = '%'.$arr[$resId].'%';  //what mysql query will look for
$option = str_replace('*', '%', $option);  //so users can use a *

$query = makeQuery($arr, $option);

$adohtwsol = odbc_connect("adohtwsol","","");   
$result = odbc_exec($adohtwsol,$query);
                
$html = '';
$idx = 1;    //index starts with 1  !!!
                                   
while (odbc_fetch_row($result)) {
   $descr = odbc_result($result,'descr');
   $slashDescr = htmlentities($descr);
   
   $divid = $divId.$idx;

   if ($idx == 1){
      $thisInvtid = odbc_result($result,'invtid');
      $html .= "<div id='$divid' style='display: block' class=srs numResults[$idx]='".$thisInvtid."' selectedIndex=$idx>
                <span id='".$thisInvtid."' class=\"srt\"
                onclick=\"tst_mouseclick('$divId', '$resId', '".$thisInvtid."',  $idx);\"
                onkeydown=\"tst_onkeydown('$divid', '$resId', '".$thisInvtid."', $idx);\"
                onmouseover=\"tst_onmouseover('$divid', '$resId', '".$thisInvtid."', $idx);\"
                onmouseout=\"tst_onmouseout('$divid', '$resId', '".$thisInvtid."', $idx);\"
                ";
   }  //end if
   else{
      $thisInvtid = odbc_result($result,'invtid');
      $html .= "<div id='$divid' style='display: block' class=sr numResults[$idx]='".$thisInvtid."' selectedIndex=$idx>
                <span id='".$thisInvtid."' class=\"srt\"
                onclick=\"tst_mouseclick('$divId', '$resId', '".$thisInvtid."', $idx);\"
                onkeydown=\"tst_onkeydown('$divid', '$resId', '".$thisInvtid."', $idx);\"
                onmouseover=\"tst_onmouseover('$divid', '$resId', '".$thisInvtid."', $idx);\"
                onmouseout=\"tst_onmouseout('$divid', '$resId', '".$thisInvtid."', $idx);\"
                ";
   }  //end else
  $html .= ">".$thisInvtid."</span>
             <span id='".$thisInvtid."' class=\"src\">".$descr."</span></div>";

   $idx++;
   if ($idx > $suggestion_limit)
                       break;
}

odbc_close($adohtwsol);

$objResponse->addAssign($divId, 'innerHTML', $html);
return $objResponse->getXML();

}  //end function getCustomers

function makeQuery($arr, $option)
{
  $sql = '';
  
  //first, get any selections user has already chosen:
  $stockingOnly = false;
  $nsOnly = false;

  if (isset($arr['selstking']))
    {
    if ($arr['selstking'] == 'STK')
        $stockingOnly = true;
    else if ($arr['selstking'] == 'NS')
        $nsOnly = true;     
    }  //end if   
  //if selstking = NS (different query for that)
  
  $siteid = '';
  if (($stockingOnly) || ($nsOnly))
    {  if (isset($arr['siteid']))
         $siteid = $arr['siteid'];
    }  //end if     
  
  $firstLetter = '';
  if (isset($arr['fstltr']))
    $firstLetter = $arr['fstltr'];
    
  $drying = '';
  if (isset($arr['drying']))
    $drying = $arr['drying'];
  
  $chemcat = '';
  if (isset($arr['chemcat']))
    $chemcat = $arr['chemcat'];
  
  $trtmt = '';
  if (isset($arr['trtmt']))
    $trtmt = $arr['trtmt'];
  
  //now, determine what files to pull from:  
  $files = array();
  $files[] = 'invntory';  
  if ($stockingOnly)
    $files[] = 'htstklvl';
  if (($firstLetter != '') || ($drying != '') || ($chemcat != '') || ($trtmt != ''))
    $files[] = 'htinprod';
  if ($nsOnly)
    $files[] = 'nshtstklvl';  
    
  $filelist = '';  
  if (in_array('htstklvl', $files) && (in_array('htinprod', $files)))
    $filelist = 'BOTH';
  else if (in_array('htstklvl', $files) && (!in_array('htinprod', $files)))
    $filelist = 'HTSTKLVL';
  else if (!in_array('htstklvl', $files) && (in_array('htinprod', $files)))
    $filelist = 'HTINPROD';

  else if (in_array('nshtstklvl', $files) && (in_array('htinprod', $files)))
    $filelist = 'BOTHNS';
  else if (in_array('nshtstklvl', $files) && (!in_array('htinprod', $files)))
    $filelist = 'NSHTSTKLVL';
  else if (!in_array('nshtstklvl', $files) && (in_array('htinprod', $files)))
    $filelist = 'HTINPROD';
    
  else
    $filelist = 'INVNTORY';
   
  $temp = '';  
  switch ($filelist)      
    {  case "BOTH":
          $sql = "Select distinct invtid, descr from htinprod h, invntory i, 
                  htstklvl l where i.classid = h.prodcat and 
                  i.invtid = l.invtid and 
                  l.siteid = '$siteid' and invtid like '$option' ";
           break;
        case "HTSTKLVL":
           $sql = "Select distinct invtid, descr from invntory i, htstklvl l 
                   where i.invtid = l.invtid and 
                   l.siteid = '$siteid' and invtid like '$option' ";
           break;        
        case "HTINPROD":                     
          $sql = "select distinct invtid, descr from htinprod h, invntory i 
                  where i.classid = h.prodcat and invtid like '$option' ";
          break;
        case "BOTHNS":  
          $sql = "select distinct invtid, descr from htinprod h, invntory i 
                  where i.classid = h.prodcat ";
          $temp = " and invtid not in (select distinct invtid from htinprod h, 
                     invntory i, htstklvl l where i.invtid = l.invtid and 
                     l.siteid = '$siteid') and invtid like '$option' ";
          break;
        case "NSHTSTKLVL":
          $sql = "select distinct invtid, descr from invntory where invtid not in
                  (select distinct invtid from htstklvl where siteid = '$siteid' ) 
                  and invtid like '$option' ";
          break;        
       default:
          $sql = "select distinct invtid, descr from invntory where invtid like '$option' ";                 
    }  //end switch
    
      
   if ($firstLetter != '')
     {
     if ($firstLetter == 'A')
       $cat2 = "Lbr";
     else if ($firstLetter == 'B')
       $cat2 = "Ply";
     $sql .= " and cat2 = '$cat2' ";    
     }  //end if firstLetter is set
     
   if ($drying != '')
     {
     if ($drying == 'Y')
       $sql .= " and drying > 0 ";
     else
       $sql .= " and drying = 0 ";  
     } //end if drying isset  
    
   if ($chemcat != '')
     $sql .= " and chemcat = '$chemcat' ";
      
   if ($trtmt != '')
     $sql .= " and prodcat = '$trtmt' ";
     
   $sql .= " order by descr ";
     
  return $sql;
  
}  //end function makeQuery


?>
