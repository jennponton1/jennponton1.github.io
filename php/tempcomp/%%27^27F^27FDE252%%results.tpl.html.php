<?php /* Smarty version 2.6.13, created on 2012-02-29 13:06:25
         compiled from C:%5Cinetpub%5Cwwwroot%5CExportOrderEntry%5Ccomppricelist/views/results.tpl.html */ ?>
<link type="text/css" href="public/css/styles.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />        
        
<script src="/ajax/jquery/jquery.js" ></script>
<script src="public/js/main.js" ></script>

<div id="layout">
    <div class="title">Export Price List</div> 
    <div class="country">Price List for Shipments To:  <?php echo $this->_tpl_vars['country']; ?>
, <?php echo $this->_tpl_vars['port']; ?>
</div>
    <div class="treating">Treatment Type: <?php echo $this->_tpl_vars['treatment']; ?>
</div>
    <div class="prices">Prices per: USD/M3</div>
    <div class="date">Dated: <?php echo $this->_tpl_vars['date']; ?>
</div>

    <div class="deduct"><?php echo $this->_tpl_vars['deduct']; ?>
</div>

    <br /><br />
    
    <div class="mainGrid"><?php echo $this->_tpl_vars['table']; ?>
</div>

    <input class="backBtn" type="submit"  value="Return To Main" onClick="ExportList.goBack()"/>
</div>