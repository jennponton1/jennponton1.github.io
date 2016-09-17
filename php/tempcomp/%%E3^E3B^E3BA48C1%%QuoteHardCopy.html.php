<?php /* Smarty version 2.6.13, created on 2013-09-24 09:39:36
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes/views/QuoteHardCopy.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php echo '
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <script type="text/javascript" src="/Ajax/JQueryUI/js/jquery-1.4.4.min.js"></script>
  <script type="text/javascript">

    var emailhold    = \'\';
    $(document).ready(function() {
        var data     = new Array();
            $.ajax({
                type: "GET",
                url: "?do=getquoteB&quotenbr="+$("#quotenbr").val()+"&revnbr="+$("#revnbr").val(),
                dataType: "json",
                async: true,
                success: function(head) {
                         $("#quote").html(head[\'quotenbr\']);
                         $("#revnb").html(head[\'revnbr\']);
                         $("#rdate").html(head[\'rdate\']);
                         $("#issuedate").html(head[\'issuedate\']);
                         $("#custid").html(head[\'custid\']);
                         var custid      = head[\'custid\'];
                         $("#salesman").html(head[\'sname\']);
                         $("#email").html(head[\'mail\']);
                         $("#rchrg").html(head[\'rchrg\']);
                         $("#siteid").html(head[\'siteid\']); 
                         $("#contact").html(head[\'confirmto\']);
                         $("#leadtime").html(head[\'leadtime\']);
                         $("#tso").html(head[\'tso\']);
                         $("#railrate").html(head[\'railrate\']);
                         emailhold       = head[\'email\'];
                         var etextstring = head[\'email\'];
                         var etext       = etextstring.split(",");
                         $("#custemail").html(etext[0]);
                         var bulkinstr   = head[\'instr\'];
                         var instrstr    = \'\';
                         var instr       = bulkinstr.split("\\n");
                         for (var i = 0; i < instr.length; i++) {
                              instrstr += instr[i] + \'<br>\';
                         }
                         $("#instr").html(instrstr);
                         $("#shipvia").html(head[\'shipvia\']);
                         
                         $("#lname").html(head[\'shiptolname\']);
                         $("#fname").html(head[\'shiptofname\']);
                         $("#addr1").html(head[\'shiptoaddr1\']);
                         $("#addr2").html(head[\'shiptoaddr2\']);
                         var addr = " " + trim(head[\'shiptocity\']) + " " + trim(head[\'shiptostate\']) + " " + trim(head[\'shiptozip\']);
                         $("#citystate").html(addr);
                         $("#phone").html(head[\'shiptophone\']);
                         $("#fax").html(head[\'shiptofax\']);

                         if (head[\'shipvia\'] == \'CUST-PU\') {
                             $("#lname").html(\'Customer Pickup\');
                             $("#fname").html(\'\');
                         }
                         
                         $.ajax({
                             type: "GET",
                             url: "?do=getquotedetailB&quotenbr="+$("#quotenbr").val()+"&revnbr="+$("#revnbr").val(),
                             dataType: "json",
                             async: false,
                             success: function(data) {
                                      for(row in data.rows) {
                                          var newRowStr    = "";
                                          for (item in data.rows[row].cell) {
                                               var alignStr = "right"
                                               if (item == 0) {
                                                   alignStr = "left"
                                               }
                                               newRowStr += "<td style=\\"text-align:"+alignStr+"\\">"+data.rows[row].cell[item]+"</td>";
                                          }
                                          newRowStr = "<tr>"+newRowStr+"</tr>";
                                          $("#tbl_quote_dtl").append(newRowStr);
                                      }
                             }
                        });
                        $.ajax({
                            type: "GET",
                            url: "?do=getcaddress&custid="+custid,
                            dataType: "json",
                            async: false,
                            success: function(ret) {
                                     $("#ad1").html(ret[\'ad1\']);
                                     $("#ad2").html(ret[\'ad2\']);
                                     $("#ad3").html(ret[\'ad3\']);
                                     var addr = " " + trim(ret[\'ad4\']) + " " + trim(ret[\'ad5\']) + " " + trim(ret[\'ad6\']);
                                     $("#citystateB").html(addr);
                                     $("#ad7").html(ret[\'ad7\']);
                                     $("#ad8").html(ret[\'ad8\']);
                            }
                        });
                }
            });
    });

    function trim(stringToTrim) {
        return stringToTrim.replace(/^\\s+|\\s+$/g,"");
    }

    function emailSend() {
        var collect       = $("#collect").val();
        var addr          = \'\';
        var dat           = Object();
        var addressString = $("#email").html() + \',\' + emailhold;
        var addrspl       = addressString.split(",");
        for (var i = 0; i <= 9; i++) {
             if (collect.substr(i,1) == \'1\') {
                 if (addrspl[i] == undefined) {
                 } else {
                     addr = addr + addrspl[i] + \',\';
                 }
             }
        }
        dat.addr          = addr.slice(0,(addr.length - 1));
        dat.content       = $("#content").html();
        dat.sender        = $("#email").html();
        if (dat.sender == \'\') {
            dat.sender = \'Sales@Hoover Treated Wood\';
        }
        $.ajax({
             type: "POST",
             data: dat,
             url: "EQuote.php?do=sendemail",
             dataType: "json",
             async: false,
             error: function(jxhr, textstat, errthr) {
                    alert("Failed: " + textstat + " :" + errthr);
             },
             success: function(data) {
                      if (data.result == \'1\') {
                          alert("Email sent.");
                      } else {
                          alert("Email failed.");
                      }
             }
         });
         window.close();
    }

</script>
'; ?>

<form method=POST action="" name=QuoteHardCopy id=QuoteHardCopy <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
</head>
<body>
     <input type='hidden' name='quotenbr' id='quotenbr' value=<?php echo $this->_tpl_vars['quotenbr']; ?>
>
     <input type='hidden' name='revnbr'   id='revnbr'   value=<?php echo $this->_tpl_vars['revnbr']; ?>
>
     <input type='hidden' name='custid'   id='custid'>
     <input type='hidden' name='collect'  id='collect'  value=<?php echo $this->_tpl_vars['collect']; ?>
>
     <div id='content'>
     <table style="width: 100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Quote Nbr:</b></td>
                <td style="width:25%;"><span id=quote></span></td>
                <td style="width:8%;"><b>Issue Date:</b></td>
                <td style="width:59%;"><span id=issuedate></span></td></tr>
            <tr><td style="width:8%;"><b>Rev.Nbr:</b></td>
                <td style="width:25%;"><span id=revnb></span></td>
                <td style="width:8%;"><b>Rev.Date:</b></td>
                <td style="width:59%;"><span id=rdate></span></td></tr> 
            <tr><td style="width:8%;"><b>Salesman:</b></td>
                <td style="width:25%;"><span id=salesman></span></td>
                <td style="width:8%;"><b>E-Mail:</b></td>
                <td style="width:59%;"><span id=email></span></td></tr>
         </tbody>
     </table>
     <hr>
     <br>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Customer:</b></td>
                <td style="width:25%;"><span id=ad1></span></td>
                <td style="width:8%;"><b>Deliver To:</b></td>
                <td style="width:59%;"><span id=lname></span></td></tr>
         </tbody>
     </table>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;">&nbsp;</td>
                <td style="width:25%;"><span id=ad2></span></td>
                <td style="width:8%;">&nbsp;</td>
                <td style="width:59%;"><span id=addr1></span></td></tr>
            <tr><td style="width:8%;">&nbsp;</td>
                <td style="width:25%;"><span id=ad3></span></td>
                <td style="width:8%;">&nbsp;</td>
                <td style="width:59%;"><span id=addr2></span></td></tr>
            <tr><td style="width:8%;">&nbsp;</td>
                <td style="width:25%;"><span id=citystateB></span></td>
                <td style="width:8%;">&nbsp;</td>
                <td style="width:59%;"><span id=citystate></span></td></tr>
         </tbody>
    </table>
    <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Phone:</b></td>
                <td style="width:25%;"><span id=ad7></span></td>
                <td style="width:8%;"><b>&nbsp;</b></td>
                <td style="width:59%;"><span id=phone></span></td></tr>
            <tr><td style="width:8%;"><b>Fax:</b></td>
                <td style="width:25%;"><span id=ad8></span></td>
                <td style="width:8%;"><b>&nbsp;</b></td>
                <td style="width:30%;"><span id=fax></span></td></tr>
         </tbody>
     </table>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Contact:</b></td>
                <td style="width:25%;"><span id=contact></span></td>
                <td style="width:8%;"><b>E-Mail:</b></td>
                <td style="width:59%;"><span id=custemail></span></td></tr>
         </tbody>
     </table>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;"><b>LeadTime:</b></td>
                <td style="width:92%;"><span id=leadtime></span></td></tr>
         </tbody>
     </table>
     <table style="width:100%;" id="tbl_quote_dtl">
     <br>
     <hr>
         <colgroup>
         <col style="width:24%">
         <col style="width:7%">
         <col style="width:7%">
         <col style="width:7%">
         <col style="width:7%">
         <col style="width:48%">
         </colgroup>
         <thead>
             <tr><th>Material</th>
                 <th>Quantity</th>
                 <th>Unit</th>
                 <th>Price</th>
                 <th>Billing Unit<th>
                 <th>&nbsp;<th></tr>
             <tr><th><hr></th>
                 <th><hr></th>
                 <th><hr></th>
                 <th><hr></th>
                 <th><hr></th>
                 <th><hr></th></tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <br>
     <hr>
     <br>
     <table style="width: 100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Shipped Via:</b></td>
                <td style="width:92%;"><span id=shipvia></span></td></tr>
         </tbody>
     </table>
    <?php if ($this->_tpl_vars['shipvia'] == "O-TRUCK"): ?>
    <?php elseif ($this->_tpl_vars['shipvia'] == 'RAILCAR'): ?>
         <table style="width:100%;">
              <tbody>
              <tr><td style="width:8%;"><b>Rail Rate:</b></td>
                  <td style="width:10%;"><span id=railrate></span></td>
                  <td style="width:1%;"></td>
                  <td style="width:81%;"><span id=rchrg></span></td></tr>
              </tbody>
         </table>
         <table style="width:100%;">
              <tbody>
              <tr><td style="width:8%;"><b>Carrier:</b></td>
                  <td style="width:92%;"><span id=carrier></span></td></tr>
              </tbody>
         </table>
    <?php else: ?>
    <?php endif; ?>
     <table style="width:100%;">
         <tbody>
         <tr><td style="width:8%;"><b>Plant:</b></td>
             <td style="width:92%;"><span id=siteid></span></td></tr>
         </tbody>
     </table>
     <?php if ($this->_tpl_vars['tso'] == 'Y'): ?>
        <table style="width:100%;">
            <tbody>
            <tr><td style="width:8%;"><b>Service:</b></td>
                <td style="width:92%;"><span>TSO Service Only</span></td></tr>
            </tbody>
        </table>
     <?php endif; ?>
     <br>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:8%;"><b>Special Instr:</b></td>
                <td style="width:92%;"><span id=instr></span></td></tr>
         </tbody>
     </table>
     <br>
     <br>
     <br>
     <table style="width:100%;">
         <tbody>
            <tr><td><b>PRICES AND AVAILABILITY ARE SUBJECT TO CHANGE WITHOUT NOTICE</b></td></tr>
            <tr><td><b>ALL ITEMS ARE SUBJECT TO PRIOR SALE</b></td></tr>
            <tr><td><b>NOT RESPONSIBLE FOR TYPOGRAPHICAL ERRORS</b></td></tr>
         </tbody>
     </table>
     </div>
     <br>
     <br>
     <br>
     <hr>
     <table style="width:100%;">
         <tbody>
            <tr><td style="width:1%;"></td>
                <td style="width:2%;"><button id="Send" type="button" tabindex="2" onClick="emailSend()">Send</button></td>
                <td style="width:97%;"></td></tr>
         </tbody>
     </table>
     </form>
</body>
</html>