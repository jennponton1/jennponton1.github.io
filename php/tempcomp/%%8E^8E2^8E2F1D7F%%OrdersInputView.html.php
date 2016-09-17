<?php /* Smarty version 2.6.13, created on 2013-08-06 14:10:14
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Corderentry%5Cordersnew/views/OrdersInputView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <title>Orders</title>
        <link type="text/css" href="/Globals/css/jquery/jquery-ui.css" media="screen" rel="stylesheet">
        <link type="text/css" href="/Globals/css/jquery/ui.jqgrid.css" media="screen" rel="stylesheet">
        <!-- <?php echo ' -->
        <style type="text/css">
               html, div {
                   font-size: 80%;
                   font-family: arial,helvetica;
               }
               html, body{
               margin: 0;
               padding: 0;
               font-size: 85%;
               }
               .ui-dialog-titlebar-close{
                 display: none;
               }
               .ui-dialog-content{
                 font-size:16px;
               }
               .ui-dialog-title{
                 font-size:14px;
                 color:#000;
               }
               .ui-dialog .ui-dialog-buttonpane button {
                 font-size:14px;
               }
               .ui-jqgrid .ui-jqgrid-bdiv {
                 position: relative;
                 margin: 0em;
                 padding:0;
                 overflow-x:hidden;
                 overflow-y:scroll;
                 text-align:left;
               }
               button.entrybutton {
                   font-size:8pt;
                   white-space: nowrap;
               }
               .entrylabel {
                   font-size: 8pt;
                   white-space:nowrap;
               }
               .readonly {
                   width:90%;
                   height:22px;
                   background-color:#dddddd;
                }
                .inputnorm {
                   width:100%;
                   height:22px;
                }
               b {
                   font-size: 10pt;
               }
               hr {
                  margin:0px;
                  padding:0px;
                  clear:both;
               }
               .rightaligned {
                  float:right;
               }
               #header td,
               #header b,
               #header input {
                   font-size:8pt;
                   margin:0px;
                   padding:0px;
               }
               .floattitle {
                 font-size:12px;
                 color:blue;
                 width:60%;
                 border:solid black;
                 border-width:1;
                 background-color:#ffffff;
               }
               textarea {
                 resize: none;
                 font-family: inherit;
                 font-size: 9pt;
               }
        </style>
        <!-- '; ?>
 -->
    <script type="text/javascript" src="/Globals/js/jquery/jquery.js"></script>
    <script type="text/javascript" src="/Globals/js/jquery/jquery-ui.js"></script>
    <script type="text/javascript" src="/Globals/js/jquery/grid.locale-en.js"></script>
    <script type="text/javascript" src="/Globals/js/jquery/jquery.jqGrid.js"></script>
    <script type="text/javascript" src="js/OrdersUtils.js"></script>
    <script type="text/javascript" src="js/shippingAddress.js"></script>
    <script type="text/javascript" src="js/emailaddresses.js"></script>
    <script type="text/javascript" src="js/buildDelivery.js"></script>
    <script type="text/javascript" src="js/buildSugges.js"></script>
    <script type="text/javascript" src="js/OrdersInput.js"></script>
    </head>
    <body>

    <input type='hidden' name='Custid'    id='Custid'    value=<?php echo $this->_tpl_vars['Custid']; ?>
>
    <input type='hidden' name='Ordnbr'    id='Ordnbr'    value=<?php echo $this->_tpl_vars['Ordnbr']; ?>
>
    <input type='hidden' name='Salesman'  id='Salesman'  value=<?php echo $this->_tpl_vars['Salesman']; ?>
>
    <input type='hidden' name='Userid'    id='Userid'    value=<?php echo $this->_tpl_vars['Userid']; ?>
>
    <input type='hidden' name='State'     id='State'>
    <input type='hidden' name='City'      id='City'>
    <input type='hidden' name='Plant'     id='Plant'>

    <div style="background-color:#eeeeee; width:100%; height:97%">
       <div id="Header" style="margin-left:.25%; height:6%; width:99.25%">
          <br>
          <table style="width:100%;">
             <tbody>
                   <tr><td align="right" style="width:5%;"><b>Customer:</b></td>
                       <td style="width:20%;"><input type="text" id="CustName" name="CustName" class="readonly" style="width:100%;" tabindex="500" readonly="readonly"></td>
                       <td style="width:13%;">&nbsp;</td>
                       <td align="right" style="width:6%;"><b>Order Number:</b></td>
                       <td style="width:8%;">
                                  <select id="Order" name="Order" style="width:100%; height:22px; font-size:14px;" tabindex="1">
                                  </select></td>
                       <td align="right" style="width:6%;"><b>Edited by:</b></td>
                       <td style="width:3%;"><input id="CurSlsPer" type="text" class="readonly" style="width:100%;" name="CSlsPer" tabindex="501" readonly="readonly" value=<?php echo $this->_tpl_vars['CSlsPer']; ?>
></td>
                       <td style="width:5%;"><input id="CurDate" type="text" class="readonly" style="width:100%;" name="CurDate" tabindex="502" readonly="readonly" value=<?php echo $this->_tpl_vars['Today']; ?>
></td>
                       <td align="right" style="width:7%;"><b>Sales Person:</b></td>
                       <td style="width:3%;"><input id="SlsPer" type="text" class="readonly" style="width:100%;" name="SlsPer" tabindex="503" readonly="readonly" value=''></td>
                       <td align="right" style="width:7%;"><b>Order Date:</b></td>
                       <td style="width:5%;"><input id="OrderDate" type="text" class="readonly" style="width:100%;" tabindex="504" name="OrderDate" readonly="readonly" value=''></td></tr>
             </tbody>
          </table>
          <hr>
       </div>
       <div style="background-color:#eeeeee; width:100%;" id="textform">
          <div style="width:100%; min-height:20%; max-height:25%" id="Info">
             <div style="margin-left:.25%; width:24.5%; height:19%; border:solid black; border-width:1; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:60%; height:26px" class="floattitle"><span>&nbsp;General</span></td></tr>
                   </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:18%;"><b class="entrylabel" >&nbsp;Email:</b></td>
                             <td style="width:79%;"><input id="Email" name="Email" type="text" maxlength="52" style="width:100%; height:22px; font-size:12;" tabindex="2"></td>
                             <td style="width:3%;"><button id="EmailMore" name="EmailMore" class="entrybutton" type="button" tabindex="3">More</button></td></tr>
                   </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:18%;"><b class="entrylabel" >&nbsp;CustOrdNbr:</b></td>
                             <td style="width:32%;"><input type="text" id="COrdNbr" name="COrdNbr" maxlength="24" style="width:100%; height:22px; font-size:12" tabindex="4"></td>
                             <td align="right" style="width:18%;"><b class="entrylabel" >ShipDate:</b></td>
                             <td style="width:32%;"><input id="ShipDate" style="width:100%; height:22px; font-size:12" tabindex="5" name="ShipDate" type="text" value=''></td></tr>
                   </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:18%;"><b class="entrylabel">&nbsp;TSO:</b></td>
                             <td style="width:32%;"><input type="text" id="Tso" name="Tso" class="readonly" style="width:40%; font-size:12" tabindex="499" readonly="readonly"></td>
                             <td style="width:50%;">&nbsp;</td></tr>
                   </tbody>
                </table>
             </div>
             <div id = "frtblock" style="margin-left:.25%; width:28.5%; border:solid black; border-width:1; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:60%; height:26px" class="floattitle"><span>&nbsp;Freight</span></td></tr>
                  </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:10%;"><b class="entrylabel">ShipVia:</b></td>
                             <td align="right" style="width:40%; height:22px; font-size:12;">
                             <select id="shipvia" style="width:100%; font-size:12;" tabindex="6" name="shipvia" >
                                      <option value="O-TRUCK">O-TRUCK</option>
                                      <option value="RAILCAR">RAILCAR</option>
                                      <option value="CUST-PU">CUST-PU</option>
                             </select></td>
                             <td align="right" style="width:12%;"><b class="entrylabel">&nbsp;Collect:</b></td>
                             <td style="width:6%;"><input type=checkbox name=Collect id=Collect tabindex="7"></td>
                             <td style="width:32%;">&nbsp;</td></tr>
                         <tr><td style="width:10%;"><b class="entrylabel">FOB:</b></td>
                             <td style="width:40%;"><input type="text" id="Fob" name="Fob" class="readonly" style="width:100%; font-size:12" tabindex="558" readonly="readonly"></td></tr>
                         <tr><td style="width:10%;"><b class="entrylabel">Plant:</b></td>
                             <td style="width:40%;"><input type="text" id="PlantDisp" name="PlantDisp" class="readonly" style="width:100%; font-size:12" tabindex="559" readonly="readonly"></td></tr>
                   </tbody>
                </table>
             </div>
             <div style="margin-left:.25%; width:22.5%; border:solid black; border-width:1; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:60%;" class="floattitle"><span>&nbsp;Shipping Address</span><button class="entrybutton rightaligned" id="ShipChg" type="button" tabindex="9">Change</button></td></tr>
                   </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:100%;"><textarea id="ShipAddr" style="width:100%; background-color:#eeeeee; border-width:0;" rows="6" cols="35" tabindex="505" readonly="readonly" name="ShipAddr"></textarea></td></tr>
                   </tbody>
                </table>
             </div>
             <div style="margin-left:.25%; width:22.5%; border:solid black; border-width:1; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:60%; height:26px" class="floattitle"><span>&nbsp;Billing Address</span></td></tr>
                   </tbody>
                </table>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:100%;"><textarea id="CustAddr" style="width:100%; background-color:#eeeeee; border-width:0;" rows="6" cols="35" tabindex="506" readonly="readonly" name="CustAddr"></textarea></td></tr>
                   </tbody>
                </table>
             </div>
          </div>
          <div id="detail" style="height:42%; width:100%">
             <div style="margin-left:.25%; width:99.25%;  height:100%; background-color:#eeeeee;">
                <hr>
                <TABLE id="list" class="scroll" style="font-size:12px;"></TABLE>
             </div>
          </div>
          <div id="action">
             <div class="left" style="margin-left:.25%; width:99.25%; height:6%; background-color:#eeeeee;">
                <hr>
                <table style="width:100%;">
                   <tbody>
                         <tr><td style="width:3%;"><button class="entrybutton" id="ALine" type="button" tabindex="10">Add Line</button></td>
                             <td style="width:3%;"><button class="entrybutton" id="ELine" type="button" tabindex="11">Edit Line</button></td>
                             <td style="width:3%;"><button class="entrybutton" id="ILine" type="button" tabindex="12">Insert Line</button></td>
                             <td style="width:3%;"><button class="entrybutton" id="DLine" type="button" tabindex="13">Delete Line</button></td>
                             <td align="right" style="width:18%; height:22px;">
                             <select id="FType" style="width:65%; font-size:12" tabindex="14" name="FType" >
                                     <option value="0">All Products</option>
                                     <option value="1">Pyro-Guard</option>
                                     <option value="2">Exterior Fire-X</option>
                                     <option value="3">Preservative</option>
                             </select></td>
                             <td align="right" style="width:6%;"><button class="entrybutton" id="DelvdPrcBtn" type="button" tabindex="15">Delivered Prices</button></td>
                             <td align="left" style="width:6%;"><button class="entrybutton" id="FreqBtn" type="button" tabindex="16">Most Frequent</button></td>
                             <td style="width:15%;">&nbsp;</td>
                             <td align="right" style="width:5%; font-size:12px;"><b class="entrylabel">Total BF:</b></td>
                             <td style="width:10%;"><input id="TotBF" type="text" style="width:100%; height:22px; text-align:right; background-color:#dddddd; font-size:12px;" tabindex="507" name="TotBF" readonly="readonly" value='0'></td>
                             <td style="width:2%;">&nbsp;</td>
                             <td align="right" style="width:6%;"><b class="entrylabel">Order Total:</b></td>
                             <td style="width:10%;"><input id="OrdTot" type="text" style="width:100%; height:22px; text-align:right; background-color:#dddddd; font-size:12px;" tabindex="508" name="TOrdTot" readonly="readonly" value='$0.00'></td>
                             <td style="width:2%;">&nbsp;</td>
                             <td style="width:3%;"><button class="entrybutton" id="CLine" type="button" tabindex="18">Copy Line</button></td>
                             <td style="width:3%;"><button class="entrybutton" id="PuLine" type="button" tabindex="19">Paste &Lambda;</button></td>
                             <td style="width:3%;"><button class="entrybutton" id="PdLine" type="button" tabindex="20">Paste V</button></td></tr>
                   </tbody>
                </table>
                <hr>
             </div>
          </div>
          <div id ="header" class="left" style="margin-left:.25%; width:99.25%; background-color:#eeeeee; ">
             <table style="width:100%;">
                <tbody>
                      <tr><td style="width:6%;"><b class="entrylabel">&nbsp;Terms:</b></td>
                          <td style="width:12%;"><input type="text" id="Terms" name="Terms" class="readonly" style="width:90%;" tabindex="509" readonly="readonly"></td>
                          <td style="width:6%;"><b class="entrylabel">&nbsp;Credit Limit:</b></td>
                          <td style="width:8%;"><input type="text" id="CrLmt" name="CrLmt" class="readonly" style="width:70%;" tabindex="510" readonly="readonly"></td>
                          <td style="width:5%;"><b class="entrylabel">&nbsp;Status:</b></td>
                          <td style="width:10%;"><input type="text" id="Status" name="Status" class="readonly" style="width:50%;" tabindex="511" readonly="readonly"></td>
                          <td style="width:53%;">&nbsp;</td></tr>
                </tbody>
             </table>
             <table style="width:100%;">
                <tbody>
                      <tr><td style="width:6%;"><b class="entrylabel">&nbsp;Order Type:</b></td>
                          <td style="width:12%;"><input type="text" id="OrdTyp" name="OrdTyp" class="readonly" style="width:50%;" tabindex="512" readonly="readonly"></td>
                          <td style="width:6%;"><b class="entrylabel">&nbsp;BO Counter:</b></td>
                          <td style="width:8%;"><input type="text" id="BOCntr" name="BOCntr" class="readonly" style="width:50%;" tabindex="513" readonly="readonly"></td>
                          <td style="color:green; font-size: 12px; width:68%;"><b><span id="MsgA"></span></b></td></tr>
                      <tr><td>&nbsp;</td></tr>
                </tbody>
             </table>
          </div>
          <div class="left" id="control" style="margin-left: .25%; width:99.25%; background-color:#eeeeee;">
             <hr>
             <table style="width:100%;">
                <tbody>
                      <tr><td style="width:3%;"><button id="FileSave" class="entrybutton" type="button" tabindex="21">Save</button></td>
                          <td style="width:3%;"><button id="FileNew" class="entrybutton" type="button" tabindex="22">Reset</button></td>
                          <td style="width:3%;"><button id="FileEmail" class="entrybutton" type="button" tabindex="23">Email</button></td>
                          <td style='color:red; font-size: 12px; width:81%;'><b><span id='ErrorMsg'></span></b></td></tr>
                </tbody>
             </table>
          </div>
          <div id="input-dialog" class="modal-dialog">
             <div id="dialog-detail"></div>
          </div>
        </div>
    </div>
    <!-- <?php echo ' -->
    <script type="text/javascript">
    $("#list").setGridWidth($("table:first").width() - 50,true);
    $("#list").setGridWidth($("table:first").width() - 20,false);
    var tmpAr = $("#Info>div");
    var maxHeight = $("#Info").height();
    for (var ndx = 0; ndx < tmpAr.length; ndx++) {
        if ($(tmpAr[ndx]).height()> maxHeight) {
            maxHeight = $(tmpAr[ndx]).height();
        }
    }
    $("#Info").height(maxHeight);
    $("#Info > div").height(maxHeight);
//    document.getElementById("Email").focus(); </script>
    <!-- '; ?>
 -->
    </body>
</html>