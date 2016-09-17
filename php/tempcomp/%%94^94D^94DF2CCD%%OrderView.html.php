<?php /* Smarty version 2.6.13, created on 2012-03-12 09:46:10
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes+-+Copy/views/OrderView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
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
                <br>
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:7%;"><b>&nbsp;Order Date:</b></td>
                            <td style="width:13%;"><input id="OrdDate" name="OrdDate" type="text" style="width:60%; background-color:#dddddd; font-size:12px;" readonly="readonly" value=<?php echo $this->_tpl_vars['OrdDate']; ?>
></td>
                            <td style="width:6%;"><b>Salesman:</b></td>
                            <td style="width:13%;"><input id="Salesman" name="Salesman" type="text" style="width:80%; background-color:#dddddd; font-size:12px;" readonly="readonly" value=''></td>
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
                            <td style="width:65%;"><input id="CustId" name="CustId" type="text" style="width:80%; background-color:#dddddd; font-size:12px;" readonly="readonly"></td></tr>
                        <tr><td style="width:35%;"><b>&nbsp;FOB:</b></td>
                            <td style="width:65%;"><input type="text" id="OFOB" name="OFOB" style="width:80%; background-color:#dddddd; font-size:12px;" readonly="readonly"></td></tr>
                        <tr><td style="width:35%;"><b>&nbsp;Ship Via:</b></td>
                            <td style="width:65%;"><input type="text" id="OShipVia" name="OShipVia" style="width:80%; background-color:#dddddd; font-size:12px;" readonly="readonly"></td></tr>
                        <tr><td style="width:35%;"><b>&nbsp;Terms:</b></td>
                            <td style="width:65%;"><input type="text" id="Terms" name="Terms" style="width:80%; background-color:#dddddd; font-size:12px;" readonly="readonly"></td></tr>
                        <tr><td style="width:35%;"><b>&nbsp;Cust.Order Nbr:</b></td>
                            <td style="width:65%;"><input type="text" id="COrder" name="COrder" tabindex="101" style="width:80%; font-size:12px;"></td></tr>
                        <tr><td style="width:35%;"><b>&nbsp;Ship Date:</b></td>
                            <td style="width:65%;"><input type="text" id="SDate" name="SDate" tabindex="102" style="width:40%; font-size:12px;"></td></tr>
                    </tbody>
                </table>
            </div>
            <div style="width:30%; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:100%;"><textarea id="ShipAddr" name="ShipAddr" style="width:95%; background-color:#dddddd; font-size:12px;" rows="8" cols="35" readonly="readonly"></textarea></td></tr>
                    </tbody>
                </table>
            </div>
            <div style="width:40%; background-color:#eeeeee; float:left">
            </div>
</div>
        <div style="height: 40%; ">
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
                <table style="width:100%; height=10%;">
                    <tbody>
                        <tr><td style="width:4%;"><button id="OrdSave" type="button" tabindex="103" onClick="javascript:datevalidate()">Save</button></td>
                            <td style="width:5%;"><button id="OrdCancel" type="button" tabindex="104" onClick="javascript:setCanVal(2)">Cancel</button></td>
                            <td style="color:red; width:91%;"><b><span id="OMsg"></span></b></td></tr>
                   </tbody>
              </table>     
        </div>
        </form>
      <script type="text/javascript"> document.getElementById("COrder").focus(); </script>
</body>
</html>