<?php /* Smarty version 2.6.13, created on 2011-03-29 15:39:55
         compiled from C:%5Cinetpub%5Cwwwroot%5Cplugins%5CCustStatusDisp.html */ ?>
<form method=POST name=CustStatusDisp id=CustStatusDisp <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

<?php if ($this->_tpl_vars['status'] == 0): ?>
     <TABLE style = "width: 100%">
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['htTable']['label']; ?>
</TD>
        </TR>
     </TABLE>
 <?php else: ?>
     <TABLE style = "width: 100%">
        <TR>
            <br>
           <TD style = "color: red; width: 100%;"><b>No records on file for the customer specified.</b></TD>
        </TR>
     </TABLE>
     <TABLE style = "width: 100%">
        <TR>
           <br>
        </TR>
     </TABLE> 
 <?php endif; ?>
</form>