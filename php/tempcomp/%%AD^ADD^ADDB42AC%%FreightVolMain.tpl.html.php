<?php /* Smarty version 2.6.13, created on 2012-03-05 14:34:26
         compiled from C:%5Cinetpub%5Cwwwroot%5Cutils%5Cexportadmin/views/FreightVolMain.tpl.html */ ?>
<link type="text/css" href="public/css/styles.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/DataTables-1.8.2/media/css/demo_table.css" rel="stylesheet" />   
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />   

<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/DataTables-1.8.2/media/js/jquery.dataTables.js"></script>
<script src="public/js/freightVol.js" ></script>
<script src="public/js/messages.js" ></script>

<div class="messagebox" id="messageBox"></div>
<div id="title">XP Freight Volume</div>
<button id="new">Add New Item</button>
   
    <table id="grid" class="display" >
    <thead>
        <tr align="left">
            <th>Site</th>
            <th>Wood Type</th>
            <th>Volume</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody id="tableBody">       
    </tbody>
</table>