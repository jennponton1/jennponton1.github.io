<?php /* Smarty version 2.6.13, created on 2014-03-18 14:42:51
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cvoucherentry/views/vouchselection.html */ ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery.datatables.css">
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script src="views/batchtotal.js"></script>
        <title>Voucher/Adjustment Selection</title>
    </head>
    <div style="float: left; width: 600px">
        <h3>Voucher/Adjustment Selection Menu</h3>
        <li><a target="_self" href="/accountspayable/dataentry/voucherentry/VoucherEntry.php?trantype=VO">Misc Voucher</a></li>
        <li><a target="_self" href="/accountspayable/dataentry/WoodVouchers/UnvRcptsSelect.php">Wood Voucher</a></li>
        <li><a target="_self" href="/accountspayable/dataentry/FreightLogs/freightvoucher.php">Freight Voucher</a></li>
        <li><a target="_self" href="/accountspayable/dataentry/voucherentry/VoucherEntry.php?trantype=AD">Adjustment</a></li>
    </div>
    <div style="left: 40px;" id="addrdiv">
        <h3>Batch Totals</h3>
        <input type="hidden" name="username" id="username" value="<?php echo $this->_tpl_vars['username']; ?>
">
        <button id="batch" type="button"></button>
    </div>
</html>

