<?php /* Smarty version 2.6.13, created on 2013-12-26 09:22:31
         compiled from C:%5Cinetpub%5Cwwwroot%5Chist_builders%5Cbcsumm%5Cviews%5CBndlInfoSelect.html */ ?>
<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js"></SCRIPT>
<form method=POST name=BndlDateSelect id=BndlDateSelect <?php echo $this->_tpl_vars['form']['attributes']; ?>
> <?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 100%">
        <TR>
           <TD style = "font-size: 24; width: 100%", align='center';><B>Bundle Count Summary Build</B></TD>
        </TR>
        <br>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <hr>
           <TD style = "width: 16%;"><B><?php echo $this->_tpl_vars['form']['bcdate']['label']; ?>
</B></TD>
           <TD style = "width: 30%;"><?php echo $this->_tpl_vars['form']['bcdate']['html']; ?>
&nbsp;<A HREF='javascript:void(0)'
                ONCLICK='call_calendar(document.BndlDateSelect.bcdate);'><IMG
                SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
                <FONT SIZE='-2'>Click for a calendar</FONT><br><FONT SIZE='-1'>Use (mm/dd/YYYY) Format</FONT></TD>
           <TD style = "width: 54%;"></TD>
           <br>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
           <TD style = "width: 14%;"><B>Select Sites:</B></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][1]['html']; ?>
</TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][2]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B>Select Report Type:</B></TD>
           <TD style = "width: 18%;"><?php echo $this->_tpl_vars['form']['task'][7]['html']; ?>
</TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][3]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"><?php echo $this->_tpl_vars['form']['task'][8]['html']; ?>
</TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][4]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"></TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][5]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"></TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][6]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"></TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
           <TD style = "width: 14%;"><B>Select Products:</B></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][9]['html']; ?>
</TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][10]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B>Select Wood Type:</B></TD>
           <TD style = "width: 18%;"><?php echo $this->_tpl_vars['form']['task'][15]['html']; ?>
</TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][11]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"><?php echo $this->_tpl_vars['form']['task'][16]['html']; ?>
</TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][12]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"><?php echo $this->_tpl_vars['form']['task'][17]['html']; ?>
</TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][13]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"></TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 14%;"></TD>
           <TD style = "width: 10%;"></TD>
           <TD style = "width: 2%;"></TD>
           <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['task'][14]['html']; ?>
</TD>
           <TD style = "width: 6%;"></TD>
           <TD style = "width: 16%;"><B></B></TD>
           <TD style = "width: 18%;"></TD>
           <TD style = "width: 24%;"></TD>
        </TR>
  </TABLE>
  <TABLE>
        <br>
        <hr>
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        </TR>
  </TABLE>
  <script language="JavaScript"> document.getElementById("bcdate").focus(); </script>
  </form>