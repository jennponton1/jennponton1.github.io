<?php /* Smarty version 2.6.13, created on 2013-03-08 13:46:11
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Creports%5CQuoteInquiry/views/main.tpl */ ?>
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
<link rel="stylesheet" href="/globals/css/jquery/jquery.dataTables.css">
<script src="js/main.js"></script>
<div id='content'>
<br>
<input type='hidden' id='slsperid' name='slsperid' value='<?php echo $this->_tpl_vars['slsperid']; ?>
'>
<div id='conthdr'>
<h3>Quote Inquiry</h3>
<label for='slsper'>Select SalesPerson</label>
    <select id="slsper" name="slsper">
        <option value='ALL'>All</option>
    <?php $_from = $this->_tpl_vars['slslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['person']):
?>
        <option value='<?php echo $this->_tpl_vars['person']->slsperid; ?>
'><?php echo $this->_tpl_vars['person']->lastname; ?>
</option>        
    <?php endforeach; endif; unset($_from); ?>
    </select>
    <div class='inlinespace'></div>
    <label for='openopt'>Open?</label>
    <select id='openopt' name='openopt'>
    <option value=''>All</option>
    <option value='Y'>Open</option>
    <option value='N'>Closed</option>
    </select>

<br>
</div>
<div id='contdtl'>
    <table id='datatbl'>
    </table>
</div>
</div>
<!-- <?php echo ' -->
<script>
    // initialize
    $("#slsper").val($("#slsperid").val());
    $("#slsper").on("change", function() { QuoteInquiry.loadData(); } );
    $("#openopt").on("change", function() { QuoteInquiry.loadData(); } );
    $("table").on(\'click\', "td.quotelink", function(tgt) { QuoteInquiry.followLink(tgt); });
    
    QuoteInquiry.loadData();
</script>
<!-- '; ?>
 -->