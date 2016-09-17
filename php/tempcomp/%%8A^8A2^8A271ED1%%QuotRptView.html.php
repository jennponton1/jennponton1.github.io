<?php /* Smarty version 2.6.13, created on 2012-10-23 12:21:54
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Creports%5Copenquotes/views/QuotRptView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">  
        <title>Quotes</title>
        <link type="text/css" href="/globals/css/jquery/jquery-ui.css" media="screen" rel="stylesheet">
        <link type="text/css" href="/globals/css/jquery/ui.jqgrid.css" media="screen" rel="stylesheet">
        <?php echo '
        <style type="text/css">
               html, div {font-size: 100%;}
               html, body {
               margin: 0;
               padding: 0;
               font-size: 100%;
               }
               .ui-jqgrid .ui-jqgrid-htable th div {
                font-size: 14px;
               }               
               .ui-jqgrid tr.jqgrow td {
                font-size: 12px;
               }
               .ui-dialog-titlebar-close{
                 display: none;
               }
               .ui-dialog-content{
                 font-size:100%;
               }
               .ui-dialog-title{
                 font-size: 100%;
                 color:#000;
               }
               .ui-dialog .ui-dialog-buttonpane button {
                 font-size:100%;
               }
               .ui-jqgrid .ui-jqgrid-bdiv {
                 position: relative;
                 margin: 0;
                 padding: 0;
                 overflow-x:hidden;
                 overflow-y:auto;
                 text-align:left;
               }
               .ui-jqgrid {font-size:12px}
               .subclass td {
                 background-color: silver !important;
                 color: black !important;
                 font-size: 100%;
               }
               body,table,td,th,input,textarea,select {
                 font-family: Trebuchet, Tahoma, Verdana, Arial, sans-serif;
               }
               .entrylabel {
                 font-size: 10pt;
               }
               b {
                 font-size: 10pt;
               }
    </style>
        '; ?>

        <script type="text/javascript" src="/globals/js/jquery/jquery.js"></script>
        <script type="text/javascript" src="/globals/js/jquery/jquery-ui.js"></script>
        <script type="text/javascript" src="/globals/js/jquery/grid.locale-en.js"></script>
        <script type="text/javascript" src="/globals/js/jquery/jquery.jqGrid.js"></script> 
        <script type="text/javascript" src="views/QuotRpt.js"></script>
    </head>
    <body style="background-color:#eeeeee;">
    <form action="" method=POST name=QuotRptView id=QuotRptView <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
        <div>
            <input type='hidden' name='SortCustid' id='SortCustid'>
            <input type='hidden' name='SortSlsper' id='SortSlsper'>
               <div id="Param" style="height:18%; width:98%; left: 20px; position: relative; background-color:#eeeeee; float:left;">
               <br>    
               <div style="width:20%; background-color:#eeeeee; float:left;"> 
                    <fieldset style="background-color:#cccccc; color:blue; height:83%; font-weight:bold; border-color:#000000;">
                    <legend>&nbsp;Sort Parameters&nbsp;</legend>
                    <br>
                    <table style="width:100%;">
                        <tbody>
                            <tr><td style="width:16%;"><b>&nbsp;Customer:</b></td>
                                <td style="width:64%;">
                                        <select id="CustidSelect" name="CustidSelect" style="width:100%; height:24px;" tabindex="1" onchange="ReportSubmit(0)">
                                            <?php unset($this->_sections['TAssign']);
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['custid']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <option value=<?php echo $this->_tpl_vars['indxC'][$this->_sections['TAssign']['index']]; ?>
><?php echo $this->_tpl_vars['custid'][$this->_sections['TAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                            <tr><td style="width:16%;"><b>&nbsp;Salesman:</b></td>
                                <td style="width:64%;">
                                        <select id="SlsperSelect" name="SlsperSelect" style="width:35%; height:24px;" tabindex="2" onchange="ReportSubmit(0)">
                                            <?php unset($this->_sections['TAssign']);
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['slsper']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <option value=<?php echo $this->_tpl_vars['indxS'][$this->_sections['TAssign']['index']]; ?>
><?php echo $this->_tpl_vars['slsper'][$this->_sections['TAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                        </tbody>
                    </table>
                    </fieldset>
                </div>
                <div style="width:60%; background-color:#eeeeee; float:left">
                     <fieldset style="background-color:#cccccc; color:blue; height:83%; font-weight:bold; border-color:#000000;">
                     <legend>&nbsp; Search &nbsp;</legend>
                     <br>
                     <table style="width:100%;">
                           <tbody>
                               <tr><td style="width:20%;"><b>&nbsp;Material Search:</b></td>
                                   <td style="width:70%;"><input type="text" id="Desc" name="Desc" style="width:100%;" tabindex="3" value=''></td>
                                   <td align="right" style="width:10%;"><button id="Search" name="Search" type="button" tabindex="4" onClick="javascript:SearchFile(1);">Search</button></td></tr>
                           </tbody>
                     </table>
                     <table style="width:100%;">
                           <tbody>
                               <tr><td style="color:red; width:100%;"><span id="Msg"></span></td></tr>
                           </tbody>
                     </table>
                     </fieldset>
                </div>
               <div style="width:20%; background-color:#eeeeee; float:left">
                    <fieldset style="background-color:#cccccc; color:blue; height:83%;  font-weight:bold; border-color:#000000;">
                    <legend>&nbsp; Key &nbsp;</legend>
                    <table style="width:100%; font-size:11pt;">
                          <tbody>
                                <tr><td style="width:2%; color:black;">&nbsp;Black:</td>
                                    <td style="width:13%; color:black;">less than 7 days</tr>
                                <tr><td style="width:2%; color:blue;">&nbsp;Blue:</td>
                                    <td style="width:13%; color:black;">7 to 14 days</tr>
                                <tr><td style="width:2%; color:green;">&nbsp;Green:</td>
                                    <td style="width:13%; color:black;">15 to 21 days</tr>
                                <tr><td style="width:2%; color:red;">&nbsp;Red:</td>
                                    <td style="width:13%; color:black;">greater than 21 days</tr>
                          </tbody>
                    </table>
                    </fieldset>
                </div>
            </div>
            <div>
                <div id="GDisplay" style="height:68%; left: 20px; width:98%; position: relative; background-color:#eeeeee; float:left;">
                    <hr>
                    <table id="list" class="scroll"></table>
                    <hr>
                </div>
            </div>
            <div id="Cntrl" style="height:6%; width:98%; left: 20px; position: relative; background-color:#cccccc; float:left;">
                <table style="width:100%;">
                    <tbody>
                        <tr><td style="width:8%;"><button id="Reset" type="button" tabindex="5" onClick="javascript:QReset();">Quick Reset</button></td></tr>
                   </tbody>
                </table>
            </div>
        </div>
    </form>
    <script type="text/javascript"> document.getElementById("CustidSelect").focus(); </script>
    <div id="input-dialog" class="modal-dialog">
        <div id="dialog-detail"></div>
    </div>
    </body>
    </html>