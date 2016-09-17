<?php /* Smarty version 2.6.13, created on 2012-05-11 08:44:20
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CWoodVouchers/views/POPriceEdit.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>PO Edit</title>
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
        <script type="text/javascript" src="views/POPriceEdit.js"></script>
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
        <form action="" method="POST" name=POEdit id=POEdit <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
              <input type="hidden" name="po_data" id="po_data"  value='<?php echo $this->_tpl_vars['data']; ?>
'>
            <input type="hidden" name="do" id="do" value="">
            <div style="background-color: #eeeeee">
                <table style="width:30%;">
                    <tbody>
                        <tr>
                            <td style="width:10%;"><b>&nbsp;PO Number:</b></td>
                            <td style="width:10%;"><input type="text" name="ponbr" id="ponbr" value="<?php echo $this->_tpl_vars['ponbr']; ?>
"/></td>
                            <td style="width:10%;"><button id="editpo" type="button" onClick="javascript:getList();">Enter</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:100%">
                <!--<div style="width:.5%; height:36.40%; background-color:#eeeeee; float:left">
                </div>-->
                <div style="width:100%; background-color:#eeeeee; float:left">
                    <table style="width:40%;">
                        <tr>
                            <td style="width:30%;"><input type="text" name="vendname" id="vendname" style="width:100%; background-color:#dddddd;" readonly="readonly" value="<?php echo $this->_tpl_vars['vendname']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:30%;"><input type="text" name="vendaddr1" id="vendaddr1" style="width:100%;background-color:#dddddd;" readonly="readonly" value="<?php echo $this->_tpl_vars['vendadddr1']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:30%;"><input type="text" name="vendaddr2" id="vendaddr2" style="width:100%; background-color:#dddddd;" readonly="readonly" value="<?php echo $this->_tpl_vars['vendaddr2']; ?>
"/></td>
                        </tr>
                        <tr>
                            <td style="width:30%;"><input type="text" name="vendaddr3" id="vendaddr3" style="width:100%; background-color:#dddddd;" readonly="readonly" value="<?php echo $this->_tpl_vars['vendaddr3']; ?>
"/></td>
                        </tr> 
                    </table>
                </div>
            </div>
            <div style="width:100%">
                <div style="width:.5%; height:.5%; background-color:#eeeeee; float:left">
                </div>
                <div style="width:100%; background-color:#eeeeee; float:left">
                    <hr>
                    <TABLE id="poitems" class="scroll" style="font-size: 12px; width: 100%;">
                        
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
            
            <div style="width:100%; height:20%; background-color: #eeeeee; float:left">
                <hr>
                <table style="width:10%;">
                    <tbody>
                        <tr>
                            <td style="width:4%;"><button id="SavePO" type="button" onClick="javascript:VerifyPO();">Save</button></td>
                            <td style="width:4%;"><button id="Cancel" type="button" onClick="javascript:CancelEntry();">Cancel</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="input-dialog" class="modal-dialog">
                <div id="dialog-detail"></div>
            </div>
        </form>
        
    </body>
</html>