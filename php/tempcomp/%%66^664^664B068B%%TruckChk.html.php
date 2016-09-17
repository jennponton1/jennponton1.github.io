<?php /* Smarty version 2.6.13, created on 2012-03-16 11:13:07
         compiled from C:%5Cinetpub%5Cwwwroot%5CLogistics%5CTruckList%5Cviews%5CTruckChk.html */ ?>
<form method=POST name=TruckChk id=TruckChk <?php echo $this->_tpl_vars['form']['attributes']; ?>
> <?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE>
        <TR>
           <TD><B><h4><?php echo $this->_tpl_vars['form']['RptName']['label']; ?>
</B></TD>
        </TR>
  </TABLE>
  <TABLE>
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['rType'][1]['html']; ?>
</TD>
        </TR>
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['rType'][2]['html']; ?>
</TD>
        </TR>
  </TABLE>
  <TABLE>
        <TR>
           <TD><br></TD>
        </TR>
        <TR>
           <TD><br></TD>
        </TR>
        <TR>
           <TD><?php echo $this->_tpl_vars['form']['branch']['html']; ?>
</TD>
           <TD style = "color: red;"><B>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</B></TD>
        </TR>
  </TABLE>

  </form>