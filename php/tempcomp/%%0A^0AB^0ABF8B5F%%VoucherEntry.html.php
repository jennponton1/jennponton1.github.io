<?php /* Smarty version 2.6.13, created on 2012-02-24 10:16:34
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CWoodVouchers%5Cjennifer/views/VoucherEntry.html */ ?>
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
        </style>
        '; ?>

        <script type="text/javascript" src="/Ajax/jquery/jquery.js"></script>
        <script type="text/javascript" src="/Ajax/jqueryui/js/jquery-ui-1.8.1.custom.min.js"></script>        
        <script type="text/javascript" src="views/unvreceipts.js"></script>
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
            <div style="background-color: #eeeeee">
                <table style="width:35%;">
                    <tbody>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Vendor ID:</b></td>
                            <td style="width:9%;"><input type="text" name="vendorid" id="vendorid" value="<?php echo $this->_tpl_vars['vendid']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Vendor:</b></td>
                            <td style="width:9%;"><input name="vendname" id="vendname" value="<?php echo $this->_tpl_vars['vendid']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;PO Number:</b></td>
                            <td style="width:9%;"><input name="ponumber" id="ponumber" value="<?php echo $this->_tpl_vars['ponbr']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Invoice Number:</b></td>
                            <td style="width:9%;"><input name="invnum" id="invnum" value=""/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Invoice Date:</b></td>
                            <td style="width:9%;"><input name="invdate" id="invdate" value=""/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Terms:</b></td>
                            <td style="width:9%;"><input name="terms" id="terms" value=""/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Pay Date:</b></td>
                            <td style="width:9%;"><input name="paydate" id="paydate" value=""/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Doc Amount:</b></td>
                            <td style="width:9%;"><input name="docamount" id="docamount" value=""/></td>
                        </tr>
                        <tr>
                            <td style="width:9%;"><b>&nbsp;Disc Amount:</b></td>
                            <td style="width:9%;"><input name="discamount" id="discamount" value=""/></td>
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
                        
                        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['row'][4]; ?>
</td>
                            <td><?php echo $this->_tpl_vars['row'][5]; ?>
</td>
                            <td><?php echo $this->_tpl_vars['row'][6]; ?>
</td>
                            <td><?php echo $this->_tpl_vars['row'][7]; ?>
</td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </TABLE>
                </div>
            </div>    
            <div style="width:50%; height:25.5%; background-color: #eeeeee; float:left">
                <hr>
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:4%;"><button id="SaveVoucher" type="button" onClick="javascript:SaveVoucher();">Save</button></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </form>
    </body>
</html>