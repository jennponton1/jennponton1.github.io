<?php /* Smarty version 2.6.13, created on 2014-02-17 15:25:27
         compiled from C:%5Cinetpub%5Cwwwroot%5Cjponton%5CVendorBalanceInquiry/views/vodetedit.tpl */ ?>
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
<script src="/globals/js/jquery/TableTools-2.1.5/media/js/TableTools.js"></script>
<link rel="stylesheet" href="/globals/css/jquery/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
<script src="js/vodetedit.js"></script>
<div id='content'>
<br>
    <div id='conthdr'>
    <h3>Voucher Detail</h3>
        <input type="hidden" name="dsn" id="dsn" value="<?php echo $this->_tpl_vars['dsn']; ?>
">
        <input type="hidden" name="refnbr" id="refnbr"  value='<?php echo $this->_tpl_vars['refnbr']; ?>
'>
        <input type="hidden" name="doctype" id="doctype" value="<?php echo $this->_tpl_vars['doctype']; ?>
">
    </div>
    
    <div id='contdtl'>
        <table id='datatbl'>
        </table>
        <div id='footer'>
        </div>
    </div>
    <div style="border: thin solid black;">
        <button id="savetran" type="button" onclick="javascript:lineItemDlg.saveTran();">Save</button>
    </div>    
</div>
<!-- <?php echo ' -->
<script>
    // initialize
    VoucherDetailEdit.loadData();
    
</script>
<!-- '; ?>
 -->