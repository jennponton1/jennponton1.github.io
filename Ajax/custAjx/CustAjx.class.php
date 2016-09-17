<?php
/***************************************************************************************
  Function:   getCustomers
  Purpose:    To xml dataset of customer id's (AJAX implementation)
  Called by:  OrdEnt.php:  onkeyup event in custid input box 
  Calls:      
  Input from: partially-filled custid input box
  Output to:  ajx div in OrdEnt.php
***************************************************************************************/
function getCustomers($arr, $resId, $divId, $updateId){      
//array holding form input values, resId = input text where selection will reside 

$db_table    = 'Customer';
$suggestion_limit = 10;


$objResponse = new xajaxResponse();

$option = $arr[$resId].'%';  //what mysql query will look for
          
$adohtwsol = odbc_connect("adohtwsol","","");

$query = "select CustId, LastName from $db_table where CustId like '$option' ";
$result = odbc_exec($adohtwsol,$query);
                
$html = '';
$idx = 1;    //index starts with 1  !!!
$idx2 = 1;

while ($row = odbc_fetch_row($result)) {
   $custname = odbc_result($result,'LastName');
   $slashCust = addslashes($custname);
   
   $divid = $divId.$idx;

   if ($idx == 1){
      $custThis = odbc_result($result,'CustId');
      $html .= "<div id='$divid' style='display: block' class=srs numResults[$idx]='".$custThis."' selectedIndex=$idx>
                <span id='".$custThis."' class=\"srt\"
                onclick=\"tst_CustidMouseClick('$divId', 'custid', '".$custThis."', '".$slashCust."', '$updateId', $idx);\"
                onkeydown=\"tst_onkeydown('$divid', 'custid', '".$custThis."', $idx);\"
                onmouseover=\"tst_onmouseover('$divid', 'custid', '".$custThis."', $idx);\"
                onmouseout=\"tst_onmouseout('$divid', 'custid', '".$custThis."', $idx);\"
                ";
   }  //end if
   else{
      $custThis = odbc_result($result,'CustId');
      $html .= "<div id='$divid' style='display: block' class=sr numResults[$idx]='".$custThis."' selectedIndex=$idx>
                <span id='".$custThis."' class=\"srt\"
                onclick=\"tst_CustidMouseClick('$divId', 'custid', '".$custThis."', '".$slashCust."', '$updateId', $idx);\"
                onkeydown=\"tst_onkeydown('$divid', 'custid', '".$custThis."', $idx);\"
                onmouseover=\"tst_onmouseover('$divid', 'custid', '".$custThis."', $idx);\"
                onmouseout=\"tst_onmouseout('$divid', 'custid', '".$custThis."', $idx);\"
                ";
   }  //end else
   
   $html .= ">".$custThis."</span>
             <span id='".$custThis."' class=\"src\">".$custname."</span></div>";
   $idx2++;
   $idx++;
}

odbc_close($adohtwsol);

$objResponse->addAssign($divId, 'innerHTML', $html);
return $objResponse->getXML();

}  //end function getCustomers
/***************************************************************************************
  Function:   getShipTos
  Purpose:    To xml dataset of address id's (AJAX implementation)
  Called by:  OrdEnt.php:  onkeyup event in ShipTo (for Alternate Ship To) input box 
  Calls:      
  Input from: partially-filled ShipTo input box
  Output to:  ajx div in OrdEnt.php
***************************************************************************************/

function getShipTos($arr, $resId, $div){      
//array holding form input values, resId = input text where selection will reside
    if ($arr[$resId] <> '')  //first, make sure you're looking for SOMETHING
    {     $adohtwsol = odbc_connect("adohtwsol","","");
          $suggestion_limit = 10;
          $option = $arr[$resId].'%';  //what query will look for

                $query = "select addrid, LastName
                                    from address
                                    where addrid like '$option' ";
                $result = odbc_exec($adohtwsol, $query);
                $html = '';
                $idx = 1;    //index starts with 1  !!!


                while ($row = odbc_fetch_row($result)) {
                      $acctname = odbc_result($result,'LastName');
                       $slashAcct = addslashes($acctname);

                       $divid = $div.$idx;

                       if ($idx == 1)
                         {
                         $thisCust = odbc_result($result,'addrid');
                         $html .= "<div id='$divid' style='display:block' class='srs'>
                                   <span id='".$thisCust."' class=\"srt\"
                                   onclick=\"tst_mouseclick('$div', '$resId', '".$thisCust."', '".$slashAcct."', $idx);\"
                                   onkeydown=\"tst_onkeydown('$divid', '$resId', '".$thisCust."', $idx);\"
                                   onmouseover=\"tst_onmouseover('$divid', '$resId', '".$thisCust."', $idx);\"
                                   onmouseout=\"tst_onmouseout('$divid', '$resId', '".$thisCust."', $idx);\"
                                 ";
                         
                         }  //end if
                       else
                         {
                       $html .= "<div id='$divid' style='display:block' class='sr' >
                                 <span id='".$thisCust."' class=\"srt\"
                                 onclick=\"tst_mouseclick('$div', '$resId', '".$thisCust."', '".$slashAcct."', $idx);\"
                                 onkeydown=\"tst_onkeydown('$divid', '$resId', '".$thisCust."', $idx);\"
                                 onmouseover=\"tst_onmouseover('$divid', '$resId', '".$thisCust."', $idx);\"
                                 onmouseout=\"tst_onmouseout('$divid', '$resId', '".$thisCust."', $idx);\"
                                 ";
                         }  //end else
                       $html .= ">".$thisCust."</span>
                                 <span id='".$thisCust."Desc' class=\"src\">".$acctname."</span>
                                 </div>";
                     $idx++;
                     if ($idx > $suggestion_limit)
                       break;
                }   //end while

         odbc_close($adohtwsol);
      	 $objResponse = new xajaxResponse();

         $objResponse->addAssign($div, 'innerHTML', $html);
         return $objResponse->getXML();
   }  //end if 
   
 }  //end function getShipTos
?>
