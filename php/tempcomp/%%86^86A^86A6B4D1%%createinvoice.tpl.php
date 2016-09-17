<?php /* Smarty version 2.6.13, created on 2015-03-16 13:57:50
         compiled from C:%5Cinetpub%5Cwwwroot%5CFinancial%5CDataEntry%5Caccountsreceivable/views/createinvoice.tpl */ ?>
<html>
    <head>
         <script src="/globals/js/jquery/jquery.js"></script>
         <script src="/globals/js/jquery/jquery-ui.js"></script>
         <script src="/globals/js/jquery/jquery.datatables.js"></script>
         <script src="/globals/js/jquery/jquery.datatables.js.responsive"></script>
         <link rel="stylesheet" href="/globals/css/jquery/jquery-ui.css">
         <link rel="stylesheet" href="views/dataTables.css">
         <link rel="stylesheet" href="views/styles.css">
         <script src="js/createinvoice.js"></script>

    <body>
   <form action="" method="POST" name="crtInvc" id="crtInvc" <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
           <input type="hidden" name="order_num" id="order_num"  value='<?php echo $this->_tpl_vars['order_num']; ?>
'>
           <input type="hidden" name="custid" id="custid" value="<?php echo $this->_tpl_vars['custid']; ?>
">
           <input type="hidden" name="duedate" id="duedate" value="<?php echo $this->_tpl_vars['duedate']; ?>
">
           <input type="hidden" name="deliverydata" id="deliverydata"  value='<?php echo $this->_tpl_vars['dtdata']; ?>
'>
           <input type="hidden" name="sodat" id="sodat" value="<?php echo $this->_tpl_vars['sodat']; ?>
">
           <input type="hidden" name="tmpfname" id="tmpfname" value="<?php echo $this->_tpl_vars['tmpfname']; ?>
">
           <input type="hidden" name="maxlinenbr" id="maxlinenbr" value="<?php echo $this->_tpl_vars['maxlinenbr']; ?>
">
           <input type="hidden" name="maxlineid" id="maxlineid" value="<?php echo $this->_tpl_vars['maxlineid']; ?>
">
       </form>
            <div id="wrapper">
                 <div id="tophead">
                    <div id="invdt" class="box">Invoice Date: <input type="text" name="invcdate" id="invcdate" readonly="readonly"/>
                    </div>
                    <div id="invn" class="box">Invoice#: <input type="text" name="invcnbr" id="invcnbr" readonly="readonly"/>
                    </div>
                     <div id="salesp" class="box">Sales Person: <input type="text" name="slsperid" id="slsperid" readonly="readonly"/>
                         </div>
                      <div><button id="unlockedt" type="button" onClick="CreateInvoice.unlockEdt();">Unlock</button></div>
                            <div style="clear: both;"></div>
                </div>

            <div id="middlehead">
                <div id="bill"class="box">Bill to:<br> <span id="billto" readonly="readonly"></span>
                </div>
                <div id="shipt"class="box">Ship to:<br> <span id="shipto" readonly="readonly"></span>
                </div>
                    <div style="clear: both;"></div>
            </div>

            <div id="bottomhead">
                <div id="termsstyle"class="box" >Terms: <input type="text" name="terms" id="terms" readonly="readonly"/>
                </div>
                <div id="fobstyle" class="box">FOB: <input type="text" name="fob" id="fob"/>
                </div>
                <div id="shipd"class="box">Ship Date: <input type="text" name="shipdate" id="shipdate" readonly="readonly"/>
                </div>
                <div id="deltckt" class="box">Delivery Tkt#: <input type="text" name="deltcktnum" id="deltcktnum" value="<?php echo $this->_tpl_vars['deltcktnum']; ?>
" readonly="readonly"/>
                </div>
                    <div style="clear: both;"></div>
            </div>
            <div id="bottomheadb">
                                <div id="shipv" class="box">
                    <label for="shipvia">Shipped Via: </label>
                    <select id="shipvia" name="shipvia" value="<?php echo $this->_tpl_vars['shipvia']; ?>
" onchange="javascript:CreateInvoice.shipviaChg();">
                        <option value="O-TRUCK">O-TRUCK</option>
                        <option value="CUST-PU">CUST-PU</option>
                        <option value="RAILCAR">RAILCAR</option>
                        <option value="INVOICE ONLY">INVOICE ONLY</option>
                    </select>
                </div>    
                <div id="carr" class="box">Carrier: <input type="text" name="carrier" id="carrier"/>
                </div>
                <div id="corder" class="box">Cust. Order#: <input type="text" name="custordnbr" id="custordnbr" readonly="readonly"/>
                </div>
                <div id="hdr" >
                        <div class="hdrradio"><input class="hdrInput" type="radio" name="colltype" id="prepaid" value="prepaid">Prepaid</div>
                        <div class="hdrradio"><input class="hdrInput" type="radio" name="colltype" id="collect" value="collect">Collect</div>
                        <div class="hdrradio"><input class="hdrInput" type="radio" name="colltype" id="other" value="Other">Other</div>
                </div>
                    <div style="clear: both;"></div>
            </div>

            <div id="middle">
                <div id="site"class="box" >Site/Order<input type="text" name="sitetype" id="sitetype" readonly="readonly"/>
                </div>
                <div id="ordern" class="box">Order#: <input type="text" name="ordnbr" id="ordnbr" value="<?php echo $this->_tpl_vars['ordnbr']; ?>
" readonly="readonly"/>
                </div>
                <div id="shipst"class="box">ShpStatus<input type="text" name="shipstatus" id="shipstatus" readonly="readonly"/>
                </div>
                <div id="ordert" class="box">Type: <input type="text" name="ordtype" id="ordtype" readonly="readonly"/>
                </div>   <div style="clear: both;"></div>
            </div>

            <div id="bottom">
                <div id='contdtl'>
                    <table id='datatable'></table>

                 </div>
                <div><button id="addcomment" type="button" onClick="commDlg.init();">Add Comment</button></div>
                <hr>

           <div id="footdataa">
               <div id="ddt"class="boxr" >Discount Date: <input type="text" name="discdate" id="discdate" readonly="readonly"/></div>
               <div id="damt"class="boxr" >Discount Amount: <input type="text" name="discountamt" id="discountamt" readonly="readonly"/></div>
               <div id="tsaltx"class="boxr" >Total Sales Tax: <input type="text" name="totslstax" id="totslstax" readonly="readonly"/></div>
               <div style="clear: both;"></div>
           </div>
           <div id="footdatab">     
               <div id="totextb"class="boxr" >Total ExtBF: <input type="text" name="totextbf" id="totextbf" readonly="readonly"/></div>
               <div id="totextf"class="boxr" >Total ExtFreight: <input type="text" name="totextfrt" id="totextfrt" readonly="readonly"/></div>
            <div style="clear: both;"></div>
           </div> 
                <hr>
                <div id="invtcontain"><div id="invt"class="boxr" >Invoice Total:<input type="text" name="invctot" id="invctot" readonly="readonly"/></div><div style="clear: both;"></div></div>
           </div>         

          

            <div id="cmtdlg" class="modal-dialog"></div>
            <script>
                var dtInfo = <?php echo $this->_tpl_vars['dtinfo']; ?>
;
                //CreateInvoice.buildTable();
                CreateInvoice.loadData();
            </script>

            <div id="lastfoot"><button id="saveinvoice" type="button" onClick="CreateInvoice.saveInvoice();">Save Invoice</button>
            </div>
       </div>
        </body>
</html>
