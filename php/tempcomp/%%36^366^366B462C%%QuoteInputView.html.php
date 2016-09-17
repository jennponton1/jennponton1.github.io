<?php /* Smarty version 2.6.13, created on 2011-07-12 12:54:21
         compiled from C:%5Cinetpub%5Cwwwroot%5Cquotes_test/views/QuoteInputView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <?php echo '
        <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="/Ajax/JQueryGrid/css/ui.jqgrid.css" media="screen" rel="stylesheet" />

        <style type=text/css>
               html, div {font-size: 80%;}
               html, body {
               margin: 0;
               padding: 0;
               font-size: 85%;
               }
        </style>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqModal.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryGrid/src/jqDnR.js"></script>
        <script type="text/javascript" src="/Ajax/JQueryJSON/js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript">

        var actn = \'\';
        screenW = screen.width - 6;

        jQuery(document).ready(function(){jQuery("#list").jqGrid({
                colNames:[\'\',\'\',\'Inventory\',\'Quantity\',\'Unit\',\'Billing Units\',\'Wood Cost\',\'Treat Cost\',\'SD Disc\',\'Adtl Disc\',\'Addr\',\'Freight\',\'Total\',\'\',\'\'],
                colModel:[
                    {name:\'FrtFct\',  index:\'FrtFct\',  width:75,  editable:false, sortable:false, align:\'right\', hidden:true},
                    {name:\'Bf\',      index:\'Bf\',      width:75,  editable:false, sortable:false, align:\'right\', hidden:true},
                    {name:\'Invtid\',  index:\'Invtid\',  width:200, editable:false, sorttype:false, align:\'left\'},
                    {name:\'Qty\',     index:\'Qty\',     width:70,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Unit\',    index:\'Unit\',    width:50,  editable:false, sortable:false, align:\'center\'},
                    {name:\'Bu\',      index:\'Bu\',      width:100, editable:false, sortable:false, align:\'right\'},
                    {name:\'Wcost\',   index:\'Wcost\',   width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Tcost\',   index:\'Tcost\',   width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'SDDisc\',  index:\'SDDisc\',  width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Tadj\',    index:\'Tadj\',    width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Addr\',    index:\'Addr\',    width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Freight\', index:\'Freight\', width:80,  editable:false, sortable:false, align:\'right\'},
                    {name:\'LineTot\', index:\'LineTot\', width:92,  editable:false, sortable:false, align:\'right\'},
                    {name:\'Warn\',    index:\'Warn\',    width:12,  editable:false, sortable:false, align:\'center\'},
                    {name:\'Filler\',  index:\'Filler\',  width:12,  editable:false, sortable:false, align:\'right\'},
                ],
                height: \'136px\',
                sortname: \'id\',
                sortorder: "desc",
                viewrecords: true,
                loadonce: true,
                sortable: true,
                altRows: true,
                hidegrid: false,
                width:screenW,
                ondblClickRow: function(id){
                    $("#list").setSelection(id);
                    EditL();
                },
                onSortCol: function () {
                  $("#list").setGridParam({sortname:\'Invtid\',sortorder:"desc"}).trigger("reloadGrid");
                }
            });
        })

        $(function() {
            $("#input-dialog").dialog({
                autoOpen: false,
                modal: true,
                draggable: true,
                width: 500
            });
        });

        function loadQuote() {
            var quotenbr = $("#QuoteNbr").val();
            var loaderror = 0;
            $.ajax({
                type: "GET",
                url: "?do=getquote&quotenbr="+quotenbr,
                dataType: "json",
                async: false,
                success: function(head) {
                    var JSON = head;
                    switch (JSON[\'error\']) {
                        case \'N\': 
                           $("#RevNbr").val(JSON[\'revnbr\']);
                           $("#Custid").val(JSON[\'custid\']);
                           $("#SlsPer").val(JSON[\'slsper\']);
                           $("#FOB").val(JSON[\'fob\']);
                           $("#Contact").val(JSON[\'confirmto\']);
                           $("#IssueDate").val(JSON[\'issuedate\']);
                           $("#LeadTime").val(JSON[\'leadtime\']);
                           $("#TrkRate").val(JSON[\'trkrate\']);
                           $("#Carrier").val(JSON[\'carrier\']);
                           $("#FollowUp").val(JSON[\'fupdate\']);
                           $("#RailRate").val(JSON[\'railrate\']);
                           $("#Email").val(JSON[\'email\']);
                           $("#Resolv").val(JSON[\'resolv\']);
                           $("#RDate").val(JSON[\'rdate\']);
                           $("#Instr").val(JSON[\'instr\']);
                           $("#Notes").val(JSON[\'notes\']);
                           $("#OpenQuote").val(JSON[\'openquote\']);
                           $("#ShipVia").val(JSON[\'shipvia\']);
                           $("#Altid").val(JSON[\'altid\']);
                           var addr = " " + JSON[\'shiptolname\'] + "\\n";
                           var fnx  = trim(JSON[\'shiptofname\']);
                           if (fnx.length > 0) {
                               addr += " " + fnx + "\\n";
                           }
                           fnx   = trim(JSON[\'shiptoaddr1\']);
                           if (fnx.length > 0) {
                               addr += " " + fnx + "\\n";
                           }
                           fnx   = trim(JSON[\'shiptoaddr2\']);
                           if (fnx.length > 0) {
                               addr += " " + fnx + "\\n";
                           }
                           addr += " " + trim(JSON[\'shiptocity\']) + " " + trim(JSON[\'shiptostate\']) + " " + trim(JSON[\'shiptostate\']) + "\\n";
                           addr += " Phone: " + trim(JSON[\'shiptophone\']) + "\\n";
                           addr += "   Fax: " + trim(JSON[\'shiptofax\']);
                           uaddr        = addr.toUpperCase();
                           $("#CustAddr").val(uaddr);
                           buildShipVia();
                           UpdateCust();
                           break;
                        case \'Y\':
                           loaderror = 1;
                           $("#Msg").html("Quote not on file.");
                           break;
                        default:
                           loaderror = 1
                           $("#Msg").html("Quote is closed.");
                           break;
                    }
                }
            });
            if (loaderror == 0) {
                $.ajax({
                     type: "GET",
                     url: "?do=getquotedetail&quotenbr="+quotenbr,
                     dataType: "json",
                     async: false,
                     success: function(ret) {
                         var grid = jQuery("#"+"list")[0];
                         var data = ret;
                         grid.addJSONData(data);
                         $("#FileCopy").attr(\'disabled\', false);
                         $("#FilePrint").attr(\'disabled\', false);
                         $("#FileOrder").attr(\'disabled\', false);
                         $("#Resolv").attr(\'disabled\', false);
                         $("#Closeq").attr(\'disabled\', false);
                         togStatus();
                     }
                 });
                 var ids     = $("#list").getDataIDs();
                 var bftot   = 0;
                 for (i = 1; i <= ids.length; i++) {
                      bftot += parseFloat(removecommas($("#list").getCell(i, "Bf")));
                 }
                 $("#TotBF").val(addCommas(bftot));
            }
        }

        function buildShipVia() {
            switch ($("#ShipVia").val()) {
                case \'TRUCK\':   $(\'#edittab\').tabs(\'select\', \'#\' + \'edittab-1\');
                    break;
                case \'RAILCAR\': $(\'#edittab\').tabs(\'select\', \'#\' + \'edittab-2\');
                    break;
                default:        $(\'#edittab\').tabs(\'select\', \'#\' + \'edittab-3\');
                    break;
            }
        }

        function buildCities() {
            var state = $("#State").val();
            $.ajax({
                type: "GET",
                url: "?do=getcitylist&state="+state,
                dataType: "json",
                async: false,
                success: function(data) {
                    var JSON = data;
                    document.getElementById("CityLst").options.length = 0;
                    var selObj = document.getElementById("CityLst");
                    var optCount = JSON.length;
                    for (var i=0; i<optCount; i++) {
                        selObj.options[i] = new Option(JSON[i]);
                    }
                    selObj.options[i] = new Option(\'Not on table!\');
                }
            });
            buildRates();
        }

        function calcRates(act) {
            switch (act) {
                case 1:   var ratestring = $("#RateLst").val();
                          var rate       = ratestring.split("$");
                          $("#TrkRate").val(rate[1]);
                          var ratestring = $("#RateLst").val();
                          var site       = ratestring.split(" ");
                          $("#Siteid").val(site[0]);
                          break;
                case 3:   var ratestring = $("#RateLst").val();
                          var rate       = ratestring.split("$");
                          $("#TrkRate").val(rate[1]);
                          var ratestring = $("#RateLst").val();
                          var site       = ratestring.split(" ");
                          $("#Siteid").val(site[0]);
                          break;
                default:  break;
            }
            var ids    = $("#list").getDataIDs();
            if (ids.length > 0) {
                if (act != 4) {
                    checkPrice();
                }
                ReviseGrid();
            }
        }

        function buildRates() {
            var state          = $("#State").val();
            var city           = $("#CityLst").val();
            if (city == \'Not on table!\') {
                $("#TrkRate").val(\'\');
                $("input[name=\'TrkRate\']").focus();
                var text       = new Array();
                var value      = new Array();
                RateLst.length = 0;
                text[0]        = \'THOMSON\';
                value[0]       = \'THO\';
                text[1]        = \'MILFORD\';
                value[1]       = \'MIL\';
                text[2]        = \'PINE BLUFF\';
                value[2]       = \'PB\';
                text[3]        = \'DETROIT\';
                value[3]       = \'DET\';
                text[4]        = \'WINSTON\';
                value[4]       = \'WIN\';
                for (var i=0; i<5; i++) {
                var newElem    = document.createElement("option");
                    newElem.text  = text[i];
                    newElem.value = value[i];
                    RateLst.options.add(newElem);
                }
            } else {
                $.ajax({
                    type: "GET",
                    url: "?do=getratelist&state="+state+"&city="+city,
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        var JSON   = data;
                        document.getElementById("RateLst").options.length = 0;
                        var selObj = document.getElementById("RateLst");
                        for (var i=0; i<JSON.length; i++) {
                             selObj.options[i] = new Option(JSON[i]);
                        }
                    }
                });
                var ratestring = $("#RateLst").val();
                var rate       = ratestring.split("$");
                $("#TrkRate").val(rate[1]);
                var ratestring = $("#RateLst").val();
                var site       = ratestring.split(" ");
                $("#Siteid").val(site[0]);
                calcRates(2);
            }
        }

        function checkPrice() {
           var siteid = $("#Siteid").val();
           var ids    = $("#list").getDataIDs();
           for (var i = 1; i <= ids.length; i++) {
                var invtid = $("#list").getCell(i, "Invtid");
                $.ajax({
                    type: "GET",
                    url: "?do=getinvtid&invtid="+invtid+"&siteid="+siteid,
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        var JSON = data;
                        $("#list").setCell(i, "Wcost", formatCurrency(JSON.woodprc));
                        $("#list").setCell(i, "Tcost", formatCurrency(JSON.trtprc));
                    }
                });
           }
        }

        function AltAddress() {
            var newid  = \'\';
            var newln  = \'\';
            var newfn  = \'\';
            var newad1 = \'\';
            var newad2 = \'\';
            var newcty = \'\';
            var newst  = \'\';
            var newzp  = \'\';
            var newph  = \'\';
            var newfx  = \'\';
            var custid = $("#Custid").val();
            var queryString = "Newid="+newid+"Newln="+newln+"&Newfn="+newfn+"&Newad1="+newad1+"&Newad2="+newad2+"&Newcty="+newcty+"&Newst="+newst+"&Newzp="+newzp+"&Newph="+newph+"&Newfx="+newfx+"&custid="+custid;
            queryString = encodeURI(queryString);
            $("#input-dialog").load("QuoteAddr.php?"+queryString);
            $("#input-dialog").dialog("open");
        }

        function EditL() {
            $("#Msg").html("");
            var rowid = $("#list").getGridParam("selrow");
            var invtid = $("#list").getCell(rowid, "Invtid");
            if (rowid == null) {
                $("#Msg").html("No line selected for editing.");
            } else if (invtid == \'FREIGHT\') {
                $("#Msg").html("Can not edit freight line directly.");
                $("#list").resetSelection(); 
            } else {
                var invtid = $("#list").getCell(rowid, "Invtid");
                var qty    = removecommas($("#list").getCell(rowid, "Qty"));
                var wcost  = removedollar($("#list").getCell(rowid, "Wcost"));
                var tcost  = removedollar($("#list").getCell(rowid, "Tcost"));
                var unit   = $("#list").getCell(rowid, "Unit");
                var sddisc = removedollar($("#list").getCell(rowid, "SDDisc"));
                var tadj   = removedollar($("#list").getCell(rowid, "Tadj"));
                var addr   = removedollar($("#list").getCell(rowid, "Addr"));
                if (unit == \'\') {
                    unit = \'BNDL\';
                }
                if (unit == \'EACH\') {
                    var un1 = \'\';
                    var un2 = \'Checked\';
                } else {
                    var un1 = \'Checked\';
                    var un2 = \'\';
                }
                var can = \'N\';
                var ratestring = $("#RateLst").val();
                if (trim(ratestring) != "") {
                    var site = ratestring.substr(0,3);
                }
                var queryString = "invtid="+invtid+"&qty="+qty+"&wcost="+wcost+"&tcost="+tcost+"&sddisc="+sddisc+"&tadj="+tadj+"&addr="+addr+"&un1="+un1+"&un2="+un2+"&site="+site+"&can="+can;
                queryString = encodeURI(queryString);
                $("#input-dialog").load("QuoteEdit.php?"+queryString);
                $("#input-dialog").dialog("open");
            }
        }

        function AddL() {
            actn    = \'add\';
            $("#Msg").html("");
            var ids = $("#list").getDataIDs();
            $("#list").addRowData(ids.length + 1, {LineNbr:"", InvtId:""});
            $("#list").setSelection(ids.length + 1);
            EditL();
        }

        function DelL() {
            var tableData = new Array();
            var ids       = \'\';
            var rowid     = $("#list").getGridParam("selrow");
            $("#Msg").html("");
            if (rowid == null) {
                $("#Msg").html("No line selected for deletion.");
            } else {
                $("#list").delRowData(rowid);
                ids = $("#list").getDataIDs();
                for (var i = 0; i < ids.length; i++) {
                    tableData[i] = $("#list").getRowData(ids[i]);
                    tableData[i].id = i + 1;
                }
                $("#list").clearGridData(false);
                for (i = 0; i <= ids.length; i++) {
                    $("#list").addRowData(i + 1, tableData[i]);
                }
            }
        }

        function Reset() {
            document.getElementById(\'QuoteInputView\').reset();
            $("#list").clearGridData(false);
            CityLst.length = 0;
            RateLst.length = 0;
            Resolv.length = 0;
            $(\'#edittab\').tabs(\'select\', \'#\' + \'edittab-1\');
            $("#Msg").html("");
        }

        function doCustLookup() {
            var newWin = window.open("CustLup.php","NewWin","width=380, top=140, left=400, height=320, toolbar=no, resizable=yes");
            document.getElementById("Custid").focus();
        }

        function UpdateCust() {
  alert("I am here!!!");
            var custid = $("#Custid").val();
            var city   = \'\';
            if (custid != \'\') {
                $.ajax({
                    type: "GET",
                    url: "?do=getcustomer&custid="+custid,
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        if (JSON.Addr == "Customer not on file") {
                            $("#Msg").html("Customer not on file.");
                            $("#CustAddr").html("");
                            $("#Custid").focus();
                        } else {
                            $("#CustAddr").val(data.Addr);
                            city         = data.City;
                            var selObj   = document.getElementById("State");
                            var optCount = selObj.options.length;
                            for (var i=0; i<optCount; i++) {
                                if (selObj.options[i].value == data.State) {
                                    selObj.selectedIndex = i;
                                    selObj.options[i].Selected = true;
                                }
                            }
                            $("#Msg").html(\'\');
                        }
                    }
                });
                buildCities();
                var selObj   = document.getElementById("CityLst");
                var optCount = selObj.options.length;
                for (var i=0; i<optCount; i++) {
                    if (selObj.options[i].value == city) {
                        selObj.selectedIndex       = i;
                        selObj.options[i].Selected = true;
                    }
                }
                buildRates();
            }
        }

        function UpdateGrid(NInvtid,NQty,NUnit,NWCost,NTCost,NDisc,NTadj,NAddr,NCan) {
            if (NCan == "Y") {
                if (actn == \'add\') {
                    DelL();
                }
            } else {
                var rowid = $("#list").getGridParam("selrow");
                $("#list").setCell(rowid, "Invtid", NInvtid);
                $("#list").setCell(rowid, "Addr", formatCurrency(NAddr));
                $("#list").setCell(rowid, "Tadj", formatCurrency(NTadj));
                $("#list").setCell(rowid, "SDDisc", formatCurrency(NDisc));
                $("#list").setCell(rowid, "Qty", NQty);
                $("#list").setCell(rowid, "Wcost", formatCurrency(NWCost));
                $("#list").setCell(rowid, "Tcost", formatCurrency(NTCost));
                $("#list").setCell(rowid, "Unit", NUnit);
                var ship = $("#ShipVia").val();
                switch (ship) {
                    case \'TRUCK\': var ratestring = $("#RateLst").val();
                                  var rate       = ratestring.split(" ");
                                  var site       = rate[0];
                                  $("#Siteid").val(rate[0]);
                                  var state      = $("#State").val();
                                  break;
                    default:      var state      = \'\';
                                  var site       = \'\';
                                  break;
                }
                $.ajax({
                    type: "GET",
                    url: "?do=getquant&invtid="+NInvtid+"&qty="+NQty+"&unit="+NUnit+"&site="+site+"&state="+state+"&ship="+ship,
                    dataType: "json",
                    async: false,
                    success: function(head) {
                        var JSON = head;
                        $("#list").setCell(rowid, "Bf", JSON.BFval);
                        $("#list").setCell(rowid, "Bu", addCommas(JSON.BUval)+ JSON.label);
                        if (JSON.FrtFct != null) {
                            $("#list").setCell(rowid, "FrtFct", JSON.FrtFct);
                        }
                    }
                });
                ReviseGrid();
                $("#list").resetSelection();
                // $("#list").sortGrid(\'id\', true);
                // $("#list").setGridParam({sortname:\'Invtid\',sortorder:"desc"}).trigger("reloadGrid");
                actn = \'\';
            }
        }

        function ReviseGrid() {
            var ids         = $("#list").getDataIDs();
            var bftot       = 0;
            var butot       = 0;
            for (i = 1; i <= ids.length; i++) {
                 bftot     += parseFloat(removecommas($("#list").getCell(i, "Bf")));
                 var BU     = $("#list").getCell(i, "Bu");
                 var bu     = BU.split(" ");
                 var buval  = removecommas(bu[0]);
                 butot     += parseFloat(buval);
            }
            if ($("#ShipVia").val() == \'TRUCK\') {
                var freight = removedollar($("#TrkRate").val());
            } else {
                var freight = 0;
            }
            for (i = 1; i <= ids.length; i++) {
                var invtid = $("#list").getCell(i, "Invtid");
                if (invtid == \'FREIGHT\') {
                    $("#list").setCell(i, "Freight", formatCurrency($("#RailRate").val()));
                    $("#list").setCell(i, "LineTot", formatCurrency($("#RailRate").val()));
                } else {
                    var wcost   = parseFloat(removedollar($("#list").getCell(i, "Wcost")));
                    var tcost   = parseFloat(removedollar($("#list").getCell(i, "Tcost")));
                    var frtfct  = parseFloat($("#list").getCell(i, "FrtFct"));
                    var BU      = $("#list").getCell(i, "Bu");
                    var bu      = BU.split(" ");
                    var buval   = removecommas(bu[0]);
                    if ($("#ShipVia").val() == \'TRUCK\') {
                        var FrtVal  = (freight / frtfct) * 1000;
                        FrtVal      = Math.round(FrtVal);
                    } else {
                        FrtVal      = 0;
                    }    
                    $("#list").setCell(i, "Freight", formatCurrency(FrtVal));
                    var subVal1 = ((wcost) + (tcost)) + parseFloat(FrtVal);
                    var sddisk  = parseFloat(removedollar($("#list").getCell(i, "SDDisc")));
                    var tadj    = parseFloat(removedollar($("#list").getCell(i, "Tadj")));
                    var addr    = parseFloat(removedollar($("#list").getCell(i, "Addr")));
                    var LnTot   = (subVal1 - (sddisk + tadj)) + addr;
                    $("#list").setCell(i, "LineTot", formatCurrency(LnTot));
                    if ((($("#ShipVia").val() == \'TRUCK\') && FrtVal == 0) || (($("#ShipVia").val() == \'RAILCAR\') && FrtVal == 0) || wcost == 0 || tcost == 0) {
                        $("#list").setCell (i,13,\'\',{\'background\':\'#ff0000\'});
                        $("#list").setCell (i,13,\'\',{\'color\':\'#ffffff\'});
                        $("#list").setCell(i, "Warn", \'!\');
                    }
                }
            }
            $("#TotBF").val(addCommas(bftot));
        }



        function AltEmail() {
            var custid = $("#Custid").val();
            var queryString = "custid="+custid;
            queryString = encodeURI(queryString);
            $("#input-dialog").load("EmailEdit.php?"+queryString);
            $("#input-dialog").dialog("open");
        }






        function altAddr(Newid,Newln,Newfn,Newad1,Newad2,Newcty,Newst,Newzp,Newph,Newfx,Newsave) {
            $("#Altid").val(Newid);
            $("#Altlname").val(Newln);
            $("#Altfname").val(Newfn);
            $("#Altaddr1").val(Newad1);
            $("#Altaddr2").val(Newad2);
            $("#Altcity").val(Newcty);
            $("#Altstate").val(Newst);
            $("#Altzip").val(Newzp);
            $("#Altphone").val(Newph);
            $("#Altfax").val(Newfx);
            if ($("#Altid").val() == \'Y\') {
                var addr = " " + Newln + "\\n";
                var fnx  = trim(Newfn);
                if (fnx.length > 0) {
                    addr += " " + fnx + "\\n";
                }
                fnx   = trim(Newad1);
                if (fnx.length > 0) {
                    addr += " " + fnx + "\\n";
                }
                fnx   = trim(Newad2);
                if (fnx.length > 0) {
                    addr += " " + fnx + "\\n";
                }
                addr += " " + trim(Newcty) + " " + trim(Newst) + " " + trim(Newzp) + "\\n";
                addr += " Phone: " + trim(Newph) + "\\n";
                addr += "   Fax: " + trim(Newfx);
                uaddr        = addr.toUpperCase();
                $("#CustAddr").val(uaddr);
                var uNewst   = Newst.toUpperCase();
                var city     = Newcty.toUpperCase();
                $("#State").val(uNewst);
                buildCities();
                var selObj   = document.getElementById("CityLst");
                var optCount = selObj.options.length;
                for (var i=0; i<optCount; i++) {
                    if (selObj.options[i].value == city) {
                        selObj.selectedIndex = i;
                        selObj.options[i].Selected = true;
                    }
                }
                buildRates();
            }
        }

        function setCurDate() {
            var curdate = $("#IssueDate").val();
            $("#RDate").val(curdate)
        }

        function trim(stringToTrim) {
            return stringToTrim.replace(/^\\s+|\\s+$/g,"");
        }

        function removedollar(str) {
            var re = /^\\$|,/g;
            return str.replace(re, "");
        }

        function removecommas(str) {
            var re = /^\\,|,/g;
            return str.replace(re, "");
        }

        function addCommas(nStr) {
            nStr   += \'\';
            var x   = nStr.split(\'.\');
            var x1  = x[0];
            var x2  = x.length > 1 ? \'.\' + x[1] : \'\';
            var rgx = /(\\d+)(\\d{3})/;
            while (rgx.test(x1)) {
                x1  = x1.replace(rgx, \'$1\' + \',\' + \'$2\');
            }
            return x1 + x2;
        }

        function roundNumber(num, dec) {
            var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
            return result;
        }

        $(function() {
            $("#FollowUp").datepicker();
        });

        function IsValidDate(Mn,Day,Yr) {
            var DateVal = Mn + "/" + Day + "/" + Yr;
            var dt      = new Date(DateVal);
            if(dt.getDate()!= Day){
                return(false);
            }
            else if(dt.getMonth()!= Mn-1){
                return(false);
            }
            else if(dt.getFullYear()!= Yr){
                return(false);
            }
            return(true);
        }

        function cUpper(cObj) {
            cObj.value = cObj.value.toUpperCase();
        }

        function setUpForm() {
            $("#FilePrint").attr(\'disabled\', true);
            $("#FileOrder").attr(\'disabled\', true);
            $("#Resolv").attr(\'disabled\', true);
            $("#Closeq").attr(\'disabled\', true);
            setShipVia(1);
        }
      
        function togStatus() {
            var state = $(\'#Closeq\').attr(\'checked\');
            $.ajax({
                type: "GET",
                url: "?do=getresultlist&state="+state,
                dataType: "json",
                async: false,
                success: function(data) {
                    var JSON = data;
                    document.getElementById("Resolv").options.length = 0;
                    var selObj = document.getElementById("Resolv");
                    var optCount = JSON.length;
                    for (var i=0; i<optCount; i++) {
                         selObj.options[i] = new Option(JSON[i],i);
                    }
                }
            });
        }

        function QuoteSave() {
            $("#Msg").html("");
            confirm("You are about to save the current quote");
                if ($("#Closeq").attr(\'checked\') == false) {
                    var closeqv = 0; 
                } else {
                    var closeqv = 1;
                }
                ids         = $("#list").getDataIDs();
                var IrecCnt = ids.length;
                var invtid = $("#list").getCell(IrecCnt, "Invtid");
                if ($("#ShipVia").val() == \'RAILCAR\' && invtid != \'FREIGHT\') {
                    var ids   = $("#list").getDataIDs();
                    var rowid = ids.length + 1;
                    $("#list").addRowData(ids.length + 1, {LineNbr:"", InvtId:""});
                    $("#list").setCell(rowid, "FrtFct", 0);
                    $("#list").setCell(rowid, "Bf", 0);
                    $("#list").setCell(rowid, "Invtid", "FREIGHT");
                    $("#list").setCell(rowid, "Qty", 1);
                    $("#list").setCell(rowid, "Unit", "FLAT");
                    $("#list").setCell(rowid, "Bu", "1 each");
                    $("#list").setCell(rowid, "Wcost", formatCurrency(0));
                    $("#list").setCell(rowid, "Tcost", formatCurrency(0));
                    $("#list").setCell(rowid, "SDDisc", formatCurrency(0));
                    $("#list").setCell(rowid, "Addr", formatCurrency(0));
                    $("#list").setCell(rowid, "Tadj", formatCurrency(0));
                    $("#list").setCell(rowid, "Freight", formatCurrency($("#RailRate").val()));
                    $("#list").setCell(rowid, "LineTot", formatCurrency($("#RailRate").val()));
                }
                var data    = new Array();
                ids         = $("#list").getDataIDs();
                var IrecCnt = ids.length;
                var RecIndx = 0;
                function tmpobj() {};
                for (var id = 1; id <= IrecCnt; id++) {
                     var val1      = $("#list").getCell(id, "FrtFct");
                     var val2      = $("#list").getCell(id, "Bf");
                     val2          = removecommas(val2);
                     var val3      = $("#list").getCell(id, "Invtid");
                     var val4      = $("#list").getCell(id, "Qty");
                     var val5      = $("#list").getCell(id, "Unit");
                     var BU        = $("#list").getCell(id, "Bu");
                     var bu        = BU.split(" ");
                     var val6      = bu[0];
                     var val7      = $("#list").getCell(id, "Wcost");
                     val7          = removedollar(val7);
                     var val8      = $("#list").getCell(id, "Tcost");
                     val8          = removedollar(val8);
                     var val9      = $("#list").getCell(id, "SDDisc");
                     val9          = removedollar(val9);
                     var val10     = $("#list").getCell(id, "Tadj");
                     val10         = removedollar(val10);
                     var val11     = $("#list").getCell(id, "Addr");
                     val11         = removedollar(val11);
                     var val12     = $("#list").getCell(id, "Freight");
                     val12         = removedollar(val12);
                     var val13     = $("#list").getCell(id, "LineTot");
                     val13         = removedollar(val13);
                     data[RecIndx] = [val1,val2,val3,val4,val5,val6,val7,val8,val9,val10,val11,val12,val13];
                     RecIndx++;
                }
                tmpobj[\'do\']       = "updatequote";
                tmpobj.QuoteNbr    = $("#QuoteNbr").val();
                tmpobj.RevNbr      = $("#RevNbr").val();
                tmpobj.Custid      = $("#Custid").val();
                tmpobj.SlsPer      = $("#SlsPer").val();
                tmpobj.IssueDate   = $("#IssueDate").val();
                tmpobj.ShipVia     = $("#ShipVia").val();
                tmpobj.Carrier     = $("#Carrier").val();
                switch ($("#ShipVia").val()) {
                    case \'TRUCK\':
                         tmpobj.TrkRate  = $("#TrkRate").val();
                         tmpobj.FOB      = \'\';
                         tmpobj.Plant    = $("#Siteid").val();
                         tmpobj.RailRate = 0;
                         break;
                    case \'RAILCAR\':
                         tmpobj.RailRate = $("#RailRate").val();
                         tmpobj.TrkRate  = 0;
                         tmpobj.FOB      = \'\';
                         tmpobj.Plant    = $("#Plant").val();
                         break;
                    default:
                         tmpobj.FOB      = $("#FOB").val();
                         tmpobj.Plant    = \'\';
                         tmpobj.RailRate = 0;
                         tmpobj.TrkRate  = 0;
                }
                tmpobj.Instr       = $("#Instr").val();
                tmpobj.FollowUp    = $("#FollowUp").val();
                tmpobj.Notes       = $("#Notes").val();
                tmpobj.Closeq      = closeqv;
                tmpobj.Resolv      = $("#Resolv").val();
                tmpobj.RDate       = $("#RDate").val();
                tmpobj.Email       = $("#Email").val();
                tmpobj.Contact     = $("#Contact").val();
                tmpobj.LeadTime    = $("#LeadTime").val();
                tmpobj.Altid       = $("#Altid").val()
                if ($("#Altid").val() == \'Y\') {
                    tmpobj.Altfname = $("#Altfname").val();
                    tmpobj.Altlname = $("#Altlname").val();
                    tmpobj.Altaddr1 = $("#Altaddr1").val();
                    tmpobj.Altaddr2 = $("#Altaddr2").val();
                    tmpobj.Altcity  = $("#Altcity").val();
                    tmpobj.Altstate = $("#Altstate").val();
                    tmpobj.Altzip   = $("#Altzip").val();
                    tmpobj.Altphone = $("#Altphone").val();
                    tmpobj.Altfax   = $("#Altfax").val();
                }
                tmpobj.jsondata     = $.toJSON(data);
                $.ajax({
                    type: "POST",
                    url: "?do=updatequote",
                    data: tmpobj,
                    dataType: "json",
                    async: false,
                    success: function(head) {
                        var JSON = head;
                        $("#QuoteNbr").val(JSON.quotenbr);
                        $("#RevNbr").val(JSON.revnbr);
                        $("#OpenQuote").val(JSON.openquote);
                        alert("Quote number " + JSON.quotenbr + " / revision " + JSON.revnbr + " saved.");
                        $("#Closeq").attr(\'disabled\', false);
                        togStatus();
                    }
                });
                if ($("#OpenQuote").val() == \'N\') {
                    $("#FilePrint").attr(\'disabled\', true);
                    $("#FileOrder").attr(\'disabled\', true);
                    $("#FileSave").attr(\'disabled\', true);
                    $("#Resolv").attr(\'disabled\', true);
                } else {
                    $("#FilePrint").attr(\'disabled\', false);
                    $("#FileOrder").attr(\'disabled\', false);
                    $("#FileSave").attr(\'disabled\', false);
                    $("#Resolv").attr(\'disabled\', false);
                }
        }

        function formatCurrency(num) {
            num   = num.toString().replace(/\\$|\\,/g,\'\');
            if(isNaN(num)) num = "0";
            sign  = (num == (num = Math.abs(num)));
            num   = Math.floor(num*100+0.50000000001);
            cents = num%100;
            num   = Math.floor(num/100).toString();
            if(cents<10) cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
                num = num.substring(0,num.length-(4*i+3))+\',\'+
                num.substring(num.length-(4*i+3));
            return (((sign)?\'\':\'-\') + \'$\' + num + \'.\' + cents);
        }

        function setShipVia(X) {
           switch (X) {
               case 1:  var txt = \'TRUCK\';
                        break;
               case 2:  var txt = \'RAILCAR\';
                        break;
               default: var txt = \'CUST-PU\';
                        break;
           }
           $("#ShipVia").val(txt);
       }

    </script>

    '; ?>


</head>
<body onLoad="javascript:setUpForm()">
    <table style="background-color:black; color: white;" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="main_header">
            <td align="left" width="25%"><?php echo $this->_tpl_vars['title']; ?>
</td>
            <td align="center" width="25%"><?php echo $this->_tpl_vars['username']; ?>
</td>
            <td align="right" width="25%"><?php echo date("l F d,Y"); ?></td>
        </tr>
    </table>
    <div>
        <form action="" method=POST name=QuoteInputView id=QuoteInputView <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
              <div>
                <input type='hidden' name='OpenQuote' id='OpenQuote'>
                <input type='hidden' name='ShipVia'   id='ShipVia'>
                <input type='hidden' name='Siteid'    id='Siteid'>
                <input type='hidden' name='BtnPr'     id='BtnPr'>
                <input type='hidden' name='Altid'     id='Altid'>
                <input type='hidden' name='Altlname'  id='Altlname'>
                <input type='hidden' name='Altfname'  id='Altfname'>
                <input type='hidden' name='Altaddr1'  id='Altaddr1'>
                <input type='hidden' name='Altaddr2'  id='Altaddr2'>
                <input type='hidden' name='Altcity'   id='Altcity'>
                <input type='hidden' name='Altstate'  id='Altstate'>
                <input type='hidden' name='Altzip'    id='Altzip'>
                <input type='hidden' name='Altphone'  id='Altphone'>
                <input type='hidden' name='Altfax'    id='Altfax'>
                <br>
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:11%;"><b>Quote Number:</b></td>
                            <td style="width:7%;"><input id="QuoteNbr" type="text" style="width:100%;" name="QuoteNbr" tabindex="90" onchange="loadQuote()" value="New"></td>                            
                            <td style="width:4%;"><input id="RevNbr" type="text" style="width:90%;" name="RevNbr" readonly="readonly" value=''></td>
                            <td style="width:20%;">&nbsp;</td>
                            <td style="width:11.5%;"><b>Retrieve Quote:</b></td>
                            <td style="width:13.5%;">
                                <select id="RptType" style="width:90%;" tabindex="25" name="RptType">
                                    <option value="0">&nbsp;</option>
                                    <option value="1">Sort/Date</option>
                                    <option value="2">Sort/Customer</option>
                                    <option value="3">Sort/Salesman</option>
                                </select></td>
                            <td style="width:9%;"><b>Salesperson:</b></td>
                            <td style="width:5%;"><input id="SlsPer" type="text" style="width:90%;" name="SlsPer" readonly="readonly" value=<?php echo $this->_tpl_vars['Slsper']; ?>
></td>
                            <td style="width:9%;"><b>Quote Date:</b></td>
                            <td style="width:8%;"><input id="IssueDate" type="text" style="width:100%;" name="IssueDate" readonly="readonly" value=<?php echo $this->_tpl_vars['QDate']; ?>
></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div style="width:24%; height:22%; background-color:white; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:7%;"><b>Customer:</b><input type="text" onchange="javascript: alert('hello');" ></td>
                            <td style="width:40%;"><input id="Custid" tabindex="1" name="Custid" style="width:65%;" type="text" OnKeyupxx="return cUpper(this)" onchange="javascript: UpdateCust();" onchangex="javascript: alert('exiting from cust');"   >&nbsp;&nbsp;<a
                                    href="javascript:void(0)" onclick="doCustLookup(document.QuoteInputView.Custid);"><img alt="find"
                                    src="/graphics/binocular.gif" id=Customer align="bottom" border="0" height="16" width="16"></a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:7%;"><b>Contact:</b></td>
                            <td style="width:40%;"><input id="Contact" tabindex="2" style="width:100%;" name="Contact" type="text"></td>
                        </tr>
                        <tr>
                            <td style="width:7%;"><b>Email:</b></td>
                            <td style="width:40%;"><input type="text" name="Email" style="width:100%;" tabindex="3" id="Email"></td>
                        </tr>
                        <tr>
                            <td style="width:7%;">&nbsp;</td>
                            <td align="right" style="width:40%;"><button id="AdEmail" type="button" align="RIGHT" tabindex="21" onClick="javascript:AltEmail()">Adtl.Email</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:2%; height:22%; background-color:white; float:left">
            </div>
            <div style="width:35%; height:22%; background-color:white; float:left">
                <div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="edittab">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active" ><a href="#edittab-1" onclick="setShipVia(1)">TRUCK</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#edittab-2" onclick="setShipVia(2)">RAILCAR</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#edittab-3" onclick="setShipVia(3)">CUST-PU</a></li>
                    </ul>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom" id="edittab-1">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:3%;"><b>State:</b></td>
                                    <td style="width:9%;">
                                        <select id="State" style="width:95%; height:24px; font-size:14px;" tabindex="5" onchange="buildCities()" name="State">
                                            <?php unset($this->_sections['TAssign']);
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['state']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['TAssign']['show'] = true;
$this->_sections['TAssign']['max'] = $this->_sections['TAssign']['loop'];
$this->_sections['TAssign']['step'] = 1;
$this->_sections['TAssign']['start'] = $this->_sections['TAssign']['step'] > 0 ? 0 : $this->_sections['TAssign']['loop']-1;
if ($this->_sections['TAssign']['show']) {
    $this->_sections['TAssign']['total'] = $this->_sections['TAssign']['loop'];
    if ($this->_sections['TAssign']['total'] == 0)
        $this->_sections['TAssign']['show'] = false;
} else
    $this->_sections['TAssign']['total'] = 0;
if ($this->_sections['TAssign']['show']):

            for ($this->_sections['TAssign']['index'] = $this->_sections['TAssign']['start'], $this->_sections['TAssign']['iteration'] = 1;
                 $this->_sections['TAssign']['iteration'] <= $this->_sections['TAssign']['total'];
                 $this->_sections['TAssign']['index'] += $this->_sections['TAssign']['step'], $this->_sections['TAssign']['iteration']++):
$this->_sections['TAssign']['rownum'] = $this->_sections['TAssign']['iteration'];
$this->_sections['TAssign']['index_prev'] = $this->_sections['TAssign']['index'] - $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['index_next'] = $this->_sections['TAssign']['index'] + $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['first']      = ($this->_sections['TAssign']['iteration'] == 1);
$this->_sections['TAssign']['last']       = ($this->_sections['TAssign']['iteration'] == $this->_sections['TAssign']['total']);
?>
                                            <option value=<?php echo $this->_tpl_vars['indx'][$this->_sections['TAssign']['index']]; ?>
><?php echo $this->_tpl_vars['state'][$this->_sections['TAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                                    <td style="font-size:14px; font-family:Times,serif; width:3%;"><b>City:</b></td>
                                    <td style="width:28%;">
                                        <select id="CityLst" style="width:100%; height:24px; font-size:14px;" tabindex="6" onchange="buildRates()" name="CityLst">
                                            <option value="">&nbsp;</option>
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:3%;"><b>Rate:</b></td>
                                    <td style="width:12%;"><input type="text" name="TrkRate" style="width:90%; height:24px; font-size:14px;" tabindex="7" onchange="calcRates(2)" id="TrkRate"></td>
                                    <td style="font-size:14px; font-family:Times,serif; width:4%;"><b>Plant:</b></td>
                                    <td style="width:22%;">
                                        <select id="RateLst" style="width:100%; height:24px; font-size:14px;" tabindex="8" onchange="calcRates(3)" name="RateLst">
                                            <option value=" ">&nbsp;</option>
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-2">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:5%;"><b>Rail Rate:</b></td>
                                    <td style="width:24%;"><input type="text" name="RailRate" style="width:35%; height:24px; font-size:14px;" tabindex="9" onchange="calcRates(4)" value=0 id="RailRate"></td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:10%;"><b>Delivery Carrier:</b></td>
                                    <td style="width:24%;"><input type="text" name="Carrier" style="width:100%; height:24px; font-size:14px;" tabindex="10" value='' id="Carrier"></td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:5%;"><b>Plant:</b></td>
                                    <td style="width:24%;">
                                        <select id="Plant" style="width:60%; height:24px; font-size:14px;" tabindex="11" onchange="calcRates(0)" name="Plant">
                                            <?php unset($this->_sections['SAssign']);
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
                                            <option value=<?php echo $this->_tpl_vars['site'][$this->_sections['SAssign']['index']]; ?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="edittab-3">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="font-size:14px; font-family:Times,serif; width:5%;"><b>FOB:</b></td>
                                    <td style="width:24%;">
                                        <select id="FOB" style="width:60%; height:24px; font-size:14px;" tabindex="11" onchange="calcRates(0)" name="FOB">
                                            <?php unset($this->_sections['SAssign']);
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
                                            <option value=<?php echo $this->_tpl_vars['site'][$this->_sections['SAssign']['index']]; ?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script type="text/javascript">
                    $("#edittab").tabs();
                </script>
            </div>
            <div style="width:2%; height:22%; background-color:white; float:left">
            </div>
            <div style="width:7%; height:22%; background-color:white; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:20%;"><button id="AltAddr" type="button" style="width:100%;" tabindex="24" onClick="javascript:AltAddress();">Alt.Ship</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:30%; height:22%; background-color:white; float:left">
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:100%;"><textarea id="CustAddr" style="width:100%;" rows="6" cols="35" tabindex="38"
                                                              readonly="readonly" name="CustAddr"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width:100%; background-color:white; float:left">
                <hr>
                <TABLE id="list" class="scroll" style="font-size:12px; width:100%;"></TABLE>
                <hr>
            </div>
            <div>
                <div class="center" style="width:50%; height:5%; background-color:#eeeeee; float:left">
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:43%;">
                                    <button id="ALine" type="button" tabindex="12" onClick="javascript:AddL();">Add Line</button>
                                    <button id="ELine" type="button" tabindex="13" onClick="javascript:EditL();">Edit Line</button>
                                    <button id="DLine" type="button" tabindex="14" onClick="javascript:DelL();">Delete Line</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="left" style="width:50%; height:5%; background-color:#eeeeee; float:right">
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:10%;"><b>Lead Time:</b></td>
                                <td style="width:28%;"><input id="LeadTime" style="width:90%;" tabindex="15" name="LeadTime" type="text"></td>
                                <td style="width:8%;"><b>Total BF:</b></td>
                                <td style="width:11%;"><input id="TotBF" style="width:100%;" tabindex="99" name="TotBF" readonly="readonly" type="text" value=''></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div style="width:50%; height:23%; background-color:white; float:left">
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:10%;"><b>Instructions:</b></td>
                                <td style="width:58%;"><textarea id="Instr" style="width:100%;" rows="4" cols="50" tabindex="16"
                                                                 name="Instr"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:14%;"><b>Follow Up:</b></td>
                                <td style="width:54%;"><input id="FollowUp" style="width:20%;" tabindex="17" name="FollowUp" type="text" value=''></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:3%;"><button id="FileSave" type="button" tabindex="21" onClick="javascript:QuoteSave();">Save</button></td>
                                <td style="width:3%;"><button id="FileNew" type="button" tabindex="22" onClick="javascript:Reset();">Reset</button></td>
                                <td style="width:3%;"><button id="FilePrint" type="button" tabindex="23">Print</button></td>
                                <td style="width:24%;"><button id="FileOrder" type="button" tabindex="24">Make Order</button></td>
                                
                            <td style="width:14%;"><b>Close Quote:</b></td>
                            <td style="width:6%;"><input type=checkbox name=Closeq id=Closeq onclick=togStatus() tabindex=30></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="width:50%; height:23%; background-color:white; float:left">
                    <hr>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:8%;"><b>Notes:</b></td>
                                <td style="width:60%;"><textarea id="Notes" style="width:100%;" rows="4" cols="50" tabindex="18"
                                                                 name="Notes"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;">
                        <tbody>
                           <tr>
                                <td style="width:7%;"><b>Status:</b></td>
                                <td style="width:45%;">
                                <select id="Resolv" style="width:95%;" tabindex="19" name="Resolv" onchange="setCurDate()">
                                    <option value="">&nbsp;</option>
                                </select></td>
                                <td style="width:5%;"><b>Date:</b></td>
                                <td style="width:11%;"><input id="RDate" style="width:100%;" tabindex="90" name="RDate" readonly="readonly" type="text" value=''></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                        <table style="width:100%;">
                           <tbody>
                               <tr>
                                  <td style="width:2%;"><b>&nbsp;</b></td>
                                  <td style="color:red; width:66%;"><b><span id="Msg"></span></b></td>
                               </tr>
                           </tbody>
                        </table>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript"> document.getElementById("Custid").focus(); </script>
    <div id="input-dialog" class="modal-dialog">
        <div id="dialog-detail"></div>
    </div>
</body>
</html>