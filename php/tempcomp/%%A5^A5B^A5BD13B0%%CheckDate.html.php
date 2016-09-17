<?php /* Smarty version 2.6.13, created on 2013-09-06 12:31:06
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckDate.html */ ?>
<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js"></SCRIPT>
<form method=POST name=fmCheckDate id=fmCheckDate <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 19%;"><B><?php echo $this->_tpl_vars['form']['paydate']['label']; ?>
</B></TD>
           <TD style = "width: 30%;"><?php echo $this->_tpl_vars['form']['paydate']['html']; ?>
&nbsp;<A HREF='javascript:void(0)'
                ONCLICK='call_calendar(document.fmCheckDate.paydate);'><IMG
                SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
                <FONT SIZE='-2'>Click for a calendar</FONT><br><FONT SIZE='-1'>Use (mm/dd/YYYY) Format</FONT></TD>
           <TD style = "width: 51%;"></TD>
           <br>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 19%;"><B><?php echo $this->_tpl_vars['form']['ddadj']['label']; ?>
</B></TD>
           <TD style = "width: 30%;"><?php echo $this->_tpl_vars['form']['ddadj']['html']; ?>
&nbsp;<A HREF='javascript:void(0)'
                ONCLICK='call_calendar(document.fmCheckDate.ddadj);'><IMG
                SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
                <FONT SIZE='-2'>Click for a calendar</FONT><br><FONT SIZE='-1'>Use (mm/dd/YYYY) Format</FONT></TD>
           <TD style = "width: 51%;"></TD>
           <br>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
           <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['selrun']['html']; ?>
</TD>
           <TD style = "width: 5%;"></TD>
           <TD style = "color: red; width: 90%;"><b><?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</b></TD>
        </TR>
  </TABLE>
  <script language="JavaScript"> document.getElementById("paydate").focus(); </script>
  </form>