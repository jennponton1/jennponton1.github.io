<?php /* Smarty version 2.6.13, created on 2012-09-27 12:28:36
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckRerun.html */ ?>
<form method=POST name=fmCheckRerun id=fmCheckRerun <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
        <TR>
           <TD style = "width: 13%;"><B>A check run dated </B></TD>
           <TD style = "color: red; width: 7%;"><B><?php echo $this->_tpl_vars['form']['paydate']['html']; ?>
</B></TD>
           <TD style = "width: 20%;"><B>remains to be processed.</B></TD>
           <TD style = "width: 60%;"></TD>
           <br>
        </TR>
  </TABLE>
  <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
           <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['selrerun']['html']; ?>
</TD>
           <TD style = "width: 1%;"></TD>
           <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['selnew']['html']; ?>
</TD>
           <TD style = "width: 89%;"></TD>
        </TR>
  </TABLE>
</form>