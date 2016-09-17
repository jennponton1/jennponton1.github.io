<?php /* Smarty version 2.6.13, created on 2012-02-13 17:15:45
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckProc5.html */ ?>
<form method=POST name=fmCheckProc5 id=fmCheckProc5 <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "color: blue; width: 23%;"><B>Input the following:</B></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><B>number of first bad check:</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['fbchknbr']['html']; ?>
</TD>
        <TD style = "color: red; width: 65%;"><b><?php echo $this->_tpl_vars['form']['MSG1']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><B>number of last bad check:</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['lbchknbr']['html']; ?>
</TD>
        <TD style = "color: red; width: 65%;"><b><?php echo $this->_tpl_vars['form']['MSG2']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 23%;"><B>new check starting number:</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['seednbr']['html']; ?>
</TD>
        <TD style = "color: red; width: 65%;"><b><?php echo $this->_tpl_vars['form']['MSG3']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <hr>
        <TD style = "width: 3%;"><?php echo $this->_tpl_vars['form']['test']['html']; ?>
</TD>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 3%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        <TD style = "width: 2%;"></TD>
        <TD style = "width: 3%;"><?php echo $this->_tpl_vars['form']['restart']['html']; ?>
</TD>
        <TD style = "color: red; width: 87%;"><b><?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</b></TD>
     </TR>
  </TABLE>
  <script language="JavaScript"> document.getElementById("fbchknbr").focus(); </script>
</form>