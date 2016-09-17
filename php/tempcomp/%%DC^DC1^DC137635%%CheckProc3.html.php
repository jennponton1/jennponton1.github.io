<?php /* Smarty version 2.6.13, created on 2012-10-02 11:31:33
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckProc3.html */ ?>
<form method=POST name=fmCheckProc3 id=fmCheckProc3 <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "font-size: 20; color: blue; width: 100%;"><B>Select the task required:</B></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 14%;"><B>Zero Checks:</B></TD>
        <TD style = "width: 13%;"><?php echo $this->_tpl_vars['form']['prtzero']['html']; ?>
</TD>
        <TD style = "width: 11%;"></TD>
        <!--<TD style = "width: 11%;"><?php echo $this->_tpl_vars['form']['postzero']['html']; ?>
</TD>-->
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 59%;"><?php echo $this->_tpl_vars['form']['zerodetl']['html']; ?>
</TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 14%;"><B>Standard Checks:</B></TD>
        <TD style = "width: 13%;"><?php echo $this->_tpl_vars['form']['prtchks']['html']; ?>
</TD>
        <TD style = "width: 11%;"><?php echo $this->_tpl_vars['form']['postchks']['html']; ?>
</TD>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 59%;"><?php echo $this->_tpl_vars['form']['checkdetl']['html']; ?>
</TD>
     </TR>
  </TABLE>
  <!--<TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 14%;"><B>EPay Checks:</B></TD>
        <TD style = "width: 13%;"><?php echo $this->_tpl_vars['form']['prtepay']['html']; ?>
</TD>
        <TD style = "width: 11%;"><?php echo $this->_tpl_vars['form']['postepay']['html']; ?>
</TD>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 59%;"><?php echo $this->_tpl_vars['form']['edetl']['html']; ?>
</TD>
     </TR>
  </TABLE>-->
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 14%;"><B>ACH Checks:</B></TD>
        <TD style = "width: 13%;"><?php echo $this->_tpl_vars['form']['prtapay']['html']; ?>
</TD>
        <TD style = "width: 11%;"><?php echo $this->_tpl_vars['form']['postach']['html']; ?>
</TD>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 59%;"><?php echo $this->_tpl_vars['form']['adetl']['html']; ?>
</TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <hr>
            <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['restart']['html']; ?>
</TD>
            <TD style = "width: 1%;"></TD>
            <TD style = "width: 12%;"><?php echo $this->_tpl_vars['form']['test']['html']; ?>
</TD>
            <TD style = "width: 5%;"></TD>
            <TD style = "color: red; width: 77%;"><b><?php echo $this->_tpl_vars['form']['MSGX']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
</form>