<?php /* Smarty version 2.6.13, created on 2012-07-16 12:05:07
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs%5Cviews%5Csiteselect.html */ ?>
<form method=POST name=fmsiteselect id=fmsiteselect <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 100%">
     <br>
     <TR>
        <TD style = "width: 7%;"><B><?php echo $this->_tpl_vars['form']['siteid']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['siteid']['html']; ?>
</TD>
        <TD style = "width: 83%;"></TD>
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