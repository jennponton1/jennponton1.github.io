<?php /* Smarty version 2.6.13, created on 2012-08-07 15:16:49
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs%5Cviews%5Csitedateselect.html */ ?>
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
     <TR>
        <TD style = "width: 7%;"><B><?php echo $this->_tpl_vars['form']['truck']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['truck']['html']; ?>
</TD>
        <TD style = "width: 83%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 7%;"><B><?php echo $this->_tpl_vars['form']['domestic']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['domestic']['html']; ?>
</TD>
        <TD style = "width: 83%;"></TD>
     </TR>
  </TABLE>
  <TABLE>
     <TR>
         <TD style ="width: 5%;"></TD>
         <TD style ="width: 32%;"><B>Enter Period Number -OR- Beg/End Dates:</b></td>
         <TD style ="width: 53%;"></td>
     </tr>
  </TABLE>
  <TABLE>
     <TR>
        <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['pernbr']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['pernbr']['html']; ?>
</TD>
        <TD style = "width: 80%;"></TD>
     </TR>
     <TR>
         <TD style ="width: 10%;"></TD>
         <TD style ="width: 10%;"><B>-OR-</b></td>
         <TD style ="width: 80%;"></td>
     </tr>
     <TR>
        <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['begdate']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['begdate']['html']; ?>
</TD>
        <TD style = "width: 80%;"></TD>
     </TR>
     <TR>
        <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['enddate']['label']; ?>
</B></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['enddate']['html']; ?>
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