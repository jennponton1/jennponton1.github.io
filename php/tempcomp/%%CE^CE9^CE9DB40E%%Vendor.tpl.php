<?php /* Smarty version 2.6.13, created on 2014-04-24 09:47:16
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CVendor/views/Vendor.tpl */ ?>
<!-- <?php echo ' -->
<style>
    #conthdr {
        min-height: 100px;
        width: 100%;
        border: thin solid black;
    }
    #conthdr label {
        margin-left: 5px;
    }
    #conthdr h3 {
        position: relative;
        top: -30px;
        left: 20px;
        border: thin solid black;
        width: 200px;
        text-align: center;
        background: #FFFFFF;
    }
    #contdtl {
        min-height: 600px;
        width: 100%;
        border: thin solid black;
    }
    #contdtl table {
        width: 95%;
        font: 10pt sans-serif;
    }
    .inlinespace {
        display: inline-block;
        width: 10px;
    }
    .nbrCell {
        text-align: right;
    }
    .ui-autocomplete {
      font-family: \'trebuchet MS\', \'Lucida sans\', Arial; 
      font-size: 14px; 
      max-height: 200px;
      border: thin solid black;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
    }
    
    .ui-menu-item a {
        font-family: \'trebuchet MS\', \'Lucida sans\', Arial;
        font-size: 14px;
    }
</style>
<!-- '; ?>
 -->
<script src="/globals/js/jquery/jquery.js"></script>
<script src="/globals/js/jquery/jquery-ui.js"></script>
<script src="/globals/js/jquery/jquery.datatables.js"></script>
<link rel="stylesheet" href="/globals/css/jquery/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/globals/css/jquery/htw.datatables.css">
<script src="views/main.js"></script>
<div id='content'>
<br>
    <div id='conthdr'>
    <h3>Vendor Maintenance</h3>
    <input type="hidden" name="dsn" id="dsn" value="<?php echo $this->_tpl_vars['dsn']; ?>
">
    <br>
    <button id="addvendor">Add Vendor</button>
    <br>
    <br>
    </div>
    
    <div id='contdtl'>
        <table id='datatbl'>
        </table>
        <div id='footer'>
        </div>
    </div>
</div>
<!-- <?php echo ' -->
<script>
    // initialize
    $("#addvendor").on("click",function() { vendorAdd.init(); });
</script>
<!-- '; ?>
 -->