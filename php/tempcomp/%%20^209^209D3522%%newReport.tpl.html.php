<?php /* Smarty version 2.6.13, created on 2014-09-29 11:06:52
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Creports%5Copenquotes/views/newReport.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Quotes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <link rel="stylesheet" href="/globals/css/jquery/htw.datatables.css">
        <!-- <?php echo ' -->
        <style>
           
            html, body { margin: 0px; }
            h3 {
                text-align: center;
            }
            body,
            ul,
            div {
                font-family: \'trebuchet MS\', \'Lucida sans\', Arial; font-size: 14px; 
            }
            #criteriaBox {
                background-color: #EDEDED;
                border: thin solid black;
                min-height: 5em;
            }
            #criteriaBox input,
            #criteriaBox select {
                background-color: #FFFFFF;
            }
            #criteriaBox label span {
                min-width: 10em;
                display: inline-block;
            }
            .critSet {
                border: thin solid black;
            }
            span.filter {
                display: inline-block;
                min-width: 3em;
            }

            #datatbl tbody tr.even:hover td,
            #datatbl tbody tr.odd:hover td
            {
                border-collapse: collapse;
                border: thin solid black;
                padding: 2px 9px;
            }          
            
            #stuff {
                border:             0px solid black;
                background-color:   #ffffff;
                width:              128px;
                height:             128px;
                position:           absolute;
                top:                300px;
                left:               800px;
            }

            table.dataTable td.dtlWindow div {
                width: 100%;
                font: inherit;
                border: none;
            }
            table.dataTable tr.even ul,
            table.dataTable tr.odd ul{
                font: inherit;
            }
            table#dtlWindowTbl {
                max-width: 99%;
            }
           
            .dtlWindow #dtlWindowTbl tr:hover td {
                border: none;
            }
            .dtlWindow #dtlWindowTbl tr td {
                border: none;
            }
            
            #dtlWindowTbl_wrapper {             
                margin-left:        0px;
                margin-top:         0px;
                width:              98%;
            }
            #dtlWinPr.dtlWinNavBtn {
                float:              right;
                margin-right:       10px;
                margin-top:         10px;
                width:              90px;
                height:             20px;                
                text-align:         center;
                border:             thin solid black;
                background:         -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
                background:         -webkit-linear-gradient(top, #f5f5f5, #eee);
                background:         -moz-linear-gradient(top, #f5f5f5, #eee);
                background:         -ms-linear-gradient(top, #f5f5f5, #eee);
                background:         -o-linear-gradient(top, #f5f5f5, #eee);
                background:         linear-gradient(top, #f5f5f5, #eee);
                color:              black;
                font-size:          smaller;
            }             
            #dtlWinNxt.dtlWinNavBtn {
                float:              right;
                margin-right:       10px;
                margin-top:         10px;
                width:              90px;
                height:             20px;                
                text-align:         center;
                border:             thin solid black;
                background:         -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
                background:         -webkit-linear-gradient(top, #f5f5f5, #eee);
                background:         -moz-linear-gradient(top, #f5f5f5, #eee);
                background:         -ms-linear-gradient(top, #f5f5f5, #eee);
                background:         -o-linear-gradient(top, #f5f5f5, #eee);
                background:         linear-gradient(top, #f5f5f5, #eee);
                color:              black;
                font-size:          smaller;
            }            
            #dtlWinCol.dtlWinNavBtn {
                float:              right;
                margin-right:       50px;
                margin-top:         10px;
                width:              120px;
                height:             20px;                 
                text-align:         center;
                border:             thin solid black;
                background:         -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
                background:         -webkit-linear-gradient(top, #f5f5f5, #eee);
                background:         -moz-linear-gradient(top, #f5f5f5, #eee);
                background:         -ms-linear-gradient(top, #f5f5f5, #eee);
                background:         -o-linear-gradient(top, #f5f5f5, #eee);
                background:         linear-gradient(top, #f5f5f5, #eee);
                color:              black;
                font-size:          smaller;
            }    
            .formatPlus {
                text-align:         center;
                width:              20px;
            }
            #loading {
                background-color:   #ffffff;
                border:             1px solid black; 
                width:              128px;
                height:             128px;
                position:           absolute;
                margin-left:        600px;
                margin-top:         250px;
                opacity:            1;
            }

            #opacityCover {
                border:             solid 2px #cccccc;  
                background-color:   #cccccc;  
                opacity:            .5;  
                width:              98%;  
                height:             95%;
                margin-left:        auto;
                margin-right:       auto; 
                text-align:         center;
                vertical-align:     middle;
            }            
        </style>
        <!-- '; ?>
 -->
    </head>
    <body>
        <div>
            <h3>Quote Explorer</h3>
        </div>
        <div id="maincontent">
            
            <div id="criteriaBox">
                <fieldset class="critSet">
                    <table style="border: 0px solid black; ">
                        <tr>
                            <td style="text-align: right; width: 150px; border: 0px solid black; ">Select Salesperson:</td>
                            <td style="padding-left: 5px;  border: 0px solid black; ">
                                <select id="spSelect">
                                    <option value="">All</option>
                                </select>         
                            </td>
                            <td style="width: 175px; border: 0px solid black; "><button id="clrSP" type="button">Clear SalesPerson Filter</button></td>  
                            
                            <td style="text-align: right; width: 150px;  border: 0px solid black; ">Select Status:</td>
                            <td style="padding-left: 5px;  border: 0px solid black; ">
                               <select id="statSelect">
                                        <option value="">All</option>
                                        <option value="Y">Open</option>
                                        <option value="N">Closed</option>
                                    </select>
                                            
                            </td>
                            <td style="border: 0px solid black; "><button id="clrStat" type="button">Clear Status Filter</button></td>                              
                        </tr>
                        <tr>
                            <td style="text-align: right; width: 150px; ">Select Site:</td>
                            <td style="padding-left: 5px; ">
                                <select id="siteSelect">
                                    <option value="">All</option>
                                </select>        
                            </td>
                            <td><button id="clrSite" type="button">Clear Site Filter</button></td>  
                            
                            <td style="text-align: right; width: 150px; ">Select Customer:</td>
                            <td style="padding-left: 5px; ">
                            <select id="custSelect">
                                <option value="">All</option>
                            </select>
                                            
                            </td>
                            <td><button id="clrCustomer" type="button">Clear Customer Filter</button></td>                              
                        </tr>
                        <tr>
                            <td style="text-align: right; width: 150px; ">&nbsp;</td>
                            <td style="padding-left: 5px; ">&nbsp;</td>
                            <td><button id="clrAll" type="button">Clear All Filters</button></td>  
                            
                            <td style="text-align: right; width: 150px; ">&nbsp;</td>
                            <td style="padding-left: 5px; ">&nbsp;</td>
                            <td>&nbsp;</td>                              
                        </tr>                        
                    </table>
                </fieldset>
            </div>
            <table id="datatbl"></table>

        </div>

        <div id="loading">
            <img id="waitgraphic" src="images/busy.gif">
        </div>        
        
        <script src="js/newreport.js?vdt=<?php echo time(); ?>
">
        </script>
    </body>
</html>