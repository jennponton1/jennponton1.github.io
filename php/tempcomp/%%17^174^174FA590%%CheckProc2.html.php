<?php /* Smarty version 2.6.13, created on 2013-09-06 17:21:04
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckProc2.html */ ?>
<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js"></SCRIPT>
<form method=POST name=fmCheckProc2 id=fmCheckProc2 <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "font-size: 20; color: blue; width: 100%;"><b>Enter if required:</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><b>Starting Check Number:</b></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['Cnbr']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "color: red; width: 64%;"><b><?php echo $this->_tpl_vars['form']['MSG1']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><b>Starting Zero Check Number:</b></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['Znbr']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "color: red; width: 64%;"><b><?php echo $this->_tpl_vars['form']['MSG2']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <!--<TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><b>Starting EPay Check Number:</b></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['Enbr']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "color: red; width: 64%;"><b><?php echo $this->_tpl_vars['form']['MSG3']['html']; ?>
</b></TD>
     </TR>
  </TABLE>-->
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><b>Starting ACH Check Number:</b></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['Anbr']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "color: red; width: 64%;"><b><?php echo $this->_tpl_vars['form']['MSG4']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><b>Date Required On Checks:</b></TD>
        <TD style = "width: 30%;"><?php echo $this->_tpl_vars['form']['Fdate']['html']; ?>
&nbsp;<A HREF='javascript:void(0)'
            ONCLICK='call_calendar(document.fmCheckProc2.Fdate);'><IMG
            SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
            <FONT SIZE='-2'>Click for a calendar</FONT><br><FONT SIZE='-1'>Use (mm/dd/YYYY) Format</FONT></TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "color: red; width: 44%;"><b><?php echo $this->_tpl_vars['form']['MSG5']['html']; ?>
</b></TD>
        <br>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <hr>
        <TD style = "width: 3%;"><?php echo $this->_tpl_vars['form']['restart']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 3%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        <TD style = "color: red; width: 93%;"><b><?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <script language="JavaScript"> document.getElementById("Cnbr").focus(); </script>
</form>