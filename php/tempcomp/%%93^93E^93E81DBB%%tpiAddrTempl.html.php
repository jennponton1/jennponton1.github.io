<?php /* Smarty version 2.6.13, created on 2011-10-24 08:26:55
         compiled from tpiAddrTempl.html */ ?>
	<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js">
    </SCRIPT>

     <form method=POST name=fmMain id=fmMain <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
     <?php echo $this->_tpl_vars['form']['hidden']; ?>

        <TABLE>  
        <TR> 
        <TD><B><?php echo $this->_tpl_vars['form']['deltckt']['label']; ?>
</B></TD>
        <TD><B><?php echo $this->_tpl_vars['form']['deltckt']['html']; ?>
</B></TD>
        </TR>
        <TR> 
        <TD><B><?php echo $this->_tpl_vars['form']['klnchg']['label']; ?>
</B></TD>
        <TD><B><?php echo $this->_tpl_vars['form']['klnchg']['html']; ?>
</B></TD>
        </TR>
        <TR>
        <TD><B><?php echo $this->_tpl_vars['form']['conaddress']['label']; ?>
</B></TD>
        <TD>
        
        <?php echo $this->_tpl_vars['form']['conaddress']['html']; ?>

        </TD></tr>
        <TR><TD><?php echo $this->_tpl_vars['form']['viewReport']['html']; ?>
</TD></TR>
	<TR>
	<TD><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
	</TR>
	</TABLE>
        </form>