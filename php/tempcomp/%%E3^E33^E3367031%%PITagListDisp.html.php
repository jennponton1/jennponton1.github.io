<?php /* Smarty version 2.6.13, created on 2012-08-06 11:45:04
         compiled from C:%5Cinetpub%5Cwwwroot%5CPhysInv%5Cviews%5CPITagListDisp.html */ ?>
<script type="text/javascript">
<?php echo '
var winConfirm = null;
function showConfirm(act,tagnbr,vkey,vsite) {
   if (confirm("Are you sure you want to delete tag number " + tagnbr + "?")) {
       document.getElementById(\'do\').value = \'delete\';
       document.getElementById(\'origtag\').value = tagnbr;
       document.getElementById(\'vkey\').value = vkey;
       document.getElementById(\'vsite\').value = vsite;
       document.getElementById(\'PITagListDisp\').submit();
   }
}
'; ?>

</script>

<form method=POST name=PITagListDisp id=PITagListDisp <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <INPUT TYPE="hidden" name="origtag" id="origtag" value="not set">
  <INPUT TYPE="hidden" name="vkey" id="vkey" value="not set">
  <INPUT TYPE="hidden" name="vsite" id="vsite" value="not set">
  <TABLE style = "width: 100%">
      <TR>
         <TD><?php echo $this->_tpl_vars['form']['htTable']['label']; ?>
</TD>
      </TR>
      <TR>
         <TD><B><?php echo $this->_tpl_vars['form']['msg']['html']; ?>
</B></TD>
      </TR>
  </TABLE>
  <TABLE style = "width: 100%">
      <TR>
         <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['prtlink']['html']; ?>
</TD>
         <?php if ($this->_tpl_vars['CanEdit']): ?>
             <TD style = "width: 4%;"></TD>
             <TD style = "width: 12%;"><A href='TagPage.php?act=Add&vkey=<?php echo $this->_tpl_vars['vkey']; ?>
&vsite=<?php echo $this->_tpl_vars['vsite']; ?>
'>Add New Tag</A>
             <TD style = "width: 4%;"></TD>
             <TD style = "width: 15%;"><A href='RptMenu.php?vkey=<?php echo $this->_tpl_vars['vkey']; ?>
&vsite=<?php echo $this->_tpl_vars['vsite']; ?>
'>Report Menu</A></TD>
             <TD style = "width: 4%;"></TD>
             <TD style = "width: 30%;"><a href='PhysicalInventory.php'>Return to Physical Inventory Main Menu</a></TD>
             <TD style = "width: 18%;"></TD>
         <?php else: ?>
             <TD style = "width: 20%;"></TD>
             <TD style = "width: 15%;"><A href='RptMenu.php?vkey=<?php echo $this->_tpl_vars['vkey']; ?>
&vsite=<?php echo $this->_tpl_vars['vsite']; ?>
'>Report Menu</A></TD>
             <TD style = "width: 4%;"></TD>
             <TD style = "width: 30%;"><a href='PhysicalInventory.php'>Return to Physical Inventory Main Menu</a></TD>
             <TD style = "width: 18%;"></TD>
         <?php endif; ?>
      </TR>
  </TABLE>

</form>