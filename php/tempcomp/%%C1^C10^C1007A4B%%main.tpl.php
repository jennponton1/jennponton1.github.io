<?php /* Smarty version 2.6.13, created on 2015-02-05 11:16:23
         compiled from C:%5Cinetpub%5Cwwwroot%5CFinancial%5CDataEntry%5Caccountsreceivable/views/main.tpl */ ?>
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

<link rel="stylesheet" href="views/dataTables.css">
<link rel="stylesheet" href="views/styles.css">

<script src="js/main.js"></script>

<div style="display:none">
    <form action="CreateInvoice.php" method="POST" id="nextStep">
        <input id="dtnbr" name="dtnbr">
        <input name="do" id="do" value="dosetup">
        <input id="dtinfo" name="dtinfo">
    </form>
    </div>
<form action="" method=POST name="SelectDT" id="SelectDT" <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
    <input type="hidden" name="dtdata" id="dtdata">
    <input type="hidden" name="do" id="do" value="">
<div id='content'>
    <h3>Unbilled Delivery Tickets</h3>
    <label for='siteid'>Select Site</label>
    <select id="siteid" name="siteid">
        <option value=''>All</option>
        <option value='D'>Detroit</option>
        <option value='M'>Milford</option>
        <option value='P'>Pine Bluff</option>
        <option value='T'>Thomson</option>
        <option value='W'>Winston</option>
    </select>
    <br>
</div>
<div id='contdtl'>
    <table id='datatbl'></table>
</div>
<!-- <?php echo ' -->
<script>
    $("#siteid").on("change", function() { UnbilledApp.loadData(); } );
    UnbilledApp.loadData();
</script>
<!-- '; ?>
 -->