<?php /* Smarty version 2.6.13, created on 2012-03-05 14:35:20
         compiled from C:%5Cinetpub%5Cwwwroot%5Cutils%5Cexportadmin/views/treatingMain.tpl.html */ ?>
<link type="text/css" href="public/css/styles.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/DataTables-1.8.2/media/css/demo_table.css" rel="stylesheet" />   
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />   

<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Ajax/DataTables-1.8.2/media/js/jquery.dataTables.js"></script>
<script src="public/js/treating.js" ></script>
<script src="public/js/messages.js" ></script>

<div class="messagebox" id="messageBox"></div>


<div id="title">Treating</div>

<div id="addNew" title="Add New" hidden="hidden" class="addNew">
    
    Select Wood Type:<select id="woodType" name="site"></select>    Treatment:<select id="treatment" name="treatment"></select>
    
    <hr />
    
    Price:<input align="right" type="text">
    
</div> 


<button id="new">Add New Item</button>
   
    <table id="grid" class="display" >
    <thead>
        <tr align="left">
            <th>Wood Type</th>
            <th>Treatment</th>
            <th>Price</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody id="tableBody">       
    </tbody>
</table>
