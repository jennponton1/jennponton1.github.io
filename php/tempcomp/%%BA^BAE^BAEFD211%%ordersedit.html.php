<?php /* Smarty version 2.6.13, created on 2013-08-06 14:20:30
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Corderentry%5Cordersnew/views/ordersedit.html */ ?>
<!DOCTYPE HTML >
<html>
    <head>
<!-- <?php echo ' -->
<script type="text/javascript">
    var buildEditDisplay = {
        init : function() {
               if ($(\'#tsoind\').val() === \'T\') {
                   $(\'#Woodc\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
               }
               if ($(\'#shipvia\').val() === \'CUST-PU\') {
                   $(\'#Frt\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
               }
               if ($(\'#origin\').val() === \'X\') {
                   $(\'#invtdescr\').attr({disabled:true, style:"background-color:#dddddd; height:22px; font-size:12px;"});
                   document.getElementById("Quant").focus()
               }
               if ($(\'#Invtid\').val() === \'\' && $(\'#origin\').val() === \'X\') {
                   $(\'#Quant\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
                   $(\'#Woodc\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
                   $(\'#Trtc\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
                   $(\'#Trtadj\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
                   $(\'#Frt\').attr({disabled:true, style:"background-color:#dddddd; width:70%; height:22px; font-size:12px;"});
                   $(\'#Un1\').attr({disabled:true});
                   $(\'#Un2\').attr({disabled:true});
                   $(\'#RecSave\').attr({disabled:true});
               }
               exittype = 1;
               $("#RecSave").on("click",editData.verifyLoad);
               $("#Cancel").on("click",buildDisplay.cancelDialog);
        }
    }
    jQuery(document).ready(function() {
           buildEditDisplay.init();
    });
</script>
<!-- '; ?>
 -->

        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <title>Order Edit</title>
    </head>
    <body>
        <input type="hidden" name=Invtid id=Invtid value="<?php echo $this->_tpl_vars['invtid']; ?>
">
        <input type="hidden" name=tsoind id=tsoind value="<?php echo $this->_tpl_vars['tsoind']; ?>
">
        <input type="hidden" name=origin id=origin value="<?php echo $this->_tpl_vars['origin']; ?>
">
        <input type="hidden" name=shipvia id=shipvia value="<?php echo $this->_tpl_vars['shipvia']; ?>
">
        <fieldset style = "background-color:GhostWhite; color:Black;">
            <div>
                <table width='100%'>
                    <tbody>
                         <tr><td style='width:12%'><b class="entrylabel">Item Description:</b></td>
                            <td style='width:70%'><input style="height:22px; font-size:14px; text-transform:uppercase" type=Text name=invtdescr id=invtdescr size=58 tabindex=251 value="<?php echo $this->_tpl_vars['invtdescr']; ?>
" ></td></tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table width='100%'>
                    <tbody>
                        <tr><td style='width:18%'><b class="entrylabel">Quantity Ordered:</b></td>
                            <td style='width:27%'><input type=Text name=Quant style="width:70%; height:22px; font-size:14px;" id='Quant' tabindex=252 value='<?php echo $this->_tpl_vars['qty']; ?>
' ></td>
                            <td style='width:1%'></td>
                            <td align="right" style='width:16%'><b class="entrylabel">Select Unit:</b></td>
                            <td style='width:25%'><input type=radio name=Unit id=Un1 value=1 <?php echo $this->_tpl_vars['un1']; ?>
 tabindex=255 > Bndl</td>
                            <td style='width:13%'></td></tr>
                        <tr><td style='width:18%'><b class="entrylabel">Wood Cost:</b></td>
                            <td style='width:27%'><input type=Text name=Woodc style="width:70%; height:22px; font-size:14px;" id=Woodc tabindex=253 value='<?php echo $this->_tpl_vars['wcost']; ?>
' ></td>
                            <td style='width:1%'></td>
                            <td style='width:16%'></td>
                            <td style='width:25%'><input type=radio name=Unit id=Un2 value=2 <?php echo $this->_tpl_vars['un2']; ?>
 tabindex=256> Each</td>
                            <td style='width:13%'></td></tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table width='100%'>
                    <tbody>
                        <tr><td style='width:18%'><b class="entrylabel">Treatment Cost:</b></td>
                            <td style='width:27%'><input type=Text name=Trtc style="width:70%; height:22px; font-size:14px;" id=Trtc tabindex=254 value='<?php echo $this->_tpl_vars['tcost']; ?>
' ></td>
                            <td style='width:55%'></td></tr>
                        <tr><td style='width:18%'><b class="entrylabel">Adjustments:</b></td>
                            <td style='width:20%'><input type=Text name=Trtadj style="width:70%; height:22px; font-size:14px;" id=Trtadj tabindex=259 value='<?php echo $this->_tpl_vars['adj']; ?>
' ></td>
                            <td style='width:62%'></td></tr>
                        <tr><td style='width:18%'><b class="entrylabel">Freight:</b></td>
                            <td style='width:20%'><input type=Text name=Frt style="width:70%; height:22px; font-size:14px;" id=Frt tabindex=260 value='<?php echo $this->_tpl_vars['frt']; ?>
' ></td>
                            <td style='color:green; width:6%;'><span style="font-size:12px" id='msg2edit'></span></td>
                            <td style='width:60%'></td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <table width='100%'>
            <tbody>
                <tr><td style='width:5%;'><button  class="entrybutton" id="RecSave" type="button" tabindex=264 >Save</button></td>
                    <td style='width:5%;'><button  class="entrybutton" id="Cancel"  type="button" tabindex=265 >Cancel</button></td>
                    <td style='width:5%'>&nbsp;</td>
                    <td style='color:red; width:85%;'><b><span style="font-size:12px" id='msgedit'></span></b></td></tr>
            </tbody>
        </table>
        <div id="dialog-confirm" class="modal-dialog" style="width:100%; display:none;" title="Warning">
             <select id="Warnings" name="Warnings" style="width:100%;" size="5">
             </select>
	     <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>The above items are invalid. Are you sure?</p>
        </div>
<script type="text/javascript"> document.getElementById("invtdescr").focus(); </script>
</body>
</html>