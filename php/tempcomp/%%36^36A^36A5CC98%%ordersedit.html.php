<?php /* Smarty version 2.6.13, created on 2013-10-10 09:28:41
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Corderentry%5COrders/views/ordersedit.html */ ?>
<!DOCTYPE HTML >
<html>
    <head>
<!-- <?php echo ' -->
<script type="text/javascript">

    jQuery(document).ready(function() {
           buildEditDisplay.init();
    });
</script>
<style>
    INPUT.line_detail {
        height:22px; 
        font-size:14px; 
    }
    #invtdescr {
        text-transform:uppercase;
        height:22px; 
        font-size:14px; 
    }
    .disabled_input {
        background-color: #dddddd;
    }
    
    .enabled_input {
        background-color: #ffffff;
    }
</style>
<!-- '; ?>
 -->

        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <title>Order Edit</title>
    </head>
    <body>
        <input type="hidden" name=Invtid id=Invtid value="<?php echo $this->_tpl_vars['invtid']; ?>
">
        <input type="hidden" name=origin id=origin value="<?php echo $this->_tpl_vars['origin']; ?>
">
        <fieldset style = "background-color:GhostWhite; color:Black;">
            <div>
                <table style='width:100%;'>
                    <tbody>
                         <tr><td style='width:12%'><b class="entrylabel">Item Description:</b></td>
                            <td style='width:70%'><input  type=Text name=invtdescr id=invtdescr size=58 tabindex=251 value="<?php echo $this->_tpl_vars['invtdescr']; ?>
" ></td></tr>
                    </tbody>
                </table>
            </div>
            <div id='detail_item_inputs'>
                <div style='min-height: 100px;'>
            <div>
                <table style='width:100%;'>
                    <tbody>
                        <tr><td style='width:18%'><b class="entrylabel line_label">Quantity Ordered:</b></td>
                            <td style='width:27%'><input type=Text name=Quant class="line_detail"  id='Quant' tabindex=252 value='<?php echo $this->_tpl_vars['qty']; ?>
' ></td>
                            <td style='width:1%'></td>
                            <td style='width:16%; text-align: right;'><b class="entrylabel line_label">Select Unit:</b></td>
                            <td style='width:25%'><input type=radio class="line_detail"  name=Unit id=Un1 value=1 <?php echo $this->_tpl_vars['un1']; ?>
 tabindex=255 >
                                <span class="line_label"> Bndl</span></td>
                            <td style='width:13%'></td></tr>
                        <tr><td style='width:18%'><b class="entrylabel line_label">Wood Cost:</b></td>
                            <td style='width:27%'><input type=Text name=Woodc class="line_detail" id=Woodc tabindex=253 value='<?php echo $this->_tpl_vars['wcost']; ?>
' ></td>
                            <td style='width:1%'></td>
                            <td style='width:16%'></td>
                            <td style='width:25%'><input class="line_detail" type=radio name=Unit id=Un2 value=2 <?php echo $this->_tpl_vars['un2']; ?>
 tabindex=256>
                                <span class="line_label">Each</span></td>
                            <td style='width:13%'></td></tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table style='width:100%;'>
                    <tbody>
                        <tr><td style='width:18%'><b class="entrylabel line_label">Treatment Cost:</b></td>
                            <td style='width:27%'><input type=Text name=Trtc class="line_detail"  id=Trtc tabindex=254 value='<?php echo $this->_tpl_vars['tcost']; ?>
' ></td>
                            <td style='width:55%'></td>
                            <td></td>
                        </tr>
                        <tr><td style='width:18%'><b class="entrylabel line_label">Adjustments:</b></td>
                            <td style='width:20%'><input type=Text name=Trtadj class="line_detail"  id=Trtadj tabindex=259 value='<?php echo $this->_tpl_vars['adj']; ?>
' ></td>
                            <td style='width:62%'></td>
                            <td></td>
                        </tr>
                        <tr><td style='width:18%'><b class="entrylabel line_label freight_line">Freight:</b></td>
                            <td style='width:20%'><input type=Text name=Frt class="line_detail freight_line"  id=Frt tabindex=260 value='<?php echo $this->_tpl_vars['frt']; ?>
' ></td>
                            <td style='color:green; width:6%;'><span style="font-size:12px" id='msg2edit'></span></td>
                            <td style='width:60%'></td>
                        </tr>
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </fieldset>
        <table style='width:100%;'>
            <tbody>
                <tr><td style='width:5%;'><button  class="entrybutton" id="RecSave" type="button" tabindex=264 >Save</button></td>
                    <td style='width:5%;'><button  class="entrybutton" id="Cancel"  type="button" tabindex=265 >Cancel</button></td>
                    <td style='width:5%'>&nbsp;</td>
                    <td style='color:red; width:85%;'><b><span style="font-size:12px" id='msgedit'></span></b></td></tr>
            </tbody>
        </table>
        <div id="dialog-confirm" class="modal-dialog" style="width:100%; display:none;" title="Warning">
            <div id="warning_content" style="width:100%;"></div>
             <!--<select id="Warnings" name="Warnings" style="width:100%;" size="5">
             </select> -->
	     <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>The above items are invalid. Are you sure?</p>
        </div>
<script type="text/javascript"> document.getElementById("invtdescr").focus(); </script>
</body>
</html>