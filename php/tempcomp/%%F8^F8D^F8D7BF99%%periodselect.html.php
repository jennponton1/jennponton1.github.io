<?php /* Smarty version 2.6.13, created on 2012-07-05 10:06:32
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs%5Cviews%5Cperiodselect.html */ ?>
<form method=POST name=fmperiodselect id=fmperiodselect <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 25%">
     <br>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['pernbr']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['pernbr']['html']; ?>
</TD>
     </TR>
  </TABLE>
    
  <TABLE style = "width: 25%">
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