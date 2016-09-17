/***************************************************************************************
  File:       CustAjx.js
  Purpose:    javascript functions to handle OrderEntry ajax events
  Called by:  Various, specifically OrdEnt.php
  Output to:  OrdEnt.php form event handlers
***************************************************************************************/

/***************************************************************************************
  Function:   tst_onkeyup
  Purpose:    To call appropriate action on the onkeyup event
  Called by:  Various programs using customer ajax 
  Calls:      getCustomers or getShipTos in CustAjx.class.php
  Input from: ev = event
              FormID = calling form's ID
              DivId = Div ID for results to display
              InputID = which input object to read from
              UpdateID = input ID of object that will be updated 
              (ie: customername gets updated when customer is chosen)
              idx = index for possibility of >1 retuning div object
  Output to:  screen
***************************************************************************************/
function tst_onkeyup(ev, FormId, DivId, InputID, UpdateID, idx)
{
  key =  ev.keyCode;
  FindDiv = document.getElementById(DivId);
  divs = document.getElementsByTagName('div');
  
  var inputVal = document.getElementById(InputID).value;
  
  var inputLen = inputVal.length;
  if (inputLen > 0)
    FindDiv.style.display = 'block';

  NewDiv = false;

  switch (key) {
    case 9:  //tab
      return false;
      break;
    case 27: // escape
      tst_emptyresults(DivId);
      return false;
      break;
    case 13:  //carriage return
      tst_DoReturn(DivId);
      return false;
      break;
    case 38: // up arrow
      tst_DoUpArrow(DivId);
      return false;
      break;
    case 40: // down arrow
      tst_DoDownArrow(DivId);
      return false;
      break;
    default:  //this can be modified to call whatever functions you need from the main php page
      if (InputID == 'custid')
        {
        waitID = setTimeout("void(0);",750);
        var custid = document.getElementById('custid').value;
        if (custid.length < 6)
          def =  xajax_getCustomers(xajax.getFormValues(FormId), InputID, DivId, UpdateID);
        }  //end if 
      else if (InputID == 'ShipTo')
        {
        //alert('getting shiptos for '+key);
        waitID = setTimeout("void(0);", 1000);
        def =  xajax_getShipTos(xajax.getFormValues(FormId), InputID, DivId);
         }  //end else        
       else if (InputID == 'invtid')
         {
         waitID = setTimeout("void(0);", 1000);
         def =  xajax_getParts(xajax.getFormValues(FormId), InputID, DivId, UpdateID);
         }  
       //set focus on first item in results;
       
  }  //end switch
}  //end function tst_onkeyup

//User selected customer, put approp val in custname and clear box
function tst_CustidMouseClick(DivId, ResId, val, custName, UpdateID, idx)

{   //alert('doing custid mouse click');
    elt = document.getElementById(DivId);
    qElt = document.getElementById(ResId);
    qElt.value = val;
    document.getElementById(UpdateID).value = custName;
    //force focus on ResId(custid), then focus on UpdateID(custname) so the 
    //onblur for ResId will fire
    qElt.focus();
    document.getElementById(UpdateID).focus();
    tst_emptyresults(elt);
}

function tst_mouseclick(DivId, ResId, val, idx)
{   //alert('tst mouseclick');
    elt = document.getElementById(DivId);
    qElt = document.getElementById(ResId);

    qElt.value = val;
    tst_emptyresults(elt);
}


function tst_emptyresults(DivId)  //clear box:
{   if (!DivId) return;
    divs = document.getElementsByTagName('div');
    var HideId = DivId.id;

    var i = 0;

    for (i=0; i<divs.length; i++)
    {
      if (divs[i].id == HideId)
         {
         divs[i].innerHTML = '';
         divs[i].style.display = 'none';
         }  //end if  
    }  //end for
}

function tst_onmouseover(DivId, InputId, CurSel, idx)   //highlight selection
{
     var divs  = document.getElementsByTagName('div');
     var j = 0;

     for (j=0; j<divs.length; j++)
     {  var tmpId = divs[j].id;
        if (tmpId.substr(0, 3) == 'ajx')
        {
        if (divs[j].id == DivId)  //found correct Div
          divs[j].className = 'srs';
        else
          divs[j].className = 'sr';
        }  //end if ajx
     } //end for j

}   //end function tst_onmouseover

//unhightlight selection:
function tst_onmouseout(DivId, InputId, CurSel, idx)   
{
     var divs  = document.getElementsByTagName('div');
     var j = 0;

     for (j=0; j<divs.length; j++)
         {
         var tmpId = divs[j].id;
         if (tmpId.substr(0, 3) == 'ajx')
           divs[j].className = 'sr';
         }  //end for 
}  //end function onmouseout


function tst_highlight(DivId)
{   
    divs = document.getElementsByTagName('div');
    //divs = document.getElementById(DivId.id);
    if (!DivId)
      {
      DivId = DivId + '1';
      DivId = document.getElementById(DivId);
      }  //end if

        for (i=0; i<divs.length; i++)
            {
              var tmpId = divs[i].id;
              //only apply classes to divs that begin with ajx
              if (tmpId.substr(0, 3) == 'ajx')  
              {
              if (divs[i].id == DivId.id)
                {
                 divs[i].className='srs';
                }
              else
                {
                 divs[i].className = 'sr';
                 
                }  //end else  
               }  //end if divid starts with ajx
            }  //end for
}  //end function tst_highlight

function tst_DoReturn(DivId)
{      var NewDiv = false;
      //first, find the Div you just clicked on:
      //alert('doing return');
      var len = DivId.length;
        for (j=0; j<divs.length; j++)
           {  var currentId = divs[j].id;
              currentId = currentId.substr(0, len);
              if ((divs[j].className == 'srs') && (currentId == DivId) && (!NewDiv))  //you found it!
             {
              idx = divs[j].id;
              idx = idx.substr(len, 99);
              FindMe = DivId + idx;
              NewDiv = document.getElementById(FindMe);
             }  //end if
           }  //end for

           //Now, get it's children:
           if (NewDiv)
           {
            var inner = NewDiv.childNodes;

            for (i=0; i<inner.length; i++)
              {
              var firethis = inner[i];
              var firethisid = inner[i].id;

              //this will have to be modified if you have > 1 onclick event in the DivId div:
              if (firethisid)   //if the firethis actually HAS an id
                firethis.onclick();    //throws an error, but works
                
              }  //end for
           }  //end if NewDiv
}  //end function tst_DoReturn

function tst_DoUpArrow(DivId)
{     var NewDiv = false;

      var len = DivId.length;
        for (j=0; j<divs.length; j++)
           {  var currentId = divs[j].id;
              currentId = currentId.substr(0, len);
              if ((divs[j].className == 'srs') && (currentId == DivId) && (!NewDiv))
             {
              //get the previous div:
              idx = divs[j].id;
              idx = idx.substr(len, 99);
              idx--;
              FindMe = DivId + idx;
              NewDiv = document.getElementById(FindMe);
              if (NewDiv)
               DivId = NewDiv;
             }  //end if
           }  //end for
      tst_highlight(DivId);

}  //end function tst_DoUpArrow

function tst_DoDownArrow(DivId)
{ 
  var NewDiv = false;
   var len = DivId.length;
   var idx = 'unk';
   
        for (j=0; j<divs.length; j++)
           {  var currentId = divs[j].id;
              currentId = currentId.substr(0, len);
              if ((divs[j].className == 'srs') && (currentId == DivId) && (!NewDiv))
             {
              //get the next div:
              idx = divs[j].id;
              idx = idx.substr(len, 99);
              idx++;
              FindMe = DivId + idx;
              NewDiv = document.getElementById(FindMe);
              if (NewDiv)
               DivId = NewDiv;
             }  //end if
           }  //end for
        tst_highlight(DivId);

}  //end function tst_DoDownArrow






