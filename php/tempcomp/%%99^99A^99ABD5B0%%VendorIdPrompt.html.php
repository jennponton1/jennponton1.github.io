<?php /* Smarty version 2.6.13, created on 2014-01-20 11:46:28
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CVendor%5Cviews%5CVendorIdPrompt.html */ ?>
<script src="/Ajax/jquery/jquery.js"></script>
<script>
    <?php echo '
        function vendorlookup() {
            var vend = $("#vendid").val();
            $("#entryform").load(
              \'?do=Main&vendid=\'+vend
            );
            
            
        }
    '; ?>

</script>

  <TABLE style = "width: 100%">
      <TR>
         <TD style = "font-size: 24; width: 100%", align='center';><B>Vendor Maintenance</B></TD>
     </TR>
  </TABLE>
<div>
    <span style="position: relative; left: 10px; font-weight: bold;">Vendor ID</span><span style="position:relative; left: 125px;">
        <input type="text" name="vendid" id="vendid" onchange="javascript:vendorlookup();">
    </span>
</div>
  	
<div id="entryform">
</div>