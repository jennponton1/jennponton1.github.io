<?php /* Smarty version 2.6.13, created on 2011-03-29 15:35:18
         compiled from C:%5Cinetpub%5Cwwwroot%5Cplugins/views/SlLookupView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?php echo '
  <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
  <link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet" />

  <style>
   html, div {font-size: 80%;}
   .ui-row-ltr {
    font-size: .8em;}
  </style>

  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
  <script type="text/javascript">

function LookupCust() {
   var vCustid = $("#custid").val();
   jQuery.ajax({
     type: "GET",
     url: "?do=getcust&custid="+vCustid,
     dataType: "json",
     async: false,
     success: function(data) {
              var branch = data;
 alert(branch);
              if (branch == \'Y\') {
                  window.open("SlGraph.php?custlookup_custid="+vCustid,"_blank","status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,resizable=yes");
              } else {
                  $("#Lookup").attr("disabled",true);
                  document.getElementById("cntrl").style.visibility = "visible";
                  jQuery(document).ready(function(){jQuery("#list").jqGrid({
                     colNames:[\'Customer Id\',\'Name\',\'\'],
                     colModel:[
                        {name:\'CustId\',   width:120, sortable:false, editable:false, align:\'center\'},
                        {name:\'LastName\', width:320, sortable:false, editable:false, align:\'left\'},
                        {name:\'filler\',   width:12,  sortable:false, editable:false, align:\'right\'},
                     ],
                     height: \'240px\',
                     rowNum: 50,
                     caption: \'\',
                     loadonce: true,
                     altRows: true,
                     hidegrid: false,
                     viewrecords: false,
                  });
                  jQuery.getJSON(
                         url="?do=getcustlist&custid="+vCustid,
                         function(response) {
                            var grid = jQuery("#"+"list")[0];
                            var data = response;
                            grid.addJSONData(data);
                         }
                  );
                  })
              }
     }
   });
}

function LookupCust2() {
     var rowid = $("#list").getGridParam("selrow");
     if (rowid == null) {
         $("#msg").html("<b>No customer id selected.</b>");
     } else {
         $("#msg").html("");
         var vCustid = $("#list").getCell(rowid, "CustId");
         $("#list").setSelection(rowid);
         window.open("SlGraph.php?custlookup_custid="+vCustid,"_blank","status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,resizable=yes");
     }
}

function Reset() {
   $("#custid").val(\'\');
   $("#list").clearGridData(false);
   $("#list").GridUnload();
   $("#Lookup").attr("disabled",false);
   document.getElementById("cntrl").style.visibility = "hidden";
}

function cUpper(cObj) {
   cObj.value=cObj.value.toUpperCase();
}

</script>

'; ?>

</head>
<BODY>
<div>
<table style="width: 100%;">
    <tbody>
       <br>
       <tr><td style="width: 10%;"><b>Customer ID:</b></td>
           <td style="width: 15%;"><input id="custid" style="width: 100%;" tabindex="1" name="custid" onfocus="javascript:Reset();" OnKeyup="return cUpper(this)" type="text"></td>
           <td style="width: 2%;"><b></b></td>
           <td style="width: 30%;"><button id="Lookup" type="button" tabindex="2" onClick="javascript:LookupCust();">Lookup</button></td>
           <td style="width: 43%;"><b></b></td>
    </tbody>
</table>
</div>
<br>
<div>
   <?php echo '
    <hr>
    <TABLE id="list" class="scroll"></TABLE>
    <div id="pager" class="scroll" style="text-align:center;"></div>
    <div id="cntrl" style="visibility:hidden; display:none;">
    <br>
    <table style="width: 100%;">
    <td style="width: 1%;"><b></b></td>
    <td style="width: 10%;"><button id="Lookup2" visible = false type="button" tabindex="3" onClick="javascript:LookupCust2();">Lookup</button></td>
    <td style="color: red; width: 89%;"><b><span id="msg"></span></b></td>
    </table>
    </tr>
    <br>
    <hr>
    </div>
   '; ?>

</div>
    <script language="JavaScript">
         $("#custid").focus();
    </script>
</body>
</html>