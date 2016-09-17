<?php /* Smarty version 2.6.13, created on 2014-10-14 15:40:51
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotesorig/views/detailedit.tpl.html */ ?>
<!-- THIS IS AN HTML SNIPPET, **NOT** AN INDEPENDENT PAGE -->
<input type='hidden' name=can     id=can     value='<?php echo $this->_tpl_vars['can']; ?>
'>
<input type="hidden" name=Invtid  id=Invtid  value="<?php echo $this->_tpl_vars['invtid']; ?>
">
<input type="hidden" name=Stkitem id=Stkitem value="<?php echo $this->_tpl_vars['stkitem']; ?>
">
<div>
    <table width='100%'>
        <tbody>
            <tr><td style='width:21%'></td>
                <td style='width:75%;'><span id='heading'>&nbsp;</span></td>
                <td style='width:21%'></td></tr>
            <tr><td style='width:21%'>Item Description:</td>
                <td style='width:75%'><input style="text-transform: uppercase" type=Text name=invtdescr id=invtdescr  size=58 tabindex=51 value="<?php echo $this->_tpl_vars['descr']; ?>
" ></td>
                <td style='width:4%'><a><img alt="help" src="/graphics/Help.png" id="inv_help" class="tool" align="top" border="0" height="22" width="22"
                                             title="This is an auto-complete field. Enter either the inventory id or description.  Select from the drop down select box when it appears."></a></td></tr>
        </tbody>
    </table>
</div>
<div>
    <table width='100%'>
        <tbody>
            <tr><td style='width:21%'>Quantity:</td>
                <td style='width:27%'><input class="dtlInput" type="number" step="1" name=Quant style="width:70%;" id=Quant tabindex=52 value=0 ></td>
                <td style='width:1%'></td>
                <td align="right" style='width:16%'>Select Unit:</td>
                <td style='width:25%'><input class="dtlInput"  type=radio name=Unit id=Un1 value=1 tabindex=55 > Bndl</td>
                <td style='width:10%'></td></tr>

            <tr><td style='width:21%'>Wood Cost:</td>
                <td style='width:27%'><input  class="dtlInput" type="number" step=".01"  name=Woodc style="width:70%;" id=Woodc  tabindex=53 value=0 ></td>
                <td style='width:1%'></td>
                <td style='color:red; width:16%;'><b><span id='msgwc'></span></b></td>

                <!--<td style='width:21%'></td>
                <td style='width:27%'></td>
                <td style='width:1%'></td>
                <td style='width:16%'></td> -->

                <td style='width:25%'><input  class="dtlInput" type=radio name=Unit id=Un2 value=2  tabindex=56> Each</td>
                <td style='width:10%'></td></tr>
        </tbody>
    </table>
</div>
<div>
    <table width='100%'>
        <tbody>
            <tr><td style='width:21%'>Treatment Cost:</td>
                <td style='width:27%'><input class="dtlInput"  type="number" step=".01" name=Trtc style="width:70%;" id=Trtc tabindex=54 value='0' ></td>
                <td style='width:1%'></td>
                <td style='color:red; width:16%;'><b><span id='msgtc'></span></b></td>
                <td style='width:25%'></td>
                <td style='width:10%'></td></tr>
        </tbody>
    </table>
</div>
<hr>
<div id="NoId" style="display:none">
    <table width='100%'>
        <tbody>
            <tr><td style='width:21%'>Billing Units:</td>
                <td style='width:27%'><input  class="dtlInput" type=Text name=BUts style="width:70%;" id=BUts tabindex=57 value='' ></td>
                <td style='width:1%'></td>
                <td align="right" style='width:16%'>Select BU:</td>
                <td style='width:35%'><input class="dtlInput"  type=radio name=WoodT id=Wt1 value=1  tabindex=59> Lumber (mbf)</td></tr>
            <tr><td style='width:21%'>Board Feet:</td>
                <td style='width:27%'><input class="dtlInput"  type=Text name=BdFt style="width:70%;" id=BdFt tabindex=58 value='' ></td>
                <td style='width:1%'></td>
                <td style='width:16%'></td>
                <td style='width:35%'><input  class="dtlInput" type=radio name=WoodT id=Wt2 value=2  tabindex=60> Plywood (msf)</td></tr>
        </tbody>
    </table>
    <hr>
</div>
<div>
    <table width='100%'>
        <tbody>
            <tr><td style='width:21%'>Stocking Dist Disc:</td>
                <td style='width:20%'><input class="dtlInput"  type="number" step=".01" name=Discnt style="width:100%;" id=Discnt tabindex=61 value='0' ></td>
                <td align="left" style='color:red; width:1%'>(-)</td>
                <td style='width:58%'>&nbsp; <a> <img alt="help" src="/graphics/Help.png" id="disc_help" class="tool" align="top" border="0" height="22" width="22"
                                                      title="Do not use signs.  Discounts are assumed to be negative and charges are positive."></a></td></tr>
            <tr><td style='width:21%'>Additional Disc:</td>
                <td style='width:20%'><input class="dtlInput"  type="number" step=".01" name=Trtadj style="width:100%;" id=Trtadj tabindex=62 value='0' ></td>
                <td align="left" style='color:red; width:1%'>(-)</td>
                <td style='width:58%'></td></tr>
            <tr><td style='width:21%'>Additional Charge:</td>
                <td style='width:20%'><input  class="dtlInput" type="number" step=".01" name=Addr style="width:100%;" id=Addr  tabindex=63 value='0' ></td>
                <td align="left" style='color:red; width:1%'>(+)</td>
                <td style='width:58%'></td></tr>
            <tr>
                <td colspan="4"><hr></td>
            </tr>
            <tr><td style='width:21%'>Freight</td>
                <td style='width:20%'><input  class="dtlInput" type="number" step=".01" name=tlFreight style="width:100%;" id=tlFreight tabindex=64 value='0' ></td>
                <td align="left" style='color:red; width:3%'>(+)</td>
                <td style='width:58%'>&nbsp; </td>
            </tr>
        </tbody>
    </table>

<hr>

</div>
<hr>
<table width='100%'>
    <tbody>
        <tr><td style='width:5%;'><button id="RecSave" class="dtlButton" type="button" tabindex=64 >Save</button></td>
            <td style='width:5%;'><button id="Cancel"  class="dtlCanButton" type="button" tabindex=65 >Cancel</button></td>

            <td style='width:5%'>&nbsp;</td>
            <td style='color:red; width:85%;'><b><span><!-- material not manuf --></span></b></td></tr>

    <td style='width:5%'>&nbsp;</td>
    <td style='color:red; width:85%;'><b><span id='msgedit'></span></b></td></tr>

</tbody>
</table>
<!-- <?php echo ' -->
<script type="text/javascript">
    detailEditPage.init();
    $(document).ready(function() {
        $("#invtdescr").autocomplete("option", "autoFocus", true);
        document.getElementById("invtdescr").focus();
    });
</script>
<!-- '; ?>
 -->