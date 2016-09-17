<?php /* Smarty version 2.6.13, created on 2013-09-05 16:36:44
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs/views/SelectFreight.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Unvouchered Freight Delivery Tickets</title>
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
        </style>
        '; ?>

        
        <script type="text/javascript" src="/Ajax/jquery/jquery.js"></script>
        <script type="text/javascript" src="/Ajax/jqueryui/js/jquery-ui-1.8.1.custom.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/grid.celledit.js"></script>        
        <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryTips/jquery.tipTip.minified.js"></script>
        <script type="text/javascript" src="views/SelectFreight.js"></script>
    </head>
    
    <body>
        <form action="" method=POST name=SelectFreight id=SelectFreight <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
              <input type="hidden" name="enter_voucher_data" id="enter_voucher_data">
            <input type="hidden" name="do" id="do" value="">
            <div style="width:35%; height:20%; background-color: #eeeeee; float:left">
                <table style="width:60%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Site ID:</b></td>
                            <td style="width:9%;">
                                <select name="siteid" id="siteid" style="width:100%;" onChange="javascript: getList();">
                                    <option value="" selected></option>
                                    <option value="DET">Detroit</option>
                                    <option value="MIL">Milford</option>
                                    <option value="PB">Pine Bluff</option>
                                    <option value="THO">Thomson</option>
                                    <option value="WIN">Winston</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>--OR--</b></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Delivery Ticket:</b></td>
                            <td style="width:9%;"><input name="deltick" id="deltick" value="<?php echo $this->_tpl_vars['deltick']; ?>
" onChange="javascript: getList();"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>--OR--</b></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Carrier:</b></td>
                            <td style="width:9%;"><input name="carr" id="carr" value="<?php echo $this->_tpl_vars['carr']; ?>
" onChange="javascript: getList();"/></td>
                        </tr>
                    </tbody>

                </table>
            </div> 
            <div style="width:2%; height:20%; background-color:#eeeeee; float:left">
            </div>
            <div style="width:35%; height:20%; background-color:#eeeeee; float:left">
                <table style="width:60%;">
                    <tbody>
                        <tr>
                            <td style="width:20%;"><b>If the delivery ticket number is not available in the list below, enter it here:</b></td>
                        </tr>
                        <tr>
                            <td style="width:20%;"><textarea name="psteddeltick" id="psteddeltick" rows="5" onBlur="javascript: getList();"></textarea></td>
                        </tr>                    
                    </tbody>
                </table>
            </div>
            <div style="width:28%; height:20%; background-color:#eeeeee; float:left">
            </div>
            <div style="width:100%">
                <div style="width:100%; background-color:#eeeeee; float:left">
                    <hr>
                    <TABLE id="result" class="scroll" style="font-size:12px; width:98%;"></TABLE>
                    <hr>
                    <div style="width:60%; background-color: #eeeeee;float:right">
                        <table style="width:40%;">
                            <tbody>
                                <tr>
                                    <td><button id="SelectAll" type="button" onClick="selectAllRows();">Select All</button></td>
                                    <td><button id="UnSelectAll" type="button" onClick="unselectAllRows();">Clear Selection</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:15%;"><b>&nbsp;Total Cost:</b></td>
                                    <td style="width:15%;"><input type="text" name="totcost" id="totcost" readonly="readonly" value=<?php echo $this->_tpl_vars['totcost']; ?>
></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>        
                </div>
            </div>
            <div style="width: 100%; background-color: #eeeeee; float:left">
                <hr>
                <table>
                    <tr>                        
                    </tr>
                    <tr>
                        <td></td>
                        <td><button id="FrtVoucherEntry" type="button" onClick="javascript:enterVoucher();">Enter Voucher</button></td>
                        <td><button id="cancel" type="button" onClick="javascript:Reset();">Cancel</button></td>
                    </tr>
                </table>
            </div>
            <div style="width:100%; background-color: #eeeeee; float:left">  
                <!--<a href="javascript:void(0)" id="m1">Get Selected id's</a>-->
            </div>
        </form>      
    </body>
</html>