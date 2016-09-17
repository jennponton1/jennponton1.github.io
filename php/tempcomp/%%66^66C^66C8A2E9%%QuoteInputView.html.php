<?php /* Smarty version 2.6.13, created on 2014-10-14 15:40:40
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotesorig/views/QuoteInputView.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <title>Quotes</title>

        <link type="text/css" href="/Globals/css/jquery/tipTip.css" media="screen" rel="stylesheet">
        <link type="text/css" href="/Globals/css/jquery/jquery-ui.css" media="screen" rel="stylesheet">
        <link type="text/css" href="/Globals/css/jquery/ui.jqgrid.css" media="screen" rel="stylesheet">

        <!-- <?php echo ' -->
        <style type="text/css">
            html, div {
                font-size: 80%;
                font-family: arial,helvetica;
            }
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
                overflow-y:scroll;
                text-align:left;
            }

            #tiptip_content {
                color: rgb(255,255,255);
                background-color: rgb(28,134,238);
                font-size: 14px;
            }

            .ui-widget .entrybutton {
                font-size:8pt;
                white-space: nowrap;
            }

            .ui-tabs{
                font-size:6pt;
            }


            .entrybutton {
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
                float: right;
            }
            .label_right_align {
                text-align: right;
            }
            #header td,
            #header b,
            #header input {
                font-size: 8pt;
                margin:0px;
                padding:0px;
            }
            .floattitle {
                font-size:12px;
                color:blue;
                width:60%;
                border:solid black;
                border-width: 1px;
                background-color:#ffffff;
            }
            textarea {
                resize: none;
                font-family: inherit;
                font-size: 9pt;
            }
            #statusMessages {
                padding: 10px 20px 50px 10px;
                font-size: large;
            }
            #frtboxTbl {            
                width:100%;

                font-size:14px;
                font-family:Times,serif
            }
            img.tool {
                vertical-align: top;
                border: 0;
                height: 22px;
                width: 22px;
            }
                    
            #Header{
                margin-left:.25%;
                height:6%;
                width:99.25%;
            }
            
            #hdrTable{
                width:100%;
            }
            
            #mainBodyContent{
                background-color:#eeeeee;
                width:100%;
                height:97%;
            }
</style>
        <!--'; ?>
 -->


        <script type="text/javascript" src="/Globals/js/jquery/jquery.js"></script>
        <script type="text/javascript" src="/Globals/js/jquery/jquery-ui.js"></script>
        <script type="text/javascript" src="/Globals/js/jquery/grid.locale-en.js"></script>
        <script type="text/javascript" src="/Globals/js/jquery/jquery.jqGrid.js"></script>
        <script type="text/javascript" src="/Globals/js/jquery/jquery.tipTip.js"></script>
        <script type="text/javascript" src="/Globals/js/contrib/accounting.js"></script>
        <script type="text/javascript" src="js/utils.js"></script>
        <script type="text/javascript" src="js/gridManager.js"></script>
        <script type="text/javascript" src="js/shippingAddress.js"></script>
        <script type="text/javascript" src="js/quoteEmail.js"></script>
        <script type="text/javascript" src="js/QuoteInput.js"></script>
        <script type="text/javascript" src="js/emailAddresses.js"></script>
        <script type='text/javascript' src='js/detailEdit.js'></script>
        <script type='text/javascript' src='js/quoteConfirm.js'></script>
        <script type='text/javascript' src='js/buildOrder.js'></script>
        <!--<link type='text/css' href="/globals/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
        <script type='text/javascript' src='/globals/js/bootstrap/bootstrap.min.js'></script>-->
        <!--<script type="text/javascript" src="js/oldJS.js?v=<?php echo time(); ?>
"></script>-->

    </head>
    <body>
        <form action="" method=POST name=QuoteInputView id=QuoteInputView <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
            <input type='hidden' name='Reason'   id='Reason'   value="0">
            <input type='hidden' name='inetuser' id='inetuser' value='<?php echo $this->_tpl_vars['inetuser']; ?>
'>
            <input type='hidden' name='ShipVia'  id='ShipVia'  value="O-TRUCK">
            <input type='hidden' name='Siteid'   id='Siteid'>
            <input type='hidden' name='AltEmail' id='AltEmail'>
            <input type='hidden' name='Altused'  id='Altused'>
            <input type='hidden' name='Altid'    id='Altid'    value="0">
            <input type='hidden' name='Altlname' id='Altlname' value="">
            <input type='hidden' name='Altfname' id='Altfname' value="">
            <input type='hidden' name='Altaddr1' id='Altaddr1' value="">
            <input type='hidden' name='Altaddr2' id='Altaddr2' value="">
            <input type='hidden' name='Altcity'  id='Altcity'  value="">
            <input type='hidden' name='Altstate' id='Altstate' value="">
            <input type='hidden' name='Altzip'   id='Altzip'   value="">
            <input type='hidden' name='Altphone' id='Altphone' value="">
            <input type='hidden' name='Altfax'   id='Altfax'   value="">
            <input type='hidden' name='AdjFt'    id='AdjFt'>
            <input type='hidden' name='Custid'   id='Custid'   value=<?php echo $this->_tpl_vars['Custid']; ?>
>
            <input type='hidden' name='ACustid'  id='ACustid'>
            <input type='hidden' name='ViewOnly' id='ViewOnly' value=<?php echo $this->_tpl_vars['ViewOnly']; ?>
>
            <div id="mainBodyContent" >
                <div id="Header" >
                    <br>
                    <table id="hdrTable" >
                        <tbody>
                            <tr><td style="width:9%;"><b>&nbsp;Quote Number:</b></td>
                                <td style="width:6%;"><input id="QuoteNbr" type="text" style="width:100%; background-color:#dddddd;" name="QuoteNbr" tabindex="40" readonly="readonly" value=<?php echo $this->_tpl_vars['QuoteNbr']; ?>
></td>
                                <td style="width:4%;"><input id="RevNbr" type="text" style="background-color:#dddddd;" size="3" maxlength="3" name="RevNbr" tabindex="-1" readonly="readonly" value=''></td>
                                <td style="width:11%;"><button class="entrybutton" id="UpdateCost" type="button" tabindex="41" >Update Pricing</button>
                                    <a> <img alt="help" src="/graphics/Help.png" id="cust_help1" class="tool" 
                                             title="Use this button to update treatment and wood costs on older quotes to current values. Values that have zeros stored on file are
                                             treated as custom entries and are not affected."></a></td>
                                <td style="width:18%;"><b>Retrieve Quotes:</b>
                                    <select id="RptType" tabindex="42" name="RptType" >
                                        <option value="0">Select Option</option>
                                        <option value="1">By Salesman</option>
                                        <option value="2">By Customer</option>
                                        <option value="3">All Open</option>
                                    </select>
                                </td>
                                <td style="width: 10%">
                                    <button class="entrybutton" id='btnOpenOrders' type="button">
                                        Customer's Open Orders
                                    </button>
                                </td>
                                <td style="text-align: right; width:8%;"><b>Salesperson:</b></td>
                                <td style="width:4%;"><input id="SlsPer" type="text" style="width:90%; background-color:#dddddd;" name="SlsPer" tabindex="-1" readonly="readonly" value=<?php echo $this->_tpl_vars['Slsper']; ?>
></td>
                                <td style="text-align: right; width:9%;"><b>Revision Date:</b></td>
                                <td style="width:7%;"><input id="RevDate" type="text" style="width:100%; background-color:#dddddd;" tabindex="-1" name="RevDate" readonly="readonly"></td>
                                <td style="text-align: right; width:7%;"><b>Quote Date:</b></td>
                                <td style="width:7%;"><input id="IssueDate" type="text" style="width:95%; background-color:#dddddd;" tabindex="-1" name="IssueDate" readonly="readonly" value=<?php echo $this->_tpl_vars['QDate']; ?>
></td></tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
                <div style="width:100%;" id="textform">
                    <div style="width:100%; min-height:20%; max-height:25%" id="Info">

                        <div style="margin-left:.25%; width:24.5%; height:22%; border:solid black; border-width:1px; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:60%; height:26px" class="floattitle"><span>&nbsp;General</span></td></tr>
                                </tbody>
                            </table>

                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:15%;"><b>&nbsp;Contact:</b></td>
                                        <td style="width:85%;"><input type="text" id="Contact" name="Contact" maxlength="24" style="width:100%;" tabindex="2"></td>
                                        <td></td>
                                    </tr>
                                    <tr><td style="width:15%;"><b>&nbsp;Email:</b></td>
                                        <td style="width:85%;"><input type="text" id="Email" maxlength="52" name="Email" style="width:100%;" tabindex="3"></td>
                                        <td style="text-align: right; color:red; width:50%;"><span id="More"></span>
                                            <button class="entrybutton" type="button" id="EmailMore" name="EmailMore" tabindex="5" >Adtl.Email</button></td>
                                    </tr>
                                    <tr><td style="width:15%;"><b>&nbsp;TSO:</b></td>
                                        <td style="width:25%;"><input type=checkbox name=TsoInd id=TsoInd tabindex="4">&nbsp;&nbsp;&nbsp;
                                            <a> <img alt="help" src="/graphics/Help.png" id="cust_help2" class="tool" 
                                                     title="Check box to signal that this quote is for treatment services only (TSO). Wood costs are not accepted."></a></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="width:20%;"><b>&nbsp;Follow Up:</b></td>
                                        <td style="width:14%;"><input id="FollowUp" style="width:100%;" tabindex="32" name="FollowUp" type="text" value=''></td>
                                        <td style="width:65%;">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td  style="width:13%;"><b class="entrylabel">&nbsp;Lead Time:</b></td>
                                        <td style="width:46%;"><input id="LeadTime" style="width:80%;" tabindex="29" name="LeadTime" maxlength="24" type="text"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id = "frtblock" style="margin-left:.25%; width:28.5%; border:solid black; border-width:1px; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:60%; height: 26px;" class="floattitle"><span>&nbsp;Freight</span>
                                            <!-- <button class="entrybutton  rightaligned" id="FrtRecv" type="button" tabindex="45">Freight Recovery</button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div id="edittab-1">
                                <table id='frtboxTbl' >
                                    <tbody>
                                        <tr>
                                            <td><b>ShipVia</b></td>
                                            <td><select id='SelShipVia'>
                                                    <option>O-TRUCK</option>
                                                    <option>RAILCAR</option>
                                                    <option>CUST-PU</option>
                                                </select></td>
                                            <td></td>
                                            <td>
                                                <button class="entrybutton" id="AdjFrt" type="button" tabindex="11" >Adj.Freight</button>
                                                <span>&nbsp;</span>
                                                <a> <img alt="help" src="/graphics/Help.png" id="adj_help" class="tool"
                                                            title="Freight rates are generally based on full a truck. To view actual item freight, Click on Adjust Freight. This is a toggle switch.">
                                                </a>
                                                
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr class='trkFrtRow'>
                                            <td><b>State:</b></td>
                                            <td>
                                                <select id="State" name="State" tabindex="7" >
                                                </select></td>
                                            <td class="label_right_align"><b>City:</b></td>
                                            <td colspan="4">
                                                <select id="CityLst" size="1" tabindex="8" name="CityLst">
                                                    <option value="">&nbsp;</option>
                                                </select>&nbsp;<span id="destWarningMsg"></span></td>
                                            
                                        </tr>
                                        <tr class='railFrtRow'>
                                            <td><b>Carrier</b></td>
                                            <td>
                                                <input id="Carrier" name="Carrier" tabindex="7" >
                                            </td>
                                            <td><b></b></td>
                                            <td>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr >
                                            <td>
                                                <span  class='trkFrtRow '>
                                                    <b>Rate:</b>
                                                </span>
                                            </td>

                                            <td>
                                                <span  class='trkFrtRow '>
                                                    <input type="text" name="TrkRate" size="10" tabindex="9" id="TrkRate">
                                                    <span id="frtErrorMarker"></span></span>
                                            </td>
                                            <td class="label_right_align"><b>Plant:</b></td>
                                            <td colspan="2">
                                                <select id="RateLst" tabindex="10" name="RateLst">
                                                    <option value="">&nbsp;</option>
                                                </select>
                                                <span>&nbsp;</span><span id="lowerratespan"></span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="trkFrtRow">
                                            <td colspan="2" style="text-align:center;"><b>Estimated Trucks</b></td>
                                            <td colspan="4" style="text-align:center;"><b>Est. Remainining Capacity</b></td>
                                            <td></td>
                                        </tr>
                                        <tr class='trkFrtRow'> 
                                            <td ></td>
                                            <td ><input id="NbrTrks" size="4" type="text" tabindex="-1" name="NbrTrks" readonly="readonly" value=1></td>
                                            <td></td>
                                            <td colspan="3">
                                                <input id="TrkPcnt" size="6"  type="text" name="TrkPcnt" tabindex="-1" readonly="readonly" value="100%">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <!--
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>

                                            </td>
                                            <td>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="margin-left:.25%; width:22.5%; border:solid black; border-width:1px; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:60%;" class="floattitle"><span>&nbsp;Shipping Address</span><button class="entrybutton  rightaligned" id="ShipChg" type="button" tabindex="18">Change</button></td></tr>
                                </tbody>
                            </table>

                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:99%;"><textarea id="CustAddr" style="width:99%;  border:groove; background-color:#dddddd;" rows="7" cols="35" tabindex="-1" readonly="readonly" name="CustAddr"></textarea></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left:.25%; width:22.5%; border:solid black; border-width:1px; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:60%; height:26px" class="floattitle"><span>&nbsp;Customer Information</span></td></tr>
                                </tbody>
                            </table>
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:15%;"><b class="entrylabel">&nbsp;Customer:</b></td>
                                        <td style="width:85%;"><input type="text" id="CustName" name="CustName" style="width:100%; background-color:#dddddd;" tabindex="508" readonly="readonly"></td></tr>
                                    <tr><td style="width:6%;"><b class="entrylabel">&nbsp;Terms:</b></td>
                                        <td style="width:12%;"><input type="text" id="Terms" name="Terms" class="readonly" style="width:90%;" tabindex="509" readonly="readonly"></td></tr>
                                    <tr><td style="width:6%;"><b class="entrylabel">&nbsp;Credit Limit:</b></td>
                                        <td style="width:8%;"><input type="text" id="CrLmt" name="CrLmt" class="readonly" style="width:70%;" tabindex="510" readonly="readonly"></td></tr>
                                </tbody>
                            </table>
                            <div id="statusMessages">
                            </div>
                        </div>

                    </div>
                    <div style="height:42%; width:100%">
                        <div style="width:99%; height:100%; overflow-y: scroll; background-color:#eeeeee; float:left">
                            <hr>
                            <TABLE id="list" class="scroll" style="font-size:12px; width:98%;"></TABLE>
                        </div>
                        <div style="width:.5%; height:100%;  background-color:#eeeeee; float:left">
                        </div>
                    </div>
                    <hr>
                    <div class="left" style="width:100%; height:5%; background-color:#eeeeee; ">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="width:3%;"><button class="entrybutton" id="ALine" type="button" tabindex="23" >Add Line</button></td>
                                    <td style="width:3%;"><button class="entrybutton" id="ELine" type="button" tabindex="24" >Edit Line</button></td>
                                    <td style="width:3%;"><button class="entrybutton" id="ILine" type="button" tabindex="24" >Insert Line</button></td>
                                    <td style="text-align: left; width:10%;"><button class="entrybutton" id="DLine" type="button" tabindex="25">Delete Line</button></td>
                                    <td style="width:10%; height:24px;">
                                        <select id="FType" style="width:95%;" tabindex="26" name="FType" >
                                            <option value="0">All Products</option>
                                            <option value="1">Pyro-Guard</option>
                                            <option value="2">Exterior Fire-X</option>
                                            <option value="3">Preservative</option>
                                        </select></td>
                                    <td style="text-align: right; width:3%;"><button class="entrybutton" id="PLine" type="button" tabindex="27" >Delvd Prices</button></td>
                                    <td style="text-align: left; width:25%;"><button class="entrybutton" id="SLine" type="button" tabindex="28">Most Freq.</button></td>
                                    <td style="text-align: right; width:6%;"><b class="entrylabel">Total $:&nbsp;</b></td>
                                    <td style="width:9%;"><input id="TDollar" style="width:100%; font-size:12px; text-align:right; background-color:#dddddd;" name="TDollar" tabindex="-1" readonly="readonly" type="text" value='0.00'></td>
                                    <td style="text-align: right; width:6%;"><b class="entrylabel">Total BF:&nbsp;</b></td>
                                    <td style="width:9%;"><input id="TotBF" style="width:98%; text-align:right; font-size:12px; background-color:#dddddd;" name="TotBF" tabindex="-1" readonly="readonly" type="text" value='0'></td>
                                    <td style="width:7%; text-align: right;"><button class="entrybutton" id="CLine" type="button" tabindex="34">Copy Line</button></td>
                                    <td style="width:3%;"><button class="entrybutton" id="PuLine" type="button" tabindex="35">Paste &Lambda;</button></td>
                                    <td style="width:3%;"><button class="entrybutton" id="PdLine" type="button" tabindex="36">Paste V</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                    <div>
                        <div style="width:50%; height:24.5%; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="text-align: right; width:20%;"><b>Order Comments:&nbsp;</b></td>
                                        <td style="width:80%;"><textarea id="Instr" style="width:100%; border:groove;" rows="7" cols="50" tabindex="31" name="Instr"></textarea></td></tr>
                                </tbody>
                            </table>
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="text-align: right; width:95%;"></td>
                                        <td style="width:1%;"><a> <img alt="help" src="/graphics/Help.png" id="comment_help" class="tool" title="Comments entered in the Order Comments field will be visible to the customer on the sales order."></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <?php if ($this->_tpl_vars['ViewOnly'] == 'Y'): ?>
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:4%;"><button id="FileExit" class="entrybutton" type="button" tabindex="38">Exit</button></td>
                                        <td style="color:blue; width:60%;"><span>View Only Mode</span></td></tr>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:4%;"><button id="FileSave" class="entrybutton" type="button" tabindex="34" >Save</button></td>
                                        <td style="width:4%;"><button id="FileNew" class="entrybutton" type="button" tabindex="35">Reset</button></td>
                                        <td style="width:4%;"><button id="FileEmail" class="entrybutton" type="button" tabindex="36" >Email</button></td>
                                        <td style="width:14%;"><button id="FileOrder" class="entrybutton" type="button" tabindex="37">Make Order</button></td>
                                        <td style="text-align: right; width:22%;"><b>Close Quote:</b></td>
                                        <td style="width:52%;"><input type=checkbox name=Closeq id=Closeq tabindex="37" ></td></tr>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div style="width:50%; height:24.5%; background-color:#eeeeee; float:left">
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="text-align: right; width:20%;"><b>Internal Notes:&nbsp;</b></td>
                                        <td style="width:80%;"><textarea id="Notes" style="width:99%; border:groove;" rows="7" cols="50" tabindex="33" name="Notes"></textarea></td></tr>
                                </tbody>
                            </table>
                            <table style="width:100%;">
                                <tbody>
                                    <tr><td style="width:20%;">&nbsp;</td>
                                        <td style="width:80%;"><a> <img alt="help" src="/graphics/Help.png" id="notes_help" class="tool" 
                                                                        title="Comments entered in the Internal Notes will be visible only to Hoover personnel."></a></td>
                                </tbody>
                            </table>
                            <div>
                                <hr>
                                <table style="width:100%;">
                                    <tbody>
                                        <tr><td style="color:red; width:50%;"><b><span id="Msg"></span></b></td>
                                            <td style="color:red; width:50%;"><b><span id="Msg2"></span></b></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <div id="input-dialog" class="modal-dialog">
            <div id="dialog-detail"></div>
        </div>
        <div id="dialog-confirm" style="display: none;" title="The current quote has been saved.">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>How do you wish to proceed?</p>
        </div>
        <script type="text/javascript"> document.getElementById("Contact").focus();</script>
        <!-- <?php echo ' -->
        <script type="text/javascript">
            $("#list").setGridWidth($("table:first").width() - 50, true);
            $("#list").setGridWidth($("table:first").width() - 20, false);
            var tmpAr = $("#Info>div");
            var maxHeight = $("#Info").height();
            for (var ndx = 0; ndx < tmpAr.length; ndx++) {
                if ($(tmpAr[ndx]).height() > maxHeight) {
                    maxHeight = $(tmpAr[ndx]).height();
                }
            }
            $("#Info").height(maxHeight);
            $("#Info > div").height(maxHeight);
            document.getElementById("Contact").focus();
            </script>
        <!-- '; ?>
 -->
    </body>
</html>