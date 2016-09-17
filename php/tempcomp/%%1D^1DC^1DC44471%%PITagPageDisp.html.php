<?php /* Smarty version 2.6.13, created on 2012-08-06 11:53:31
         compiled from C:%5Cinetpub%5Cwwwroot%5CPhysInv%5Cviews%5CPITagPageDisp.html */ ?>
<script type="text/javascript">
<?php echo '
 document.getElementById(\'newTag\').focus();
 function doCustLookup(){
   var newWin = window.open("/lookups/CustLup.php","NewWin","width=640,top=50, left=50, height=480,toolbar=no, resizable=yes");
 }
 function doInvtidLookup(){
   var newWin = window.open("/lookups/InvtidLup.php","NewWin","width=640,top=50, left=50, height=480,toolbar=no, resizable=yes");
 }
'; ?>

</script>

<form method=POST name=PITagPageDisp id=PITagPageDisp <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

  <TABLE style = "width: 100%">
      <TR>
         <TD style = "font-size: 20; width: 100%", align='center';><B><?php echo $this->_tpl_vars['form']['Title']['label']; ?>
</B></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
         <br>
         <hr>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['TagNum']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['TagNum']['html']; ?>
</TD>
         <TD style = "width: 12%;"></TD>
         <TD style = "color: red; width: 34%;"><B><?php echo $this->_tpl_vars['form']['TagErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B><?php echo $this->_tpl_vars['form']['TagKey']['label']; ?>
</B></TD>
         <TD style = "width: 7%;"><?php echo $this->_tpl_vars['form']['TagKey']['html']; ?>
</TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR> 
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['tStart']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['tStart']['html']; ?>
</TD>
         <TD style = "width: 12%;"><a href='javascript:doInvtidLookup();' method=post id=Invtid>Inventory Lookup</a></TD>
         <TD style = "color: red;width: 34%;"><B><?php echo $this->_tpl_vars['form']['InvErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B><?php echo $this->_tpl_vars['form']['SiteId']['label']; ?>
</B></TD>
         <TD style = "width: 7%;"><?php echo $this->_tpl_vars['form']['SiteId']['html']; ?>
</TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['Unit']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['Unit']['html']; ?>
</TD>
         <TD style = "width: 12%;"></TD> 
         <TD style = "width: 34%;"></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B><?php echo $this->_tpl_vars['form']['Action']['label']; ?>
</B></TD>
         <TD style = "width: 7%;"><?php echo $this->_tpl_vars['form']['Action']['html']; ?>
</TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['Qty']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['Qty']['html']; ?>
</TD>
         <TD style = "width: 12%;"></TD>
         <TD style = "color: red; width: 34%;"><B><?php echo $this->_tpl_vars['form']['QtyErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B></B></TD>
         <TD style = "width: 7%;"></TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['WLoc']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['WLoc']['html']; ?>
</TD>
         <TD style = "width: 12%;"></TD>
         <TD style = "color: red; width: 34%;"><B><?php echo $this->_tpl_vars['form']['WLocErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B></B></TD>
         <TD style = "width: 7%;"></TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR> 
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['custid']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['custid']['html']; ?>
</TD>
         <TD style = "width: 12%;"><a href='javascript:doCustLookup();' method=post id=custLookup>Customer Lookup</a></TD>
         <TD style = "color: red; width: 34%;"><B><?php echo $this->_tpl_vars['form']['CustErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B></B></TD>
         <TD style = "width: 7%;"></TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 10%;"><B><?php echo $this->_tpl_vars['form']['Ord']['label']; ?>
</B></TD>
         <TD style = "width: 15%;"><?php echo $this->_tpl_vars['form']['Ord']['html']; ?>
</TD>
         <TD style = "width: 12%;"></TD>
         <TD style = "color: red; width: 34%;"><B><?php echo $this->_tpl_vars['form']['OrdErr']['html']; ?>
</B></TD>
         <TD style = "width: 2%;"></TD>
         <TD style = "width: 6%;"><B></B></TD>
         <TD style = "width: 7%;"></TD>
         <TD style = "width: 2%;"></TD>
     </TR>
  </TABLE>
  <TABLE style = "width: 100%">
     <TR>
        <br>
        <hr>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 6%;"><?php echo $this->_tpl_vars['form']['save']['html']; ?>
</TD>
        <TD style = "width: 1%;"></TD>
        <TD style = "width: 6%;"><?php echo $this->_tpl_vars['form']['delete']['html']; ?>
</TD>
        <TD style = "width: 4%;"></TD>
        <TD style = "width: 30%;"><a href='TagList.php?isnew=N&vkey=<?php echo $this->_tpl_vars['vkey']; ?>
&site=<?php echo $this->_tpl_vars['siteid']; ?>
'>Return to Physical Inventory Tag List</a></TD>
        <TD style = "color: blue; width: 52%;"><B><?php echo $this->_tpl_vars['form']['Msg']['html']; ?>
</B></TD>
     </TR>
  </TABLE>
  <?php if ($this->_tpl_vars['action'] == 'Add'): ?>
      <script language="JavaScript"> document.getElementById("TagNum").focus(); </script>
  <?php else: ?>
      <script language="JavaScript"> document.getElementById("tStart").focus(); </script>
  <?php endif; ?>
  </form>