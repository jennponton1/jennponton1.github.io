<?php /* Smarty version 2.6.13, created on 2012-07-05 10:46:00
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs%5Cviews%5CRevenueETLEdit.html */ ?>
<form method=POST name=fmRevenueETLEdit id=fmRevenueETLEdit <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 100%">
     <br>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['dtnbr']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['dtnbr']['html']; ?>
</TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['invcdate']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['invcdate']['html']; ?>
</TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['invcnbr']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['invcnbr']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['custid']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['custid']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['ordnbr']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['ordnbr']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['shipcity']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['shipcity']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['shipstate']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['shipstate']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['fob']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['fob']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['shipvia']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['shipvia']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['carrier']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['carrier']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['bdft']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['bdft']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['freight']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['freight']['html']; ?>
</TD>
        <TD style = "width: 72%;"></TD>
     </TR>
  </TABLE>
    
  <TABLE style = "width: 100%">
     <TR>
        <hr>
        <TD style = "width: 1%;"></TD> 
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['save']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['cancel']['html']; ?>
</TD>
        <TD style = "color: red; width: 89%;"><b><?php echo $this->_tpl_vars['form']['Msg']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
	
</form>