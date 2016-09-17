<?php /* Smarty version 2.6.13, created on 2012-03-05 14:31:39
         compiled from C:%5Cinetpub%5Cwwwroot%5Cutils%5Cexportadmin/views/freightMain.tpl.html */ ?>
<link type="text/css" href="public/css/styles.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/DataTables-1.8.2/media/css/demo_table.css" rel="stylesheet" />   
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />   

<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/DataTables-1.8.2/media/js/jquery.dataTables.js"></script>
<script src="public/js/freight.js" ></script>
<script src="public/js/messages.js" ></script>

<div class="message" id="message">Please select a site to begin:</div>
<div class="messagebox" id="messageBox" hidden="hidden" ></div>

<div id="addNew" title="Add New" hidden="hidden" class="addNew">
    
    Select Destination:<select id="country" name="site"></select>
    
    <hr />
    
    Container Rate: <input type="text">
</div> 

<div id="title">XP Freight</div>  

<button id="new">Add New Item</button> 

<div class="siteId">   Select Site:<select id="site" name="site"></select></div>

    
<div id="wrapper" hidden="hidden">    
<table id="grid" class="display">
    <thead>
        <tr>
            <th>Port Id</th>
            <th>Destination</th>
            <th>Wood Type</th>
            <th>Container Rate</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody id="data">
    </tbody>
</table>
</div>