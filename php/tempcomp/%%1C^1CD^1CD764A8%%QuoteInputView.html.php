<?php /* Smarty version 2.6.13, created on 2011-10-14 15:36:21
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes2/views/QuoteInputView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="/jquery/datatablecss/datatable.css"/>
      <!--  <link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet" /> -->
        <style type=text/css>
       <?php echo '
               html, div {font-size: 80%;}
               html, body {
               margin: 0;
               padding: 0;
               font-size: 85%;
               }
               .ui-dialog-titlebar-close{
                 display: none;
               }
               .help-div { 
                 display:none;
                 font-size: 100%; 
                 position:absolute;
               }
               .gridlist {
                 borders: thin solid black;
               }
               .row_selected: {
                 background: #CCCCCC;
               }
        </style>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<!--        <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script> -->
      <script  src="/jquery/jquery.datatables.js" ></script>
        <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="views/shortcut.js"></script>
        <script type="text/javascript" src="views/QuoteInput.js"></script>
        <script type="text/javascript" src="views/setUp.js"></script>
'; ?>

</head>
<body>
<!--    <table style="background-color:black; color: white;" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="main_header">
            <td align="left" width="25%"><?php echo $this->_tpl_vars['title']; ?>
</td>
            <td align="center" width="25%"><?php echo $this->_tpl_vars['username']; ?>
</td>
            <td align="right" width="25%"><?php echo date("l F d,Y"); ?></td></tr>
    </table>  -->
    <div style="background-color:#eeeeee">
        <form action="" method=POST name=QuoteInputView id=QuoteInputView <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
              <div background-color:#eeeeee>
                <input type='hidden' name='OpenQuote' id='OpenQuote'>
                <input type='hidden' name='Reason'    id='Reason'     value="0">
                <input type='hidden' name='ShipVia'   id='ShipVia'    value="TRUCK">
                <input type='hidden' name='Siteid'    id='Siteid'>
                <input type='hidden' name='AltEmail'  id='AltEmail'>
                <input type='hidden' name='Altused'   id='Altused'>
                <input type='hidden' name='Altid'     id='Altid'      value="0">
                <input type='hidden' name='Altlname'  id='Altlname'>
                <input type='hidden' name='Altfname'  id='Altfname'>
                <input type='hidden' name='Altaddr1'  id='Altaddr1'>
                <input type='hidden' name='Altaddr2'  id='Altaddr2'>
                <input type='hidden' name='Altcity'   id='Altcity'>
                <input type='hidden' name='Altstate'  id='Altstate'>
                <input type='hidden' name='Altzip'    id='Altzip'>
                <input type='hidden' name='Altphone'  id='Altphone'>
                <input type='hidden' name='Altfax'    id='Altfax'>
                <br>
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:9%;"><b>&nbsp;Quote Number:</b></td>
                            <td style="width:6%;"><input id="QuoteNbr" type="text" style="width:100%;" name="QuoteNbr" tabindex="30" onblur="loadQuote()"value=<?php echo $this->_tpl_vars['QuoteNbr']; ?>
></td>
                            <td style="width:4%;"><input id="RevNbr" type="text" style="width:80%;  background-color:#dddddd;" name="RevNbr" readonly="readonly" value=''></td>
                            <td style="width:2%;">&nbsp;</td>
                            <td style="width:10%;"><button id="UpdateCost" type="button" tabindex="31" onClick="javascript:CostUpdate();">Update Pricing</button></td>
                        <td style="width:16.5%;">&nbsp;</td>
                            <td align="right" style="width:9%;"><b>Retrieve Quote:</b></td>
                            <td style="width:13%;">
                                <select id="RptType" style="width:100%;" tabindex="32" name="RptType" onChange="javascript:searchQuotes();">
                                    <option value="0">Select Search Option</option>
                                    <option value="1">Salesman</option>
                                    <option value="2">Customer</option>
                                    <option value="3">All Open</option>
                                </select></td>
                            <td align="right" style="width:8%;"><b>Salesperson:</b></td>
                            <td style="width:5%;"><input id="SlsPer" type="text" style="width:70; background-color:#dddddd;" name="SlsPer" readonly="readonly" value=<?php echo $this->_tpl_vars['Slsper']; ?>
></td>
                            <td align="right" style="width:8%;"><b>Quote Date:</b></td>
                            <td style="width:6%;"><input id="IssueDate" type="text" style="width:100%; background-color:#dddddd;" name="IssueDate" readonly="readonly" value=<?php echo $this->_tpl_vars['QDate']; ?>
></td>
                            <td style="width:0.5%;">&nbsp;</td></tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div style="width:24%; height:18%; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:7%;"><b>&nbsp;Customer:</b></td>
                            <td style="width:40%;"><input type="text" id="Custid" name="Custid" style="width:85%;" tabindex="1" onchange="updateCust()" value=<?php echo $this->_tpl_vars['Custid']; ?>
>&nbsp; <span id="cust_help" class="help_span" style="padding:2px; border:thin solid black; color:white; background:green;" >?&nbsp;</span></td></tr>
                        <tr><td style="width:7%;"><b>&nbsp;Contact:</b></td>
                            <td style="width:40%;"><input type="text" id="Contact" name="Contact" style="width:100%;" tabindex="2" ></td></tr>
                        <tr><td style="width:7%;"><b>&nbsp;Email:</b></td>
                            <td style="width:40%;"><input type="text" id="Email" name="Email" style="width:100%;" tabindex="3"></td></tr>
                      </tbody> 
                </table>
                <table style="width:100%;">
                      <tbody>
                        <tr><td style="width:7%;">&nbsp;</td>
                            <td align="right" style="color:red; width:37%;"><span id="More"></span></td>
                            <td align="right" style="width:3%;"><button type="button" id="AdEmail" name="AdEmail" tabindex="4" onClick="javascript:Emailedit()">Adtl.Email</button></td></tr>
                      </tbody>
                </table>
            </div>
            <div style="width:2%; height:18%; background-color:#eeeeee; float:left">
            </div>
            <div style="width:35%; height:18%; background-color:#eeeeee; float:left">
                <div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="edittab">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active" ><a href="#edittab-1" tabindex="5" onclick="setShipVia('TRUCK'), calcPlant()">TRUCK</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#edittab-2" tabindex="11" onclick="setShipVia('RAILCAR'),calcPlant()">RAILCAR</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#edittab-3" tabindex="15" onclick="setShipVia('CUST-PU'),calcPlant()">CUST-PU</a></li>
                    </ul>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom" id="edittab-1">
                        <table style="width:100%;">
                            <tbody>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:3%;"><b>State:</b></td>
                                    <td style="width:9%;">
                                        <select id="State" name="State" style="width:95%; height:24px; font-size:14px;" tabindex="6" onchange="buildCities()">
                                            <?php unset($this->_sections['TAssign']);
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['state']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
><?php echo $this->_tpl_vars['state'][$this->_sections['TAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                                    <td align="right" style="font-size:14px; font-family:Times,serif; width:3%;"><b>City:</b></td>
                                    <td style="width:28%;">
                                        <select id="CityLst" style="width:100%; height:24px; font-size:14px;" tabindex="7" onchange="buildRates(1)" name="CityLst">
                                            <option value="">&nbsp;</option>
                                        </select></td></tr>
                            </tbody>
                        </table>
                        <table style="width:100%;">
                            <tbody>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:3%;"><b>Rate:</b></td>
                                    <td style="width:12%;"><input type="text" name="TrkRate" style="width:90%; height:24px; font-size:14px;" tabindex="8" onchange="calcRates()" id="TrkRate"></td>
                                    <td align="right" style="font-size:14px; font-family:Times,serif; width:4%;"><b>Plant:</b></td>
                                    <td style="width:22%;">
                                        <select id="RateLst" style="width:100%; height:24px; font-size:14px;" tabindex="9" onchange="calcPlant()" name="RateLst">
                                            <option value=" ">&nbsp;</option>
                                        </select></td></tr>
                            </tbody>
                        </table>
                        <table style="width:100%;">
                            <tbody>
                                <tr> <td style="width:3%; font-size:14px; font-family:Times,serif;"><b>Est.Trucks:</b></td>
                                     <td style="width:3%;"><input id="NbrTrks" type="text" style="width:100%; height:24px; background-color:#dddddd; font-size:14px;" name="NbrTrks" readonly="readonly" value=1></td>
                                     <td align="right" style="width:6%; font-size:14px; font-family:Times,serif;"><b>Est.Rem.Cap.:</b></td> 
                                     <td style="width:5%;"><input id="TrkPcnt" type="text" style="width:100%; height:24px; background-color:#dddddd; font-size:14px;" name="TrkPcnt" readonly="readonly" value=100%></td>
                                     <td align="right" style="font-size:14px; font-family:Times,serif; width:17%;"><button id="AdjFrt" type="button" tabindex="10" onClick="javascript:adjustFrt();">Adjust Freight</button></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-2">
                        <table style="width:100%;">
                            <tbody>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:5%;"><b>Rail Rate:</b></td>
                                    <td style="width:24%;"><input type="text" name="RailRate" style="width:35%; height:24px; font-size:14px;" tabindex="12" onchange="calcRates()" value=0 id="RailRate"></td></tr>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:10%;"><b>Delivery Carrier:</b></td>
                                    <td style="width:24%;"><input type="text" name="Carrier" style="width:100%; height:24px; font-size:14px;" tabindex="13" value='' id="Carrier"></td></tr>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:5%;"><b>Plant:</b></td>
                                    <td style="width:24%;">
                                        <select id="Plant" style="width:60%; height:24px; font-size:14px;" tabindex="14" onchange="calcPlant()" name="Plant">
                                            <?php unset($this->_sections['SAssign']);
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
                                            <option value=<?php echo $this->_tpl_vars['site'][$this->_sections['SAssign']['index']]; ?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-3">
                        <table style="width:100%;">
                            <tbody>
                                <tr><td style="font-size:14px; font-family:Times,serif; width:5%;"><b>FOB:</b></td>
                                    <td style="width:24%;">
                                        <select id="FOB" style="width:60%; height:24px; font-size:14px;" tabindex="16" onchange="calcPlant()" name="FOB">
                                            <?php unset($this->_sections['SAssign']);
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
                                                <option value=<?php echo $this->_tpl_vars['site'][$this->_sections['SAssign']['index']]; ?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script type="text/javascript">
                    $("#edittab").tabs();
                </script>
            </div>
            <div style="width:2%; height:18%; background-color:#eeeeee; float:left">
            </div>
            <div style="width:7%; height:18%; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:20%;"><button id="AltAddr" type="button" style="width:100%;" tabindex="17" onClick="javascript:AltAddress();">Alt.Ship</button></td></tr>
                        <tr><td align="right"><span id="ship_help" class="help_span" style="padding:2px; border:thin solid black; color:white; background:green;" >?&nbsp;</span></td></tr> 
                    </tbody>
                </table>
            </div>
            <div style="width:30%; height:18%; background-color:#eeeeee; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:100%;"><textarea id="CustAddr" style="width:100%; background-color:#dddddd;" rows="8" cols="35" readonly="readonly" name="CustAddr"></textarea></td></tr>
                    </tbody>
                </table>
            </div>
            <div style="width:100%">
                <div style="width:.5%; height:39.5%; background-color:#eeeeee; float:left">
                </div>
                <div style="width:99%; background-color:#eeeeee; float:left">
                    <hr>
                    <TABLE id="list" class="scroll gridlist display" style="font-size:12px; width:99%;">
                        <thead>
                            <tr>
<!--                                <th>ID</th>  -->
                                <th>FrtFct</th>
                                <th>BF</th>
                                <th>TSize</th>
                                <th>Invtid</th>
                                <th>Descr</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>BU</th>
                                <th>Wood Cost</th>
                                <th>Treatmt Cost</th>
                                <th>Stocking Disc</th>
                                <th>Addl Disc</th>
                                <th>Addl Chgs</th>
                                <th>TL Freight</th>
                                <th>Total</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </TABLE>
                    <hr>
                </div>
                <div style="width:.5%; height:39.5%; background-color:#eeeeee; float:left">
                </div>
            </div>
            <div>
                <div class="left" style="width:50%; height:5%; background-color:#eeeeee; float:left">
                    <table style="width:100%;">
                        <tbody>
                            <tr><td style="width:42%;">
                                <button id="ALine" type="button" tabindex="18" onClick="javascript:AddL();">Add Line</button>
                                <button id="ELine" type="button" tabindex="19" onClick="javascript:EditL();">Edit Line</button>
                                <button id="DLine" type="button" tabindex="20" onClick="javascript:DelL();">Delete Line</button></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="left" style="width:50%; height:5%; background-color:#eeeeee; float:right">
                    <table style="width:100%;">
                        <tbody>
                            <tr><td align="right" style="width:8%;"><b>Lead Time:&nbsp;</b></td>
                                <td style="width:29%;"><input id="LeadTime" style="width:85%;" tabindex="21" name="LeadTime" type="text"></td>
                                <td align="right" style="width:7%;"><b>Total BF:&nbsp;</b></td>
                                <td style="width:13%;"><input id="TotBF" style="width:96%; background-color:#dddddd;" name="TotBF" readonly="readonly" type="text" value=''></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
            <div style="width:50%; height:25.5%; background-color:#eeeeee; float:left">
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                               <tr><td align="right" style="width:14%;"><b>Order Comments:&nbsp;</b></td>
                               <td style="width:54%;"><textarea id="Instr" style="width:100%;" rows="8" cols="50" tabindex="22" name="Instr"></textarea></td></tr>
                        </tbody>
                    </table>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td align="right" style="width:14%;"><b>Follow Up:&nbsp;</b></td>
                                <td style="width:53%;"><input id="FollowUp" style="width:15%;" tabindex="23" name="FollowUp" type="text" value=''></td>
                                <td style="width:1%;"><span id="comment_help" class="help_span" style="padding:2px; border:thin solid black; color:white; background:green;" >?&nbsp;</span></td> 
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                            <tr><td style="width:2%;"><button id="FileSave" type="button" tabindex="25" onClick="javascript:QuoteVerify();">Save</button></td>
                                <td style="width:2%;"><button id="FileNew" type="button" tabindex="26" onClick="javascript:Reset();">Reset</button></td>
                                <td style="width:2%;"><button id="FileEmail" type="button" tabindex="27" onClick="javascript:QuoteEmail();">Email</button></td>
                                <td style="width:25.5%;"><button id="FileOrder" type="button" tabindex="28">Make Order</button></td>
                                <td align="right" style="width:12%;"><b>Close Quote:</b></td>
                                <td style="width:10.5%;"><input type=checkbox name=Closeq id=Closeq tabindex=29></td></tr>
                        </tbody>
                    </table>
                </div>
                <div style="width:50%; height:25.5%; background-color:#eeeeee; float:left">
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                            <tr><td align="right" style="width:14%;"><b>Internal Notes:&nbsp;</b></td>
                                <td style="width:54%;"><textarea id="Notes" style="width:100%;" rows="8" cols="50" tabindex="24" name="Notes"></textarea></td></tr>
                        </tbody>
                    </table>
                    <table style="width:100%;">
                        <tbody>
                            <tr><td style="width:1%;"><input id="PlaceH" style="width:1%" type="text"></td>
                                <td style="width:19%;">&nbsp;</td>
                                <td style="width:1%;"><span id="notes_help" class="help_span" style="padding:2px; border:thin solid black; color:white; background:green;" >?&nbsp;</span></td> 
                                <td style="width:47;">&nbsp;</td></tr>
                        </tbody>
                    </table>
               <div>
                    <hr>
                    <table style="width:100%;">
                       <tbody>
                           <tr><td style="color:red; width:68%;"><b><span id="Msg"></span></b></td></tr>
                       </tbody>
                    </table>
               </div>
            </div>
            </div>
        </form>
    </div>
    <script type="text/javascript"> document.getElementById("Custid").focus(); </script>
    <div id="input-dialog" class="modal-dialog">
        <div id="dialog-detail"></div>
    </div>
    <div class="help-div" id="cust_help-div">When entering a new quote, it is vital that the customer be entered first as all other information is based on the individual customer. When
                                             specifying an existing quote, the customer can not be changed.</div>
    <div class="help-div" id="comment_help-div">Comments entered in the Order Comments field will be visible to the customer on the sales order.</div>
    <div class="help-div" id="notes_help-div">Comments entered in the Internal Notes will be visible only to Hoover personnel.</div>
    <div class="help-div" id="ship_help-div">An alternate shipping address can be specified rather than the address on file for the designated customer.</div>
</body>
</html>