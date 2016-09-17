<?php /* Smarty version 2.6.13, created on 2013-11-12 14:47:53
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5CWoodPOs/views/POInputView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <?php echo '
  <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
  <link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet" />

  <style>
  html, div {font-size: 80%;}
  html, body {
    margin: 0;
    padding: 0;
    font-size: 85%;
  }
  </style>
  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
  <script type="text/javascript" src="views/shortcut.js"></script>
  <script type="text/javascript" src="views/POInput.js"></script>
<!--  <script type="text/javascript">

</script>
-->
'; ?>

</head>
<BODY onLoad="javascript:setUpForm()">
    <div>
    <form method=POST name=POInputView id=POInputView <?php echo $this->_tpl_vars['form']['attributes']; ?>
 action="">
        <input type='hidden' name='altid'  id='altid'>
        <input type='hidden' name='altln'  id='altln'>
        <input type='hidden' name='altfn'  id='altfn'>
        <input type='hidden' name='altad1' id='altad1'>
        <input type='hidden' name='altad2' id='altad2'>
        <input type='hidden' name='altcty' id='altcty'>
        <input type='hidden' name='altst'  id='altst'>
        <input type='hidden' name='altzp'  id='altzp'>
        <br>
      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 12%;"><b>Order Number:</b></td>
          <td style="width: 4%;">
              <select id="OrdPrefix" tabindex="1" onchange="UpdateShip(1)"  name="OrdPrefix">
                   <option value="T" selected="true" >THO</option>
                   <option value="P">PB</option>
                   <option value="M">MIL</option>
                   <option value="D">DET</option>
                   <option value="W">WIN</option>
              </select></td>
          <td style="width: 20%;"><input id="OrdNum" tabindex="2" maxlength="5" onchange="UpdateOrd('1')" name="OrdNum" type="text"></td>
          <td style="width: 16%;"></td>
          <td style="width: 11%;"><b>Order Date:</b></td>
          <td style = "width: 30%;"><input type="text"name="OrdDate" tabindex="4" id="OrdDate">&nbsp;
                      <FONT SIZE='-1'>(mm/dd/YYYY)</FONT></td>
          <td style="width: 7%;"></td>
        </tr>
        <tr>
          <td style="width: 12%;"><b>Process Status:</b></td>
          <td style="width: 4%;"></td>
          <td style="color: blue; width: 20%;"><b><input id="Status" tabindex="69" readonly="readonly" value="Add Mode"  name="Status" type="text"></b></td>
          <td style="width: 16%;"><button id="FileCopy" tabindex="19" type="button" onClick="javascript:CopyOrd();">Copy Order</button></td>
          <td style="width: 11%;"><b>Ship Date:</b></td>
          <td style = "width: 30%;"><input type="text" name="ShipDate" tabindex="5" id="ShipDate">&nbsp;
                      <FONT SIZE='-1'>(mm/dd/YYYY)</FONT></td>
          <td style="width: 7%;"></td>
        </tr>
        <tr>
          <td style="width: 12%;"><b>Vendor Id:</b></td>
          <td style="width: 4%;"></td>
          <td style="width: 20%;"><input id="vendid" tabindex="3" name="vendid" type="text" OnKeyup="return cUpper(this)" onblur="UpdateVend()">&nbsp;&nbsp;<a
              href="javascript:void(0)" onclick="doVendorLookup(document.POInputView.vendid);"><img
              src="/graphics/binocular.gif" id=Vendor align="bottom" border="0" height="16" width="16"></a></td>
          <td style="width: 16%;"></td>
          <td style="width: 11%;"><b>Ship To:</b></td>
          <td style="width: 30%;">
          <select id="ShipTo" style="width: 50%;" onchange="UpdateShip(2)" tabindex="6" name="ShipTo">
               <option value="T" selected="selected">Thomson</option>
               <option value="P">Pine Bluff</option>
               <option value="M">Milford</option>
               <option value="D">Detroit</option>
               <option value="W">Winston</option>
               <option value="O">Other</option>
               <option value="C">Customer Pickup</option>
          </select></td>
          <td style="width: 7%;"></td>
        </tr>
        </tbody>
      </table>
      <div id="address">
      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 35%;"><textarea id="VendAddr" style="width: 100%;" rows="4" tabindex="70" readonly="readonly"
              name="VendAddr"> <?php echo $this->_tpl_vars['VendAddr']; ?>
 </textarea></td>
          <td style="width: 18%;"></td>
          <td style="width: 35%;"><textarea id="ShipAddr" style="width: 100%;" rows="4" tabindex="71" readonly="readonly"
              name="ShipAddr"> <?php echo $this->_tpl_vars['ShipAddr']; ?>
 </textarea></td>
          <td style="width: 12%;"></td>
        </tr>
        </tbody>
      </table>
      </div>
      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 25%;"><b>Vendor Email</b></td>
          <td style="width: 13%;"><b>Ship Via</b></td>
          <td style="width: 15%;"><b>Confirm To</b></td>
          <td style="width: 19%;"><b>Terms</b></td>
          <td style="width: 15%;"><b>FOB</b></td>
          <td style="width: 13%;"><b>Buyer</b></td>
        </tr>
        </tbody>
      </table>
      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 25%;"><input id="Email" type="text" style="width: 100%;" tabindex="7" name="Email"  value = ''> </td>  
          <td style="width: 13%;">
          <select id="Shipvia" style="width: 100%;" onchange="UpdateShipVia()" tabindex="8" name="Shipvia">
               <option value="O-TRUCK">O-TRUCK</option>
               <option value="RAILCAR">RAILCAR</option>
               <option value="VMI">VMI</option>
               <option value="CUST-PU">CUST-PU</option>
          </select></td>
          <td style="width: 15%;"><input id="Conf" style="width: 100%;" tabindex="9" name="Conf" type="text"></td>
          <td style="width: 19%;">
          <select id="Terms" style="width: 100%;" tabindex="10" name="Terms">
               <?php unset($this->_sections['TAssign']);
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['term']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['TAssign']['show'] = true;
$this->_sections['TAssign']['max'] = $this->_sections['TAssign']['loop'];
$this->_sections['TAssign']['step'] = 1;
$this->_sections['TAssign']['start'] = $this->_sections['TAssign']['step'] > 0 ? 0 : $this->_sections['TAssign']['loop']-1;
if ($this->_sections['TAssign']['show']) {
    $this->_sections['TAssign']['total'] = $this->_sections['TAssign']['loop'];
    if ($this->_sections['TAssign']['total'] == 0)
        $this->_sections['TAssign']['show'] = false;
} else
    $this->_sections['TAssign']['total'] = 0;
if ($this->_sections['TAssign']['show']):

            for ($this->_sections['TAssign']['index'] = $this->_sections['TAssign']['start'], $this->_sections['TAssign']['iteration'] = 1;
                 $this->_sections['TAssign']['iteration'] <= $this->_sections['TAssign']['total'];
                 $this->_sections['TAssign']['index'] += $this->_sections['TAssign']['step'], $this->_sections['TAssign']['iteration']++):
$this->_sections['TAssign']['rownum'] = $this->_sections['TAssign']['iteration'];
$this->_sections['TAssign']['index_prev'] = $this->_sections['TAssign']['index'] - $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['index_next'] = $this->_sections['TAssign']['index'] + $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['first']      = ($this->_sections['TAssign']['iteration'] == 1);
$this->_sections['TAssign']['last']       = ($this->_sections['TAssign']['iteration'] == $this->_sections['TAssign']['total']);
?>
                   <option value=<?php echo $this->_tpl_vars['indx'][$this->_sections['TAssign']['index']]; ?>
><?php echo $this->_tpl_vars['term'][$this->_sections['TAssign']['index']]; ?>
</option>
               <?php endfor; endif; ?>
          </select></td>
          <td style="width: 15%;">
          <select id="Fob" style="width: 100%;" tabindex="11" name="Fob">
               <option value="DELIVERED">DELIVERED</option>
               <option value="MILL">MILL</option>
          </select></td>
          <td style="width: 13%;"><input id="Buyer" type="text" style="width: 100%;" tabindex="72" name="Buyer" readonly="readonly" value = <?php echo $this->_tpl_vars['buyer']; ?>
> </td>
        </tr>
        </tbody>
      </table>
    </form>
      <?php echo '
      <hr>
      <TABLE id="list" class="scroll" style="font-size: 12px; width: 100%;"></TABLE>
      <div id="pager" class="scroll" style="text-align:center;"></div
      <hr>
      '; ?>

      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 56%;">
          <div class="center">
             <button id="ALine" type="button" tabindex="12" onClick="javascript:AddL();">Add Line</button>
             <button id="ELine" type="button" tabindex="13" onClick="javascript:EditL();">Edit Line</button>
             <button id="ILine" type="button" tabindex="14" onClick="javascript:InsL();">Insert Line</button>
             <button id="DLine" type="button" tabindex="15" onClick="javascript:DelL();">Delete Line</button>
          </div></td>
          <td style="color: black; width: 13%;"><b>Total board feet:</b></td>
          <td style="color: blue; width: 10%;"><b><span Id = "bftotal"></span></b></td>
          <td style="width: 2%;"></td>
          <td style="color: black; width: 8%;"><b>Total cost:</b></td>
          <td style="color: blue; width: 10%;"><b><span Id = "pctotal"></span></b></td>
          <td><input id="POAmt" type="hidden" name="POAmt"</td>
        </tr>
        </tbody>
      </table>
      <hr>
      <table style="width: 100%;">
        <tbody>
        <tr>
          <td style="width: 20%;">
             <div class="center">
             <button id="FileSave" type="button" tabindex="16" onClick="javascript:POSave();">Save</button>
             <button id="FileNew" type="button" tabindex="17" onClick="javascript:UpdateOrd('0');">Reset</button>
             <button id="FilePrint" type="button" tabindex="18" onClick="javascript:PrintOrd();">Print</button>
             </div></td>
           <td style="width: 5%;"></td>
           <td style="color: red; width: 75%;"><b><span id="msg"></span></b></td>
        </tr>
        </tbody>
      </table>
    <script language="JavaScript">
         UpdateShip(1);
         $("#FileSave").attr('disabled',true);
         $("#OrdPrefix").focus();
    </script>
    </div>
    <div id="input-dialog" class="modal-dialog">
        <div id="dialog-detail"></div>
    </div>
  </body>
</html>