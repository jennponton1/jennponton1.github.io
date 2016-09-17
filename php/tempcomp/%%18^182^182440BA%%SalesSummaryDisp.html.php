<?php /* Smarty version 2.6.13, created on 2011-04-05 18:51:29
         compiled from C:%5Cinetpub%5Cwwwroot%5CHooverModule%5CSalesSummary%5Cviews%5CSalesSummaryDisp.html */ ?>
<form method=POST name=SalesSummaryDisp id=SalesSummaryDisp <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
      <TR>
         <TD style = "font-size: 24; width: 100%", align='center';><B>Sales Summary for <?php echo $this->_tpl_vars['siteid']; ?>
<br>
         <?php if ($this->_tpl_vars['rptype'] == 'D'): ?>
             <?php echo $this->_tpl_vars['startdate']; ?>

             <?php if ($this->_tpl_vars['startdate'] != $this->_tpl_vars['enddate']): ?>
                 thru <?php echo $this->_tpl_vars['enddate']; ?>

             <?php endif; ?>
         <?php else: ?>
             fiscal period <?php echo $this->_tpl_vars['period']; ?>

         <?php endif; ?>
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
           <TD style = "color: red; width: 100%;"><b>No records selected for dates / site requested.</b></TD>
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