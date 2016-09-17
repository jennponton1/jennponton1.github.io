<?php /* Smarty version 2.6.13, created on 2014-07-23 09:53:46
         compiled from C:%5Cinetpub%5Cwwwroot%5CFinancial%5CDataEntry%5Cmonthend/views/monthEndMenu.tpl */ ?>
<html>
    <head>
        <title>Month End</title>
        <meta charset="UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="js/main.js"></script>
        <script src="js/CloseInventory.js"></script>
        <script src="js/CloseAR.js"></script>
        <script src="js/CloseAP.js"></script>
        <script src="js/CloseGL.js"></script>
        <script src="js/PostGL.js"></script>
        <link href="/globals/css/jquery/htw.datatables.css" rel="stylesheet">
    </head>
    <!-- <?php echo ' -->
    <style>
        body {
                font-family: \'trebuchet MS\', \'Lucida sans\', Arial;
                font-size: 18px;
                color: #444;
        }
    </style>
    <!-- '; ?>
 -->
    <br>
    <br>
    <table style="width: 30%;">
        <td><b>Select Database:</b></td>
        <td>
            <select id="dsn" name="dsn" onchange="javascript:MonthEnd.validations();">
                <option value="CEN" selected="true">Central</option>
                <option value="COR">Corporate</option>
                <option value="DIL">Dillard</option>                       
            </select>
        </td>
    </table>
    <br>
    <hr>
    <br>
    <br>
    <body>
        <table>
            <tr>
                <td><h3>Module</h3></td>
                <td><h3>Current Period</h3></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Inventory</b></td>
                <td style="color:green; font-size: 18px;"><b><center><span id="inPer"><?php echo $this->_tpl_vars['inPer']; ?>
</span></center></b></td>
                <td><center><span id="inButton"><button id="closeInv">Close</button></span></center></td>
                <td style="color:red; font-size: 18px;"><b><span id="invMsg"></span></b></td>            
                <td></td>
            </tr>
            <tr>
                <td><b>Accounts Receivable</b></td>
                <td style="color:green; font-size: 18px;"><b><center><span id="arPer"><?php echo $this->_tpl_vars['arPer']; ?>
</span></center></b></td>
                <td><center><span id="arButton"><button id="closeAR">Close</button></span></center></td>
                <td style="color:red; font-size: 18px;"><b><span id="arMsg"></span></b></td>            
                <td></td>
            </tr>
            <tr>
                <td><b>Accounts Payable</b></td>
                <td style="color:green; font-size: 18px;"><b><center><span id="apPer"><?php echo $this->_tpl_vars['apPer']; ?>
</span></center></b></td>
                <td><center><span id="apButton"><button id="closeAP">Close</button></span></center></td>
                <td style="color:red; font-size: 18px;"><b><span id="apMsg"></span></b></td>            
                <td></td>
            </tr>
            <tr>
                <td><b>Close General Ledger</b></td>
                <td style="color:green; font-size: 18px;"><b><center><span id="glClsPer"><?php echo $this->_tpl_vars['glPer']; ?>
</span></center></b></td>
                <td><center><span id="glClsButton"><button id="closeGL">Close</button></span></center></td>
                <td style="color:red; font-size: 18px;"><b><span id="glMsg"></span></b></td>            
                <td></td>
            </tr>
            <tr>
                <td><b>Post General Ledger</b></td>
                <td style="color:green; font-size: 18px;"><b><center><span id="glPostPer"><?php echo $this->_tpl_vars['glPer']; ?>
</span></center></b></td>
                <td><center><span id="glButton"><button id="postGL">Post</button></span></center></td>
                <td style="color:red; font-size: 18px;"><b><span id="glMsg"></span></b></td>            
                <td></td>
            </tr>
        </table>
    </body>
</html>
<!-- <?php echo ' -->
<script>
    $("#closeInv").on("click",function() { CloseInventory.closeInv(); });
    $("#closeAR").on("click", function() { CloseAR.closeAR(); });
    $("#closeAP").on("click", function() { CloseAP.closeAP(); });
    $("#closeGL").on("click", function() { CloseGL.closeGL(); });
    $("#postGL").on("click", function() { PostGL.postGL(); });
</script>
<!-- '; ?>
 -->