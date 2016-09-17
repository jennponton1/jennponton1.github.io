<?php /* Smarty version 2.6.13, created on 2014-01-24 13:18:15
         compiled from C:%5Cinetpub%5Cwwwroot%5CProductionInformation%5CDataEntry%5CPrevMaintenance%5Cviews%5CMaintDisp3.html */ ?>
<form method=POST name=fmMaintDisp3 id=fmMaintDisp3 <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


  <TABLE style = "width: 100%">
         <TR>
            <TD style = "width: 10%;"><b><?php echo $this->_tpl_vars['form']['MN']['label']; ?>
</b></TD>
            <TD style = "width: 20%;"><?php echo $this->_tpl_vars['form']['MN']['html']; ?>
</TD>
            <TD style = "width: 70%;"></TD>
         </TR>
  </TABLE>

  <TABLE style = "width: 100%">
         <TR>
            <TD style = "width: 10%;"><b><?php echo $this->_tpl_vars['form']['Hardware']['label']; ?>
</b></TD>
            <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['Hardware']['html']; ?>
</TD>
            <TD style = "width: 80%;"></TD>
         </TR>
         <TR>
            <TD style = "width: 10%;"><b><?php echo $this->_tpl_vars['form']['YBuilt']['label']; ?>
</b></TD>
            <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['YBuilt']['html']; ?>
</TD>
            <TD style = "width: 80%;"></TD>
         </TR>
  </TABLE>

  <TABLE style = "width: 100%">
         <TR>
            <TD><br></TD>
         </TR>
         <TR>
            <TD style = "color: blue; width: 60%;"> Use codes: (N = new, R = rebuilt, E = existing) </TD>
            <TD style = "width: 40%;"></TD>
         </TR>
  </TABLE>

  <TABLE style = "width: 100%">
         <TR>
            <TD><?php echo $this->_tpl_vars['form']['htTable']['label']; ?>
</TD>
         </TR>
  </TABLE>

  <?php if ($this->_tpl_vars['maintstatus'] > 0): ?>
      <TABLE bgcolor = lightgray  style = "width: 84%">
             <TR>
                <TD style = "width: 11.5%;"></TD>
                <TD style = "width: 4%;"><?php echo $this->_tpl_vars['form']['butn1']['html']; ?>
</TD>
                <TD style = "width: 4%;"><?php echo $this->_tpl_vars['form']['butn2']['html']; ?>
</TD>
                <TD style = "width: 4%;"><?php echo $this->_tpl_vars['form']['butn3']['html']; ?>
</TD>
                <TD style = "width: 60.5%;"></TD>
             </TR>
      </TABLE>

      <TABLE bgcolor = lightgray  style = "width: 84%">
             <TR>
                <TD style = "width: 9%;"><b><?php echo $this->_tpl_vars['form']['Note']['label']; ?>
</B></TD>
                <TD style = "width: 74%;"><?php echo $this->_tpl_vars['form']['Note']['html']; ?>
</TD>
                <TD style = "width: 1%;"></TD>
             </TR>
      </TABLE>
      <TABLE style = "width: 100%">
             <TR>
                <TD><br></TD>
             </TR>
      </TABLE>
  <?php else: ?>
      <TABLE style = "width: 100%">
             <TR>
                <TD style = "width: 12%;"><b><?php echo $this->_tpl_vars['form']['Note']['label']; ?>
</B></TD>
                <TD style = "width: 60%;"><?php echo $this->_tpl_vars['form']['Note']['html']; ?>
</TD>
                <TD style = "width: 28%;"></TD>
             </TR>
      </TABLE>
  <?php endif; ?>

  <TABLE style = "width: 100%">
         <TR>
            <TD style = "width: 12%;"><b><?php echo $this->_tpl_vars['form']['MaintPerson']['label']; ?>
</b></TD>
            <TD style = "width: 20%;"><?php echo $this->_tpl_vars['form']['MaintPerson']['html']; ?>
</TD>
            <TD style = "width: 68%;"><?php echo $this->_tpl_vars['form']['MSG1']['html']; ?>
</TD>
         </TR>
         <TR>
            <TD style = "width: 12%;"><b><?php echo $this->_tpl_vars['form']['MaintForeM']['label']; ?>
</b></TD>
            <TD style = "width: 20%;"><?php echo $this->_tpl_vars['form']['MaintForeM']['html']; ?>
</TD>
            <TD style = "width: 68%;"><?php echo $this->_tpl_vars['form']['MSG2']['html']; ?>
</TD>
         </TR>
         <TR>
            <TD style = "width: 12%;"><b><?php echo $this->_tpl_vars['form']['MaintOpM']['label']; ?>
</b></TD>
            <TD style = "width: 20%;"><?php echo $this->_tpl_vars['form']['MaintOpM']['html']; ?>
</TD>
            <TD style = "width: 68%;"><?php echo $this->_tpl_vars['form']['MSG3']['html']; ?>
</TD>
         </TR>
  </TABLE>

  <TABLE style = "width: 100%">
         <TR>
            <TD><br></TD>
         </TR>
         <TR>
            <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['cancel']['html']; ?>
</TD>
            <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
            <TD style = "width: 5%;"></TD>
            <TD style = "color: red; width: 85%;"><b><?php echo $this->_tpl_vars['form']['EMSG']['html']; ?>
</b></TD>
         </TR>
  </TABLE>

  <?php if ($this->_tpl_vars['mStat'] == 0): ?>
      <script language="JavaScript"> document.getElementById("MN").focus(); </script>
  <?php elseif ($this->_tpl_vars['mStat'] == 1): ?>
      <script language="JavaScript"> document.getElementById("MaintForeM").focus(); </script>
  <?php elseif ($this->_tpl_vars['mStat'] == 2): ?>
      <script language="JavaScript"> document.getElementById("MaintOpM").focus(); </script>
  <?php elseif ($this->_tpl_vars['mStat'] == 9): ?>
  <?php else: ?>
      <script language="JavaScript"> document.getElementById("Note").focus(); </script>
  <?php endif; ?>

</form>