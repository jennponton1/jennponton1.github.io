<?php /* Smarty version 2.6.13, created on 2013-12-26 09:22:56
         compiled from C:%5Cinetpub%5Cwwwroot%5Chist_builders%5Cbcsumm%5Cviews%5CBndlDisplay.html */ ?>
<form method=POST name=BndlDisplay id=BndlDisplay <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
      <TR>
         <TD style = "font-size: 24; width: 100%", align='center';><B>Bundle Count Summary for <?php echo $this->_tpl_vars['RptDate']; ?>
</B></TD>
      </TR>
  </TABLE>
  
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
            <hr>
            <br>     
           <TD style = "color: red; width: 100%;"><b><?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</b></TD>
        </TR>
     </TABLE>
     <TABLE style = "width: 100%">
        <TR>
           <br>
           <hr>
        </TR>
     </TABLE>
 <?php endif; ?>
   <TABLE style = "width: 100%">
      <TR>
         <TD style = "width: 8%;"><?php echo $this->_tpl_vars['form']['exit']['html']; ?>
</TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['prtlink']['html']; ?>
</TD>
         <TD style = "width: 75%;"></TD>
      </TR>
   </TABLE>
</form>