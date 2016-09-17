<?php /* Smarty version 2.6.13, created on 2012-05-02 15:02:49
         compiled from C:%5Cinetpub%5Cwwwroot%5CDetStatus/views/main.tpl.html */ ?>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/DataTables-1.9.0/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/jquery-tooltip/jquery.tooltip.js"></script>
<script src="public/js/main.js" ></script>
<script src="public/js/events.js" ></script>
<link type="text/css" href="public/css/main.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/DataTables-1.9.0/media/css/tableStyle.css" rel="stylesheet" />      
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />  
<button class="lookPts">Lookup Parts For Orders</button>
<!-- <div id="bldInfo">Last Builder Run: <?php echo $this->_tpl_vars['updString']; ?>
</div> -->
    <div class="title">Status Sheet </div>
    <div class="message" id="message">Please select a site to begin:</div>
    <div class="siteId">Select Site:<select id="site" name="site"></select></div>
    <div id="standby" hidden="hidden"></div>
    <div id="wrapper" hidden="hidden">
     <table id="grid" class="display">
        <thead >
            <tr>
                <th>Order #</th>
                <th>Treatment</th>
                <th>Cust Name</th>
                <th>Cust Order #</th>
                <th>S Person</th>
                <th>Order Date</th>
                <th>Mat Rcvd Date</th>
                <th>Date Due To Ship</th>
                <th>Status</th>
                <th>Date Rdy</th>
                <th>Carrier</th>
                <th>To Tord</th>
                <th>Shipped</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody id="data">
        </tbody>
    </table>
    </div>
    <div id="dlgPcs" hidden="hidden">
    <label for="amount">How many pieces do you want to reallocate?</label>
    <input type="text" disabled="disabled" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
    <div id="slider-range-min"></div>
    </div>
    
    <div id="dialog"></div>
    <div id="trkDlg"></div>
    <div id="viewTrans"></div>
    <div id="lkpDlg"></div>