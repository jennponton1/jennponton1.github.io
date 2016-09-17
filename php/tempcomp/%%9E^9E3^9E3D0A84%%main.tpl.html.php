<?php /* Smarty version 2.6.13, created on 2014-11-10 11:19:46
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Creports%5Cpostatus/views/main.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Order Status</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <!-- <script src="/globals/js/extjs/ext-all.js"></script> -->
        <script src="js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/htw.datatables.css">
        <!-- <link rel="stylesheet" type="text/css" href="/globals/css/extjs/ext-all.css"> -->
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <div id='site_select'>
            <br>
            <label for="siteid">Select Site:</label>
            <select id="siteid">
                <?php echo $this->_tpl_vars['sites']; ?>

            </select>
        </div>
        <div id="maincontent">
            <h3>P/O Status</h3>
            <div id='maindiv'>
                <table id='maingrid'>
                </table>
            </div>
        </div>
        <div id="detail_dialog"></div>
    </body>
</html>