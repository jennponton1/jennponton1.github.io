<?php /* Smarty version 2.6.13, created on 2012-08-06 11:44:40
         compiled from C:%5Cinetpub%5Cwwwroot%5CPhysInv%5Cviews%5CPhysInvSelect.html */ ?>
<form method=POST name=PhysInvSelect id=PhysInvSelect <?php echo $this->_tpl_vars['form']['attributes']; ?>
> <?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
        <BR>
        <TR>
           <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['siteselect']['label']; ?>
</B></TD>
           <TD style = "width: 10%;"><B>&nbsp;<?php echo $this->_tpl_vars['form']['siteselect']['html']; ?>
</B></TD>
           <TD style = "width: 80%;"></TD>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
           <TD style = "width: 8%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
           <TD style = "width: 92%;"></TD>
        </TR>
  </TABLE>
</form>