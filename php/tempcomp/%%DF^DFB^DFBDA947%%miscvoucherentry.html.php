<?php /* Smarty version 2.6.13, created on 2015-02-02 11:54:24
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cvoucherentry/views/miscvoucherentry.html */ ?>
<html>
    <head>
        <title>Misc Voucher Entry</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="views/main.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery.datatables.css">
        <link rel="stylesheet" type="text/css" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <br>
        <input type="hidden" name="siteid" id="siteid" value="<?php echo $this->_tpl_vars['siteid']; ?>
">
        <div style="border: thin solid black;">
            <table>
<!--                <td>Transaction Type:</td>
                <td><select name="trantype" id="trantype">
                        <option value="VO">VO</option>
                        <option value="AD">AD</option>
                    </select>
                </td>
                <td>-->
                    <label class="dtl_lbl" for="trantype">Transaction Type:&nbsp;</label>
                    <input class="dtl_inp" type="text" id="trantype" readonly="readonly" value="<?php echo $this->_tpl_vars['trantype']; ?>
"/>
                </td>
            </table>
            <br>
            <label class="dtl_lbl" for="invtotal">Invoice Total:&nbsp;</label>
            <input class="dtl_inp" type="text" id="invtotal" value="<?php echo $this->_tpl_vars['invtotal']; ?>
"/>
            <br>
            <label class="dtl_lbl" for="vendid">Vendor:&nbsp;</label>
            <input class="dtl_inp" type="text" id="vendid" value="<?php echo $this->_tpl_vars['vendid']; ?>
" onblur="javascript:vendValid();">
            <button id="vendorlup" type="button">Vendor Search</button>
            <input class="dtl_inp2" type="text" name="vendname" id="vendname" readonly="readonly" value="<?php echo $this->_tpl_vars['vendname']; ?>
"/>
            <label class="dtl_lbl" for="terms">Terms:&nbsp;</label>
            <input class="dtl_inp" type="text" id="terms" value="<?php echo $this->_tpl_vars['terms']; ?>
"/>
            <br>
            <label class="dtl_lbl" for="invnbr">Invoice Number:&nbsp;</label>
            <input class="dtl_inp" type="text" id="invnbr" value="<?php echo $this->_tpl_vars['invnbr']; ?>
" onblur="javascript:voEntry.checkInvcnbr();"/>
            <label class="dtl_lbl" for="invdate">Invoice Date:&nbsp;</label>
            <input class="dtl_inp" type="text" id="invdate" value="<?php echo $this->_tpl_vars['invdate']; ?>
" onChange="javascript:formatInvDate()"/>
            <label class="dtl_lbl" for="paydate">Pay Date:&nbsp;</label>
            <input class="dtl_inp" type="text" id="paydate" value="<?php echo $this->_tpl_vars['paydate']; ?>
" onChange="javascript:formatPayDate()"/>
            <label class="dtl_lbl" for="discamount">Disc Amount:&nbsp;</label>
            <input class="dtl_inp" type="text" id="discamount" value="<?php echo $this->_tpl_vars['discamount']; ?>
"/>
            <br>
            <br>
        </div>
        <br>
        <div style="border: thin solid black;">
            <br>
            <label class="dtl_lbl" for="acct">Account:&nbsp;</label>
            <input class="dtl_inp" type="text" id="acct" value="<?php echo $this->_tpl_vars['acct']; ?>
"/>
            <label class="dtl_lbl" for="sub">Sub:&nbsp;</label>
            <input class="dtl_inp" type="text" id="sub" value="<?php echo $this->_tpl_vars['sub']; ?>
" onblur="javascript:formatSubacct()"/>
            <label class="dtl_lbl" for="desc">Tran Desc:&nbsp;</label>
            <input class="dtl_inp3" type="text" id="desc" value="<?php echo $this->_tpl_vars['desc']; ?>
"/>
            <label class="dtl_lbl" for="rectckt">Receiving Ticket:&nbsp;</label>
            <input class="dtl_inp" type="text" id="rectckt" value="<?php echo $this->_tpl_vars['rectckt']; ?>
"/>
            <br>
            <label class="dtl_lbl" for="unit">Unit:&nbsp;</label>
            <input class="dtl_inp" type="text" id="unit" value="<?php echo $this->_tpl_vars['unit']; ?>
"/>
            <label class="dtl_lbl" for="qty">Qty:&nbsp;</label>
            <input class="dtl_inp" type="text" id="qty" value="<?php echo $this->_tpl_vars['qty']; ?>
"/>
            <label class="dtl_lbl" for="unitprc">Unit Price:&nbsp;</label>
            <input class="dtl_inp" type="text" id="unitprc" value="<?php echo $this->_tpl_vars['unitprc']; ?>
"/>
            <label class="dtl_lbl" for="amount">Amount:&nbsp;</label>
            <input class="dtl_inp" type="text" id="amount" value="<?php echo $this->_tpl_vars['amount']; ?>
"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="enter" type="button">Enter</button>
            <br>
            <br>
        </div>
        <br>
        <br>
        <div style="border: thin solid black;">
            <button id="savevo" type="button" onClick="javascript:verifyVoucher();">Save</button>
            <button id="cancel" type="button">Cancel</button>
        </div> 
        <br>
        <label class="dtl_lbl" for="total">Total:&nbsp;</label>
        <input class="dtl_inp" type="text" id="totalcost" readonly="readonly" value="<?php echo $this->_tpl_vars['totalcost']; ?>
"/>
    </body>
    <div id="input-dialog" class="modal-dialog">
        <div id="dialog-detail"></div>
    </div>
    <div id="dialog" class="modal-dialog">
    </div>
</html>