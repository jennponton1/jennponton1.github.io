<?php /* Smarty version 2.6.13, created on 2013-09-24 11:31:22
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes/views/OrderView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">   
        <title>Order Generation</title>
        <?php echo '
        <style type="text/css">
               html, div {font-size: 80%;}
               html, body {
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
                 overflow-y:auto;
                 text-align:left;
               }
               #tiptip_content {
                 color: rgb(255,255,255);
                 background-color: rgb(28,134,238);
                 font-size: 14px;
               }
               .entrybutton {
                   font-size: 8pt;
                   white-space: nowrap; 
               }
               .entrylabel {
                   font-size: 8pt;
               }
               b {
                   font-size: 8pt;
               }
        </style>
        '; ?>

        <script type="text/javascript" src="views/Order.js"></script>
    </head>
    <body>
    <form action="" method=POST name=OrderView id=OrderView <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <div style="background-color:#eeeeee">
            <div style="background-color:#eeeeee">
                <input type='hidden' name='QuoteNbr' id='QuoteNbr' value=<?php echo $this->_tpl_vars['QuoteNbr']; ?>
>
                <input type='hidden' name='RevNbr' id='RevNbr' value=<?php echo $this->_tpl_vars['RevNbr']; ?>
>
                <input type='hidden' name='Total' id='Total' value=<?php echo $this->_tpl_vars['Total']; ?>
>
                <input type='hidden' name='Site' id='Site' value=<?php echo $this->_tpl_vars['Site']; ?>
>
                <input type='hidden' name='Tso' id='Tso' value=<?php echo $this->_tpl_vars['Tso']; ?>
>
                <input type='hidden' name='Dto' id='Dto' value=<?php echo $this->_tpl_vars['Dto']; ?>
>
                <input type='hidden' name='CustId' id='CustId' value=<?php echo $this->_tpl_vars['Custid']; ?>
>
                <br>
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:7%;"><b>&nbsp;Order Date:</b></td>
                            <td style="width:13%;"><input id="OrdDate" name="OrdDate" type="text" style="width:60%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly" value=<?php echo $this->_tpl_vars['OrdDate']; ?>
></td>
                            <td style="width:6%;"><b>Salesman:</b></td>
                            <td style="width:13%;"><input id="Salesman" name="Salesman" type="text" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly" value=''></td>
                            <td style="width:61%;"></td></tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div style="height: 26%;">
               <div style="width:30%; background-color:#eeeeee; float:left">
                   <table style="width:100%;">
                       <tbody>
                           <tr><td style="width:35%;"><b>&nbsp;Customer:</b></td>
                               <td style="width:65%;"><input id="CustNm" name="CustNm" type="text" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly"></td></tr>
                           <tr><td style="width:35%;"><b>&nbsp;Plant:</b></td>
                               <td style="width:65%;"><input type="text" id="OPlant" name="OPlant" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly"></td></tr>
                           <tr><td style="width:35%;"><b>&nbsp;Ship Via:</b></td>
                               <td style="width:65%;"><input type="text" id="OShipVia" name="OShipVia" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly"></td></tr>
                           <tr><td style="width:35%;"><b>&nbsp;Terms:</b></td>
                               <td style="width:65%;"><input type="text" id="Terms" name="Terms" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly"></td></tr>
                           <?php if ($this->_tpl_vars['Tso'] == 'Y'): ?>
                               <tr><td style="width:35%;"><b>&nbsp;Type:</b></td>
                                   <td style="width:65%;"><input type="text" id="Type" name="Type" style="width:80%; background-color:#dddddd; font-size:12px;" tabindex="-1" readonly="readonly" value="TSO Services Only"></td></tr>
                           <?php endif; ?>
                           <tr><td style="width:35%;"><b>&nbsp;Cust.Order Nbr:</b></td>
                               <td style="width:65%;"><input type="text" id="COrder" name="COrder" tabindex="101" style="width:80%; font-size:12px;" maxlength="15" onblur="javascript: return ismaxlength(this)"></td></tr>
                           <tr><td style="width:35%;"><b>&nbsp;Ship Date:</b></td>
                               <td style="width:65%;"><input type="text" id="SDate" name="SDate" tabindex="102" style="width:40%; font-size:12px;"></td></tr>
                           <?php if ($this->_tpl_vars['Tso'] == 'Y'): ?>
                               <tr><td style="width:35%;"><b>&nbsp;Order Nbr.:</b></td>
                               <td style="width:65%;"><input type="text" id="TOrdnbr" name="TOrdnbr" tabindex="103" style="width:40%; font-size:12px;" maxlength="5" onkeypress="javascript: return isNumberKey(event); return ismaxlength(this)"></td></tr>
                           <?php endif; ?>
                       </tbody>
                   </table>
               </div>
               <div style="width:30%; background-color:#eeeeee; float:left">
                  <table style="width:100%;">
                      <tbody>
                           <tr><td style="width:100%;"><textarea id="ShipAddr" name="ShipAddr" style="width:95%; background-color:#dddddd; font-size:12px;" rows="8" cols="35" tabindex="-1" readonly="readonly"></textarea></td></tr>
                      </tbody>
                  </table>
              </div>
              <div style="width:40%; background-color:#eeeeee; float:left">
                 <table style="width:100%;">
                     <tbody>
                          <tr><td align="right" style="width:20%;"><b>Comments:&nbsp;</b></td>
                              <td style="width:80%;"><textarea id="Instr2" style="width:100%; border:groove;" rows="7" cols="50" tabindex="104" name="Instr2"></textarea></td></tr>
                     </tbody>
                 </table>    
              </div>
            </div>
           <div style="height: 40%;">
              <div style="width:.5%; background-color:#eeeeee; float:left">
              </div>
              <div style="width:99%; background-color:#eeeeee; float:left">
                 <hr>
                 <table id="list4" class="scroll" style="font-size:12px; width:98%;"></table>
                     <hr>
              </div>
              <div style="width:.5%; background-color:#eeeeee; float:left">
              </div>
           </div>
               <table style="width:100%; height:5%;">
                   <tbody>
                        <tr><td style="width:5%;"><button id="OrdSave" type="button" tabindex="105" onClick="javascript:datevalidate()">Save</button></td>
                            <td style="width:6%;"><button id="OrdCancel" type="button" tabindex="106" onClick="javascript:CanDtoOrd()">Cancel</button></td>
                            <td style="color:red; width:89%;"><b><span id="OMsg"></span></b></td></tr>
                   </tbody>
               </table>
    </div>
    </form>
    <script type="text/javascript"> document.getElementById("COrder").focus(); </script>
    </body>
</html>