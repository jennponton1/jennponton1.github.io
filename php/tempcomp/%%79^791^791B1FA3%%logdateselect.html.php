<?php /* Smarty version 2.6.13, created on 2012-12-20 10:48:09
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cvoucherentry%5Cviews%5Clogdateselect.html */ ?>
<form method=POST name=fmlogdateselect id=fmlogdateselect <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 100%">
     <br>
     <TR>
        <TD style = "width: 12%;"><B><?php echo $this->_tpl_vars['form']['begindate']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['begindate']['html']; ?>
</TD>
        <TD style = "width: 80%;"></TD>
     </TR>
  </TABLE>
    
  <TABLE style = "width: 100%">
     <TR>
        <hr>
        <TD style = "width: 1%;"></TD> 
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
        <TD style = "color: red; width: 89%;"><b><?php echo $this->_tpl_vars['form']['Msg']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
	
</form>