<?php /* Smarty version 2.6.13, created on 2013-09-06 13:12:10
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CWoodVouchers/views/VoucherEntry.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Voucher Entry</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
        <link type="text/css" href="/Ajax/jqueryui/css/ui-lightness/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
        <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet">
        <link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet">
        <link type="text/css" href="/Ajax/JQueryTips/tipTip.css" media="screen" rel="stylesheet">
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
               #tiptip_content {
                 color: rgb(255,255,255);
                 background-color: rgb(28,134,238);
                 font-size: 14px;
               }
               .help-div {
                   position: absolute;
               }
        </style>
        '; ?>

        <script type="text/javascript" src="/Ajax/jquery/jquery.js"></script>
        <script type="text/javascript" src="/Ajax/jqueryui/js/jquery-ui-1.8.1.custom.min.js"></script>        
        <script type="text/javascript" src="views/voucherentry.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/grid.celledit.js"></script>        
        <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryTips/jquery.tipTip.minified.js"></script>
    </head>
    <body>
        <form action="" method="POST" name=VoucherEntry id=VoucherEntry <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
              <input type="hidden" name="receipt_data" id="receipt_data"  value='<?php echo $this->_tpl_vars['data']; ?>
'>
              <input type="hidden" name="siteid" id="siteid" value="<?php echo $this->_tpl_vars['siteid']; ?>
">
            <div style="background-color: #eeeeee">
                <table style="width:20%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Invoice Total:</b></td>
                            <td style="width:9%;"><input type="text" name="invtotal" id="invtotal" value="<?php echo $this->_tpl_vars['invtotal']; ?>
"/></td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:90%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Vendor ID:</b></td>
                            <td style="width:9%;"><input type="text" name="vendid" id="vendid" value="<?php echo $this->_tpl_vars['vendid']; ?>
"/></td>
                        
                            <!--<td style="width:50%;"><input type="text" name="vendname" id="vendname" style="width:100%; background-color:#dddddd;" readonly="readony" value="<?php echo $this->_tpl_vars['vendname']; ?>
"/>&nbsp;<span id="vendor_help" class="vend_span" style="padding:2px; border: thin solid black; background: lightblue;">Vendor Address</span></td>-->
                            <td style="width:30%;"><input type="text" name="vendname" id="vendname" style="width:100%; background-color:#dddddd;" readonly="readonly" value="<?php echo $this->_tpl_vars['vendname']; ?>
"/>
                                    <!--<span id="dressing_help" class="help_span" style="padding:2px; border: thin solid black; background: lightblue;">?</span>-->
                                    </td>
                            <td style="width:15%"><span id="vend_help" class="help_span" style="padding:2px; border: thin solid black; background: lightblue;">Vendor Address</span></td>
                            <td style="width:12%;"><b>Remit To Vendor ID:</b></td>
                            <td style="width:9%;"><input type="text" name="remvendid" id="remvendid" value="<?php echo $this->_tpl_vars['remvendid']; ?>
"/></td>
                            <td style="width:11%;">
                                <button id="vendlup" type="button" onClick="javascript:VendorLup();">Vendor Search</button>
                            </td>
                            <td style="width:30%;"><input type="hidden" name="remvendname" id="remvendname" value="<?php echo $this->_tpl_vars['remvendname']; ?>
"/></td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;PO Nbr:</b></td>
                            <td style="width:9%;"><input name="ponbr" id="ponbr" value="<?php echo $this->_tpl_vars['ponbr']; ?>
"/></td>
                        
                            <td style="width:9%;"><b>&nbsp;Invoice Nbr:</b></td>
                            <td style="width:9%;"><input name="invnum" id="invnum" value="<?php echo $this->_tpl_vars['invnum']; ?>
" onblur="javascript:checkInvcnbr()"/></td>
                            
                            <td style="width:9%;"><b>&nbsp;Terms:</b></td>
                            <td style="width:9%;"><input name="terms" id="terms" value="<?php echo $this->_tpl_vars['terms']; ?>
"/></td>
                            
                            <td style="width:9%;"></td>
                            <td style="width:9%;"></td>
                         </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Invoice Date:</b></td>
                            <td style="width:9%;"><input name="invdate" id="invdate" value="<?php echo $this->_tpl_vars['invdate']; ?>
" onChange="javascript:formatInvDate()"/></td>
                       
                            <td style="width:9%;"><b>&nbsp;Pay Date:</b></td>
                            <td style="width:9%;"><input name="paydate" id="paydate" value="<?php echo $this->_tpl_vars['paydate']; ?>
" onChange="javascript:formatPayDate()"/></td>
                            
                            <td style="width:9%;"><b>&nbsp;Disc Amount:</b></td>
                            <td style="width:9%;"><input name="discamount" id="discamount" value="<?php echo $this->_tpl_vars['discamount']; ?>
"/></td>
                            
                            
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:100%">
                <div style="width:.5%; height:36.40%; background-color:#eeeeee; float:left">
                </div>
                <div style="width:99%; background-color:#eeeeee; float:left">
                    <hr>
                    <TABLE id="rtitems" class="scroll" style="font-size: 12px; width: 98%;">
                        
                    </TABLE>
                </div>
            </div>   
            <div>
                    <hr>
                    <table style="width:100%;">
                       <tbody>
                           <tr><td style="color:red; width:68%;"><b><span id="Msg"></span></b></td></tr>
                       </tbody>
                    </table>
            </div>
            <div class="left" style="width:25%; height:5%; background-color: #eeeeee; float:left">
                <table style ="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:100%;">
                                <button id="ALine" type="button" tabindex="19" onClick="javascript:AddLine();">Add Line</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:75%; height:5%; background-color: #eeeeee; float:right">
                <hr>
                <table style="width:35%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Total:</b></td>
                            <td style="width:9%;"><input type="text" name="totalcost" id="totalcost" readonly="readonly" value="<?php echo $this->_tpl_vars['totalcost']; ?>
"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:100%; height:20%; background-color: #eeeeee; float:left">
                <hr>
                <table style="width:10%;">
                    <tbody>
                        <tr>
                            <td style="width:4%;"><button id="SaveVoucher" type="button" onClick="javascript:VerifyVoucher();">Save</button></td>
                            <td style="width:4%;"><button id="Cancel" type="button" onClick="javascript:CancelEntry();">Cancel</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="input-dialog" class="modal-dialog">
                <div id="dialog-detail"></div>
            </div>
        </form>
        <div class="help-div" id="vend_help-div">This input is intended for dressings or descriptions OTHER than
        Wood Type, Species, Grade or FSC or other prefix</div>
        <!--<div class="vend-div" id="vendor_help-div">
            <input type="text" name="vend_span" id="vend_help-div" readonly="readonly" value="vendor address here"/>
        </div>-->
    </body>
</html>