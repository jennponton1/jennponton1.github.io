<SCRIPT>
var vAppName = navigator.appName;
/***************************************************************************************
  Function:   limitParts
  Purpose:    To limit the part number selection based on user choices
  Called by:  events in DoLineItem.php
  Calls:      n/a
  Input from: vars in DoLineItem.php
  Output to:  
***************************************************************************************/
function limitParts(todo)
{

var stking = document.getElementById('selstking').value;
var firstltr = document.getElementById('fstltr').value;
var drying = document.getElementById('drying').value;
var chemcat = document.getElementById('chemcat').value;
var trtmt   = document.getElementById('trtmt').value;
var siteid  = document.getElementById('siteid').value;

var url; 
var url = "http://"+location.hostname +"/Ajax/partAjx/";

if (stking == '')
  return;
  
if (todo == 'getparts')
  ShowCalculating('prtSel');
    
if ((todo == 'getparts') && (stking == 'STK'))
  url += "LimitParts.php?todo=stkparts&";
if ((todo == 'getparts') && (stking == 'NS'))
  url += "LimitParts.php?todo=nsparts&";
if (todo == 'chemcats')
  {ShowCalculating('chemcat');
  url +=  "LimitParts.php?todo=chemcats&"; 
  }
if (todo == 'trtmts')
  {
  ShowCalculating('trtmt');
  url += "LimitParts.php?todo=trtmts&";   
  }
if ((firstltr != '') && (drying != '') && (chemcat != '') && (trtmt != ''))
  url= url + "siteid="+siteid+"&fstltr="+firstltr+"&drying="+drying+"&chemcat="+chemcat+"&trtmt="+trtmt;
else if ((firstltr != '') && (drying != '') && (chemcat != ''))
  url= url + "siteid="+siteid+"&fstltr="+firstltr+"&drying="+drying+"&chemcat="+chemcat;
else if ((firstltr != '') && (drying != ''))
  url= url + "siteid="+siteid+"&fstltr="+firstltr+"&drying="+drying;  
else 
  return;

  LimitReq = false;
  try
    { LimitReq=new ActiveXObject("Msxml2.XMLHTTP"); }
        catch (e)
	  {  
          try
	          { LimitReq=new ActiveXObject("Microsoft.XMLHTTP"); }
	        catch (e2)
	          { LimitReq=null; }
	   }

  if(!LimitReq && typeof XMLHttpRequest != "undefined")
    LimitReq = new XMLHttpRequest();

  if (LimitReq)
    { 
      LimitReq.onreadystatechange = processLimitsChange;
      LimitReq.open("GET", url, true);
      LimitReq.send(null);
    }  //end if

}  //end function limitParts
function ShowCalculating(OptId)
{
  var opt  = document.getElementById(OptId);
   opt.options.length = 0;  
   
   //leave the blank space
   var newOpt = new Option;
   newOpt.value = '';
   newOpt.text = 'Calculating....';
   opt.options[0] = newOpt;
   
     if (vAppName=="Microsoft Internet Explorer")
     {
     opt.style.visibility = 'visible';
     }  //end if IE
   else
     {
     opt.setAttribute('style', 'visibility:visible;');
     }  //end else not IE
}
/***************************************************************************************
  Function:   processLimitsChange
  Purpose:    To parse XML dataset with selections from user
  Called by:  Returning XML from limitParts function
  Calls:      DoOptionValues, DoPartOptionValues
  Input from: XML Returned from LimitParts.php
  Output to:  DoOptionValues, DoPartOptionValues
***************************************************************************************/
function processLimitsChange()
{  if (LimitReq.readyState == 4)
 {
 if (LimitReq.status == 200)
 {  
   //parse responseXML in order to 
   //return values to the detail line screen
   
   //alert(LimitReq.responseText);
   //return;
   
   var vals = LimitReq.responseXML.getElementsByTagName('updid'); 
      for (var i = 0; i < vals.length; i++)
         var val = vals[i].firstChild.nodeValue;           
   if ((val != 'undefined') && (val != 'prtSel'))
     DoOptionValues(LimitReq.responseXML, val);
   else if ((val != 'undefined') && (val == 'prtSel'))
     DoPartOptionValues(LimitReq.responseXML, val);  
   
 } //end if success
 else
 {
   alert('Failed to process XML Request!!!  Contact Support!!');
 } //end else
 }  //end if readyState = 4 (complete)
}  //end function processLimitsChange
/***************************************************************************************
  Function:   DoOptionValues
  Purpose:    To fill in dynamic option values 
  Called by:  processLimitsChange
  Calls:      n/a
  Input from: vars in DoLineItem.php
  Output to:  
***************************************************************************************/
function DoOptionValues(xmlData, OptionId)
{  var opt  = document.getElementById(OptionId);
   opt.options.length = 0;  
   
   //leave the blank space
   var newOpt = new Option;
   newOpt.value = '';
   newOpt.text = '';
   opt.options[0] = newOpt;
   
   var vals = xmlData.getElementsByTagName(OptionId);
   for (var i = 0; i < vals.length; i++)
     {
       var val = vals[i].firstChild.nodeValue;
       var newOpt = new Option;
       newOpt.value = val;
       newOpt.text = val;
       opt.options[i+1] = newOpt;
       opt.options[0].selected = true;
    }  //end for 
  if (vAppName=="Microsoft Internet Explorer")
     {
     opt.style.visibility = 'visible';
     }  //end if IE
   else
     {
     opt.setAttribute('style', 'visibility:visible;');
     }  //end else not IE
}  //end function DoOptionValues

function DoPartOptionValues(xmlData, OptionId)
{  

   var opt  = document.getElementById(OptionId);
   opt.options.length = 0;  
   
   //leave the blank space
   var newOpt = new Option;
   newOpt.value = '';
   newOpt.text = '';
   opt.options[0] = newOpt;

   var invtids = xmlData.getElementsByTagName(OptionId);
   var descripts = xmlData.getElementsByTagName('prtDesc');
   
   for (var i = 0; i < invtids.length; i++)
     { 
       var invtid = invtids[i].firstChild.nodeValue;
       var descr  = descripts[i].firstChild.nodeValue;
       var newOpt = new Option;
       newOpt.value = invtid;
       newOpt.text = descr;
       opt.options[i+1] = newOpt;
       opt.options[0].selected = true;
    }  //end for 
    
  if (vAppName=="Microsoft Internet Explorer")
     {
     opt.style.visibility = 'visible';
     }  //end if IE
   else
     {
     opt.setAttribute('style', 'visibility:visible;');
     }  //end else not IE
}  //end function DoOptionValues

function StockingOnly()
{
var val = document.getElementById('selstking').value;
if (val == 'NS')
  {
  var opt = document.getElementById('selstking');
  opt.options[0].selected = true;
  alert('Only stocking items are available at this time!');
  return;
  } 
}  //end function StockingOnly

function SelectPart()
{
  var invtid = document.getElementById('prtSel').value;
  if (invtid != '')
    {
    document.getElementById("invtid").value = invtid;
    document.getElementById("invtid").focus(); 
    }   //end if 
}  //end function SelectPart

function getPartHelp()
{ alert('Sorry, this help feature is not yet available!');
  
  //newWin = window.open('AjxPartHlp.php', '_blank', 
  //    "height="+screen.availHeight-100+ ", width = 500, scrollbars=yes, status=yes, left="+(((screen.availwidth)/2)-300)+", top=0, menubar=no, toolbar=no");

}  //end function getPartHelp

function clearSelects()
{  
  var opt = document.getElementById('selstking'); 
  opt.options[0].selected = true;
  
  var opt = document.getElementById('fstltr'); 
  opt.options[0].selected = true;
  
  var opt = document.getElementById('drying');
  opt.options[0].selected = true;
  
  clearSelection('chemcat');
  clearSelection('trtmt');
  clearSelection('prtSel');
}  //end function clearSelects

function clearSelection(SelId)
{
  var opt = document.getElementById(SelId);
  opt.options.length = 0;  
  var newOpt = new Option;
  newOpt.value = '';
  newOpt.text = '';
  opt.options[0] = newOpt;
  
  if (vAppName=="Microsoft Internet Explorer")
     opt.style.visibility = 'hidden';
   else
     opt.setAttribute('style', 'visibility:hidden;');
   
}  //end function clearSelection
</SCRIPT>

<?php
require_once('c:\Inetpub\wwwroot\Ajax\partAjx\PartAjx.class.php');
$siteid = '';
$siteid = $_REQUEST['siteid'];
if ($siteid == '')
  die( "ERROR!!!!  You must include a siteid to use this program!!!");
?>
<BR><B>You can make selections to limit part number choices:</B><BR><BR>
<?
echo "<input type='hidden' id='siteid' name='siteid' value='$siteid'>";      
?>
<TABLE><TR><TH align='left'>Stocking/Nonstocking</TH><TD><select NAME='selstking' id='selstking' 
                                                size='1' onchange='javascript:StockingOnly();'>
                                                <option value = '' SELECTED>&nbsp</OPTION>
                                                <option value='STK'>Stocking</OPTION>
                                                <option value='NS'>NonStocking</OPTION>
                                                </SELECT>
                                                </TD><TD>&nbsp</TD><TD>&nbsp</TD></TR>
     <TR><TH align='left'>Lumber/Plywood: </TH><TD><select NAME='fstltr' id='fstltr' 
                                        SIZE='1' onchange="javascript:limitParts('chemcats');" >
                                        <option value='' SELECTED>&nbsp</option>
                                        <option value='A'>Lumber</option>
                                        <option value='B'>Plywood</option></SELECT>
</TD><TD width=20>&nbsp</TD><TH align='left'>Drying:  </TH><TD><select NAME='drying' id='drying' 
                                        onchange="javascript:limitParts('chemcats');" SIZE='1'>
                                        <option value='' SELECTED>&nbsp</option>
                                        <option value='Y'>Dry</option>
                                        <option value='N'>Wet</option></SELECT>
</TD></TR>
<TR><TH align='left'>Chemical Category: </TH><TD><select NAME='chemcat' id = 'chemcat' 
                                     onchange="javascript:limitParts('trtmts');" size='1' 
                                     style='visibility:hidden'>
                                     <option value='' SELECTED>&nbsp</OPTION>
                                     </SELECT>
</TD><TD width=20>&nbsp</TD><TH align='left'>Treatment:  </TH><TD><select NAME='trtmt' id='trtmt' 
                                     onchange="javascript:limitParts('getparts');" SIZE='1' 
                                     style='visibility:hidden' >
                                     <option value='' SELECTED>&nbsp</OPTION>
                                     </SELECT>
</TD></TR>                                                                   
<TR><TH align='left'>Select Part Description: </TH><TD><select name='prtSel' id='prtSel' onchange=
                                        'javascript:SelectPart();' size='1' 
                                        style='visibility:hidden' >
                                        <option value='' SELECTED>&nbsp</OPTION>
                                        </SELECT>
</TD><TD width=20>&nbsp</TD><TD><A href='javascript:clearSelects();'>Clear Selections</A>
</TD><TD>&nbsp</TD></TR>
<TR><TD>&nbsp</TD></TR>
</TABLE>

<HR color="#008000">

<B>Or, simply enter the part number directly below:</B>
<BR><BR>

<B>Part Nbr:</B>&nbsp&nbsp  <input type=text name='invtid' id='invtid' 
 tabindex='1' autocomplete='off'>
