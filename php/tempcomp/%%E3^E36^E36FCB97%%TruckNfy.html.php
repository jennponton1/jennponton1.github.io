<?php /* Smarty version 2.6.13, created on 2012-03-16 10:51:50
         compiled from C:%5Cinetpub%5Cwwwroot%5CLogistics%5CTruckList%5Cviews%5CTruckNfy.html */ ?>
  <form method=POST name=TruckNfy id=TruckNfy <?php echo $this->_tpl_vars['form']['attributes']; ?>
> <?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE>
        <TR>
           <TD><B><h4><?php echo $this->_tpl_vars['form']['RptName']['label']; ?>
</B></TD>
        </TR>
  </TABLE>
  <TABLE>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['sendto']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['sendto']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['subject']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['subject']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['txtbody']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['txtbody']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD<B><?php echo $this->_tpl_vars['form']['releasedate']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['releasedate']['html']; ?>
&nbsp;&nbsp;<A HREF='javascript:void(0)'
                  ONCLICK='call_calendar_monthly(document.TruckNfy.releasedate);'><IMG
                  SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
                 <FONT SIZE='-2'>Click for a calendar</FONT><br>&nbsp;Use (mm/dd/YYYY) Format </TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['vendorName']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['vendorName']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['millcity']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['millcity']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['millstate']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['millstate']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['millphone']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['millphone']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['millrefnbr']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['millrefnbr']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['nbroftrks']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['nbroftrks']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['comnt']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['comnt']['html']; ?>
</TD>
        </TR>
  </TABLE>
  <TABLE>
        <TR> 
           <TD></TD>
        </TR>
        <TR>
           <TD><B><?php echo $this->_tpl_vars['form']['msg']['label']; ?>
</B></TD>
        </TR>
  </TABLE>
  <TABLE>
        <TR>
           <TD style = "width: 19%;"><B><?php echo $this->_tpl_vars['form']['notes']['label']; ?>
</B></TD>
           <TD><?php echo $this->_tpl_vars['form']['notes']['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['notify']['html']; ?>
</TD>
           <TD style = "color: red;"><b><?php echo $this->_tpl_vars['form']['EMSG']['html']; ?>
</b></TD>
        </TR>
  </TABLE>

  </form>