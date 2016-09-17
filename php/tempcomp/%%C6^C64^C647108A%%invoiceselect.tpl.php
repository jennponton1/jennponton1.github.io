<?php /* Smarty version 2.6.13, created on 2015-04-21 12:22:14
         compiled from C:%5Cinetpub%5Cwwwroot%5Cintranetutils%5Cinvoicexml/views/invoiceselect.tpl */ ?>
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
<link rel="stylesheet" href="/globals/css/jquery/jquery-ui.css">
<link rel="stylesheet" href="views/dataTables.css">
<link rel="stylesheet" href="views/styles.css">

<script src="js/invoiceselect.js"></script>

 
<div id='content'>
    <h3>Invoices</h3>
        <br>
</div>
    <div id="toolbar">
    <button id="next">Print/Email</button>
    <button id="clrsel">Clear Selection</button>
</div>
<div id='contdtl'>
    <table id='datatbl'></table>
</div>
<!-- <?php echo ' -->
<script>
    $("#next").on("click", function() {InvoiceSelect.getSelectRows();});
    //$("#clrsel").on("click", function(window.location=\\"invoiceselect.php\\"));
    $("#clrsel").on("click", function() {InvoiceSelect.refreshPage();});
</script>
<!-- '; ?>
 -->