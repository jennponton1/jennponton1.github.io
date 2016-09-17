<?php /* Smarty version 2.6.13, created on 2011-03-11 15:27:17
         compiled from C:%5Cinetpub%5Cwwwroot%5Cutils%5CprintPO%5CViews%5CpoNbrPrmpt.html */ ?>
<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js">
</SCRIPT>

<form method=POST name=fmMain id=fmMain <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
      <?php echo $this->_tpl_vars['form']['hidden']; ?>

      <TABLE style = "width: 100%">
        <TR>
            <TD style = "font-size: 24; width: 100%"; align='center';><B><?php echo $this->_tpl_vars['form']['Title']['label']; ?>
</B></TD>
        </TR>
    </TABLE>
    <BR>
    <TABLE>
        <TR> 
            <TD><B><?php echo $this->_tpl_vars['form']['ponbr']['label']; ?>
</B></TD>
            <TD><B><?php echo $this->_tpl_vars['form']['ponbr']['html']; ?>
</B></TD>
        </TR>
        <TR><TD><?php echo $this->_tpl_vars['form']['viewReport']['html']; ?>
</TD></TR>
        <TR>
            <TD><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        </TR>
    </TABLE>
</form>
