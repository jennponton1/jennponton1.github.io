<?php /* Smarty version 2.6.13, created on 2014-10-13 15:32:20
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cinquiry%5Csalesorderlookup/views/newReport.tpl.html */ ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Customer Order Lookup</title> 
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <link rel="stylesheet" href="/globals/css/jquery/htw.datatables.css">
        <!-- <?php echo ' -->
        <link rel="stylesheet" href="css/site.css" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <!-- '; ?>
 --> 
</head>
<body>
    <div id="everything">
        <div id="wrapper">

            <div id="top">
                <div id="topimage">
                    <img src="images/hoover-logo-color_0.gif" alt="Hoover Logo">
                    <div id="logotext">1742 Warrenton Hwy Thomson, GA 30824</div> 
                </div>
                <div id="topform">
                    <form method="post" id="myForm">
                        <div>
                            <label for="custSelect">Select Customer #</label>
                            <select id="custSelect" size="1" style="width: 275px">
                                <option style="background-color: yellow; " 
                                        value="">Loading Customer List.........</option>
                            </select>
                            <span id="dtlCustNum"></span>
                        </div>
                        <div>
                            <label for="txtOrder"><b>OR</b> Enter Order #</label>
                            <input type='text' id='txtOrder' size='8' maxlength='6'>
                            <button type='button' id='getCustThisOrdNbr'>Search</button>
                        </div>
                        <div style="border-top: 1px solid black; background-color: white;">
                            <label for="myEmail">Select Order #</label>
                            <select id="selOrder" size="1" STYLE="width: 275px; border-right: 1px solid #cccccc; ">
                                <option value="">Select Order</option>
                            </select>
                            <button id="getOrderDetails" type="button" disabled>Details</button>  
                            <span id="dtlOrdNbr"></span>
                        </div>
                    </form>
                </div>          
                <div id="extraControl">
                    <input type="button" id="btnDelivery" value="View Delivery Ticket" disabled="disabled"><br>
                    <input type="button" id="btnRefresh" value="Refresh Orders" disabled="disabled">                    
                </div>
            </div>
            <div id="billingAddress">
                <h5>Billed To:</h5>
                <blockquote>
                    <span id="dtlBillCustName"></span><br>
                    <span id="dtlBillAddr1"></span><br>
                    <span id="dtlBillAddr2"></span><br>
                    <span id="dtlBillCity"></span>
                    <span id="dtlBillState"></span>
                    <span id="dtlBillZip"></span>
                </blockquote>
            </div>
            <div id="shippingAddress">
                <h5>Shipped To:</h5>
                <blockquote>
                    <span id="dtlShipCustName"></span><br>
                    <span id="dtlShipAddr1"></span><br>
                    <span id="dtlShipAddr2"></span><br>
                    <span id="dtlShipCity"></span>
                    <span id="dtlShipState"></span>
                    <span id="dtlShipZip"></span>
                </blockquote>                
            </div> 
            <div id="freight">
                <table id="ordList">
                <tr>
                    <th>Order Type</th>                            
                    <td><span id="dtlOrdType"></span></td>                            

                    <th>Order Date</th>                            
                    <td><span id="dtlOrdDate"></span></td>                            

                    <th>Price FOB</th>                            
                    <td><span id="dtlFob"></span></td> 
                </tr>
                        
                <tr>
                    <th>Terms</th>                            
                    <td><span id="dtlterms"></span></td>                            

                    <th>Ship Via</th>                            
                    <td><span id="dtlShipVia"></span></td>                            

                    <th>Ship Date</th>                            
                    <td><span id="dtlShipDate"></span></td>                            
                </tr>

                <tr>
                    <th>Salesperson</th>                            
                    <td><span id="dtlSlsPerId"></span></td>                            

                    <th>Customer Order #</th>                            
                    <td><span id="dtlCustOrdNbr"></span></td>                            

                    <th>Status</th>                            
                    <td><span id="dtlStatus"></span></td>                      
                </tr>                        
                </table>
            </div> 
                    
            <div id="product">
                <div id="lstDetail"></div>              
            </div>            
        </div>
        <div id="opacityCover">        
            <div id="loading">
                <img id="waitgraphic" src="images/busy.gif">
            </div>
        </div>            

        <div id="deliveryTicket"></div>
        
        <div id="dialog-message">
            <div id="modalContent"></div>
        </div>    
        <script src="js/newreport.js?vdt=<?php echo time(); ?>
"></script>
    </div>    
</body>
</html>