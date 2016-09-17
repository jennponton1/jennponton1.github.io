<?php /* Smarty version 2.6.13, created on 2014-02-17 11:00:35
         compiled from C:%5Cinetpub%5Cwwwroot%5Cjponton%5CVendorBalanceInquiry/views/main.tpl */ ?>
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
</style>
<!-- '; ?>
 -->
<script src="/globals/js/jquery/jquery.js"></script>
<script src="/globals/js/jquery/jquery-ui.js"></script>
<script src="/globals/js/jquery/jquery.datatables.js"></script>
<script src="/globals/js/contrib/accounting.js"></script>
<script src="/globals/js/jquery/TableTools-2.1.5/TableTools-2.1.5/media/js/TableTools.js"></script>
<link rel="stylesheet" href="/globals/css/jquery/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
<script src="js/main.js"></script>
<script src="js/viewChecks.js"></script>
<div id='content'>
<br>
    <div id='conthdr'>
    <h3>Vendor Balance Inquiry</h3>
    <input type="hidden" name="dsn" id="dsn" value="<?php echo $this->_tpl_vars['dsn']; ?>
">
    <label for='vendid'>Select Vendor</label>
        <select id="vendid" name="vendid">
            <option value=''>Select a vendor</option>
            <?php $_from = $this->_tpl_vars['vendlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['vendor']):
?>
            <option value='<?php echo $this->_tpl_vars['id']; ?>
'><?php echo $this->_tpl_vars['vendor']; ?>
: <?php echo $this->_tpl_vars['id']; ?>
</option>        
        <?php endforeach; endif; unset($_from); ?>
        </select>
        <div style="display: inline-block; width: 10px;"></div>
        <button id="getchecks">View Checks</button>
        <button id="expandsearch">Expand Search</button>
        <span class="spacer" style="float:right">
            <button id="setPrint">Printer Friendly</button></span>
<!--        <span class="spacer"></span>-->
    <br>
    </div>
    
    <div id='contdtl'>
        <table id='datatbl'>
        </table>
        <table id='chkdatatbl'>
        </table>
        <div id='footer'>
        </div>
    </div>
<!--    <div style="border: thin solid black;">
        <button id="savedoc" type="button" onclick="javascript:lineItemDlg.saveDoc();">Save</button>
    </div>    -->
</div>
<!-- <?php echo ' -->
<script>
    // initialize
    $("#vendid").on("change", function() { VendBalanceInquiry.loadData(); } );
//    $("#getchecks").on("click",function() { VendBalanceInquiry.checkSearch(); });
    $("#getchecks").on("click",function() { viewChecks.checkSearch(); });
    $("#expandsearch").on("click",function() { VendBalanceInquiry.expandSearch(); });    
</script>
<!-- '; ?>
 -->