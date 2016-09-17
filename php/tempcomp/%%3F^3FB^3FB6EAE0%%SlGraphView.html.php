<?php /* Smarty version 2.6.13, created on 2012-12-14 11:21:22
         compiled from C:%5Cinetpub%5Cwwwroot%5Cplugins/views/SlGraphView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <?php echo '
<link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/JQPlot/jquery.jqplot.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet" />

  <style>
   html, div {font-size: 85%;}
   html, body {
    margin: 0;
    padding: 0;
    font-size: 85%;}
  </style>

  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQPlot/jquery.jqplot.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQPlot/plugins/jqplot.barRenderer.min.js"></script>
  <script type="text/javascript" src="/Ajax/JQPlot/plugins/jqplot.cursor.min.js"></script>
  <script type="text/javascript">

  function requestgdata() {
     requesthdata();
     getrebatedata();

     $("#edittab").tabs();
     $.jqplot.config.enablePlugins = true;
     var custid = $("#custid").val();
     $.ajax({
        type: "GET",
        url: "?do=getgdata&custid="+custid,
        dataType: "json",
        async: false,
        success: function(pdata) {
                    var JSON = pdata;
                    getgdata(JSON);
        }
     });
  }

  function getgdata(JSON) {
     var custid = $("#custid").val();
     plot1 = $.jqplot(\'plott1\', [JSON[0]], {
           title:\'Current Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][0]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#FF0000"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[10]},
               yaxis:{min:0, max:JSON[8][0],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott1\');
     plot2 = $.jqplot(\'plott2\', [JSON[1]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][1]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#FF0000"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[9]},
               yaxis:{min:0, max:JSON[8][0],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott2\');
     plot3  = $.jqplot(\'plott3\', [JSON[2]], {
           title:\'Current Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][2]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#1E90FF"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[10]},
               yaxis:{min:0, max:JSON[8][1],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott3\');
     plot4  = $.jqplot(\'plott4\', [JSON[3]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][3]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#1E90FF"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[9]},
               yaxis:{min:0, max:JSON[8][1],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott4\');
     plot5  = $.jqplot(\'plott5\', [JSON[4]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][4]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#A0522D"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[10]},
               yaxis:{min:0, max:JSON[8][2],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott5\');
     plot6  = $.jqplot(\'plott6\', [JSON[5]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][5]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#A0522D"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[9]},
               yaxis:{min:0, max:JSON[8][2],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott6\');
     plot7  = $.jqplot(\'plott7\', [JSON[6]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][6]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#00FF7F"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[10]},
               yaxis:{min:0, max:JSON[8][3],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott7\');
     plot8  = $.jqplot(\'plott8\', [JSON[7]], {
           title:\'Previous Rolling 12 Months for \' + custid + \' ... \' + addCommas(JSON[11][7]) + \' total board feet\',
           series:[
              {renderer:$.jqplot.BarRenderer, color:"#00FF7F"},
           ],
           axes:{
               xaxis:{renderer:$.jqplot.CategoryAxisRenderer,
                      tickOptions:{textColor:"#000000", fontSize:10},
                      ticks:JSON[9]},
               yaxis:{min:0, max:JSON[8][3],tickOptions:{textColor:"#000000", fontSize:8}}
           },
           cursor:{
               showTooltip:false
           }
     });
     getbinding(\'#plott8\');
     $(\'#edittab\').bind(\'tabsshow\', function(event, ui) {
     switch (ui.index) {
         case 0: if (plot1._drawCount == 0) {
                     plot1.replot();
                     plot2.replot();
                 }
                 break;
         case 1: if (plot3._drawCount == 0) {
                     plot3.replot();
                     plot4.replot();
                 }
                 break;
         case 2: if (plot5._drawCount == 0) {
                     plot5.replot();
                     plot6.replot();
                 }
                 break;
         case 3: if (plot7._drawCount == 0) {
                     plot7.replot();
                     plot8.replot();
                 }
                 break;
     }
  });
  }

  function getbinding(tgt) {
     $(tgt).bind( \'jqplotDataHighlight\',
        function( ev, seriesIndex, pointIndex, data ) {
           $(\'#pseudotooltip\').html(addCommas(data[1]));
           var cssObj = {
               \'position\' : \'absolute\',
               \'font-weight\' : \'bold\',
               \'left\' : ev.pageX + \'px\',
               \'top\' : ev.pageY + \'px\'
           };
           $(\'#pseudotooltip\').css(cssObj);
           }
     );
     $(tgt).bind(\'jqplotDataUnhighlight\',
        function (ev) {
           $(\'#pseudotooltip\').html(\'\');
        }
     );
     return;
  }

  function addCommas(nStr) {
     nStr += \'\';
     var x = nStr.split(\'.\');
     var x1 = x[0];
     var x2 = x.length > 1 ? \'.\' + x[1] : \'\';
     var rgx = /(\\d+)(\\d{3})/;
     while (rgx.test(x1)) {
            x1 = x1.replace(rgx, \'$1\' + \',\' + \'$2\');
     }
     return x1 + x2;
  }

  function CRMSched() {
     window.open("http://devdf.htwp.com/crm/index.php?action=Login"+"&module=Users"+"&login_module=Calls"+"$login_action=EditView");
  }

  function requesthdata() {
     var custid = $("#custid").val();
     jQuery.getJSON(
     url="?do=getcustdetail&custid="+custid,
     function(head) {
        var JSON = head;
        $("#name").html(JSON.name);
        $("#citystate").html(JSON.citystate);
        $("#lorder").html(JSON.last);
     }
     );
  }

  function getrebatedata() {
     var custid = $("#custid").val();
     jQuery.getJSON(
     url="?do=getrebate&custid="+custid,
     function(rebate) {
        var JSON = rebate;
        if (JSON.basegoal == null) {
            $("#msg").html("<b>no rebate data available.</b>");
        } else {
            $("#basegoal").html(addCommas(JSON.basegoal));
            $("#totship").html(addCommas(JSON.totship));
            $("#msg").html("");
        }
     }
     );
  }

</script>

'; ?>

</head>
<BODY onLoad="javascript:requestgdata()">
<div style="width: 60%; height: 95%; background-color: Black; float: left">
  <td><input type='hidden' id="custid" name="custid"  value=<?php echo $this->_tpl_vars['custid']; ?>
></td>
  <div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="edittab";>
      <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
      <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active" ><a href="#edittab-1">PGD</a></li>
      <li class="ui-state-default ui-corner-top"><a href="#edittab-2">XFX</a></li>
      <li class="ui-state-default ui-corner-top"><a href="#edittab-3">Raw</a></li>
      <li class="ui-state-default ui-corner-top"><a href="#edittab-4">Preservative</a></li></ul>
      <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="edittab-1">
          <div id="plott1" style="height:45%;width:95%;"></div>
          <br>
          <div id="plott2" style="height:45%;width:95%;"></div>
      </div>
      <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-2">
          <div id="plott3" style="height:45%;width:95%;"></div>
          <br>
          <div id="plott4" style="height:45%;width:95%;"></div>
      </div>
      <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-3">
          <div id="plott5" style="height:45%;width:95%;"></div>
          <br>
          <div id="plott6" style="height:45%;width:95%;"></div>
      </div>
      <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-4">
          <div id="plott7" style="height:45%;width:95%"></div>
          <br>
          <div id="plott8" style="height:45%;width:95%;"></div>
      </div>
      <td><span id="pseudotooltip"></span></td>
  </div>
</div>
<div style="width: 40%; height: 95%; background-color: GhostWhite; float: right">
<br>
<fieldset style = "background-color:#F0F0F0; color:Blue; font-size:12;">
<legend>&nbsp;Customer Information&nbsp;</legend>
<table style="width: 100%;">
    <tbody>
       <br>
       <tr><td style="width: 22%;"><b>Customer:</b></td>
          <td><span id="name"></span></td></tr>
       <tr><td><b>City/State</b></td>
          <td><span id="citystate"></span></td></tr>
       <tr><td style="width: 22%;"><b>Last Order:</b></td>
           <td><span id="lorder"></span></td></tr>
    </tbody>
</table>
<br>
</fieldset>
<br>
<fieldset style = "background-color:#F0F0F0; color:Blue; font-size:12;">
<legend>&nbsp;Rebate Eligibility&nbsp;</legend>
<table style="width: 100%;">
    <tbody>
       <br>
       <tr><td style="width: 28%;"><b>Base Goal:</b></td>
           <td style="width: 24%;"><span id="basegoal"></span></td>
           <td><span> board feet</span></td></tr>
       <tr><td style="width: 28%;"><b>Total Shipped:</b></td>
           <td style="width: 24%;"><span id="totship"></span></td>
           <td><span> board feet</span></td></tr>
    </tbody>
</table>
<table style="width: 100%;">
       <tr><td style="color: red; width: 75%;"><b><span id="msg"></span></b></td></tr>
</table>
</fieldset>
<div>
    <table style="width: 100%;">
      <tbody>
      <br>
      <tr>
         <td style="width: 1%;"></td>
<!--         <td style="width: 30%;"><button id="Call" type="button" onClick="javascript:CRMSched();">CRM</button></td> -->
            <td><span id="openlink"></span><td>
                
                
         <td style="width: 69%;"></td>
        </tr>
      </tbody>
    </table>
</div>
</div>
    <script>
         var theCustid="<?php echo $this->_tpl_vars['custid']; ?>
"
        <?php echo '
         $.ajax({
             url: "?do=checkopen&custid="+theCustid,
             dataType: "json",
             success: function(ret) {
                 if (ret) {
                     $("#openlink").html(\'<a target="_blank" href="/plugins/CustStatus.php?custlookup_custid=\'+theCustid+\'">Open Order Status for customer</a>\');
                 }
                 else {
                     $("#openlink").html("There are no open orders for this customer");
                 }
                 //$("#openlink")
             }
         });
        '; ?>

    </script>
</body>
</html>