<?php /* Smarty version 2.6.13, created on 2014-10-08 16:47:06
         compiled from C:%5Cinetpub%5Cphp%5Cdbreport/views/report.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Report: <?php echo $this->_tpl_vars['title']; ?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <link href="/globals/css/jquery/htw.datatables.css" rel="stylesheet">
        <!-- <?php echo ' -->
        <style>
            body {
                font-family: \'trebuchet MS\', \'Lucida sans\', Arial;
                font-size: 14px;
                color: #444;
            }
            #critBox {
                border: thin solid black;
                min-height: 1em;
                clear: both;
                padding: 0.25em;
            }
            #gridDiv {
            }
            #critHdr {
                border: thin solid black;
                float: left;
                padding-right: 1em;
                padding-left: 0.5em;
            }
            #critBox label {
                display: inline-block;
                min-width: 10em;
                font-family: \'trebuchet MS\', \'Lucida sans\', Arial;
                font-size: 14px;
                color: #444;
            }
            td.tblNumber {
                text-align: right;
            }
        </style>
        <!-- '; ?>
 -->
    </head>
    <body>
        <div id="reportHdr">
            <h3><?php echo $this->_tpl_vars['title']; ?>
</h3>
        </div>
        <div id="critDiv">
            <div id="critHdr">
                Criteria: &nbsp;<span id="critBoxInd">v</span>
            </div>
            <div id="critBox">

            </div>
            <div id="critFooter">
                <button id="critFilter">Apply Filter</button>
                <button id="printButton">Copy Table</button>
            </div>
        </div>
        <div id="gridDiv">
            <table id="gridTbl"></table>
        </div>
        <script>
            var reportObject="<?php echo $this->_tpl_vars['object']; ?>
";
            var tableDef = <?php echo $this->_tpl_vars['tableDefinition']; ?>
;
            var initialCriteria = <?php echo $this->_tpl_vars['initialCriteria']; ?>
;
            var staticCriteria = <?php echo $this->_tpl_vars['staticCriteria']; ?>
;
            var ajaxURL = <?php if ($this->_tpl_vars['ajaxURL'] == ''): ?> "" <?php else: ?> "<?php echo $this->_tpl_vars['ajaxURL']; ?>
" <?php endif; ?>
        </script>
        <script src="?do=getReportJS"></script>
        <?php echo $this->_tpl_vars['additionalJS']; ?>

    </body>
</html>