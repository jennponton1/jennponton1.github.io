<?php /* Smarty version 2.6.13, created on 2013-04-16 10:06:42
         compiled from C:%5Cinetpub%5Cwwwroot%5Cdetstatus/views/main.tpl.html */ ?>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/DataTables-1.9.0/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/jquery-tooltip/jquery.tooltip.js"></script>
<script src="public/js/plugins.js"></script>
<script src="public/js/main.js" ></script>
<script src="public/js/events.js" ></script>
<script src="public/js/messages.js" ></script>
<link type="text/css" href="/Ajax/DataTables-1.9.0/media/css/tableStyle.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="public/css/main.css" rel="stylesheet" />
<link type="text/css" href="public/css/detStatSheetDlg.css" rel="stylesheet" />
<link type="text/css" href="public/css/lookupParts.css" rel="stylesheet" />
<link type="text/css" href="public/css/slsOrderMvmt.css" rel="stylesheet" />
<link type="text/css" href="public/css/logView.css" rel="stylesheet" />
<div id="emailMsg">Can only email frtw.com users or addresses on multiple customer selection.</div>
<div class="title">Status Sheet </div>
<div class="siteId"><span>Select Site:</span><select id="site" name="site"></select></div>&nbsp;&nbsp;
<div>
    <input type="hidden" name="initCustid" id="initCustid" value="<?php echo $this->_tpl_vars['custid']; ?>
">
</div>
<div id="toolbar">
    <button id="lookPts">Lookup Parts For Orders</button>
    <button id="email">Send Email</button>
    <button id="deselect">Deselect Rows</button>
    <button id="select"> Select Current Rows </button>
    <button id="slsBal">Sales Status Totals</button>
</div>
<div class="msgBox" id="msgBox"></div>
    <div id="wrapper" >
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
                <th>Tot Ord</th>
                <th>Shipped</th>
                <th>Bal</th>
                <th>Notes</th>
                <th hidden=hidden>Cust ID</th>
                <th>Rel Stat</th>

            </tr>
        </thead>
        <tbody id="data">
        </tbody>
    </table>
    </div>
    <div id="dlgPcs" hidden="hidden">
    <label for="amount">How many pieces do you want to reallocate?</label>
    <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
    <div id="slider-range-min"></div>
    </div>
    
    <div id="dialog"></div>
    <div id="trkDlg"></div>
    <div id="viewTrans"></div>
    <div id="lkpDlg"></div>