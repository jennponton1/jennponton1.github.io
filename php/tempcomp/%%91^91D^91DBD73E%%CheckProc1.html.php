<?php /* Smarty version 2.6.13, created on 2013-09-06 12:31:19
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Creports%5Ccheckprinting%5Cviews%5CCheckProc1.html */ ?>
<script src='/Ajax/Jquery/jquery.js'></script>
<script> <?php echo '
    function doToggle(vendid) {
        //alert(vendid);
        var vclassName= vendid+\'chkbox\';
        var elColl = $("."+vclassName);
        for (item in elColl) {
            var curVal = elColl[item].checked == true;
            if (curVal == true) {
                elColl[item].checked = false;
            }
            else {
                elColl[item].checked = true;
            }
            
        }
    }
    function show_prompt(refnbr,vendid) {
        var reference = refnbr;
        var vendor = vendid;
        var discount=prompt("Enter Discount for reference number " + reference + " for vendor " + vendor,"0.00");
        if (discount!=null && discount!="")
        {
            //alert("You entered a discount of " + discount + " for reference number " + reference + " for vendor " + vendid);
            document.getElementById(\'do\').value=\'payexcept\';
            document.getElementById(\'exceptamt\').value=discount;
            document.getElementById(\'exceptref\').value=reference;
            document.getElementById(\'exceptvend\').value=vendor;

            var formEl = document.getElementById(\'fmCheckProc1\');
            
            formEl.submit();
        }
    }
    '; ?>

</script>
<form method=POST name='fmCheckProc1' id='fmCheckProc1' <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

      <input type="hidden" id="exceptamt" name="exceptamt" value="">
      <input type="hidden" id="exceptref" name="exceptref" value="">
      <input type="hidden" id="exceptvend" name="exceptvend" value="">
      <TABLE style = "width: 100%">
        <TR>
            <TD></TD>
            <TD><?php echo $this->_tpl_vars['form']['htTable']['label']; ?>
</TD>
            <TD></TD>
        </TR>
    </TABLE>
    <TABLE style = "width: 100%">
        <TR>
        <hr>
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['restart']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['recalc']['html']; ?>
</TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['unselect']['html']; ?>
</TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['select']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
        <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['runchecks']['html']; ?>
</TD>
        <TD style = "color: red; width: 50%;"><b><?php echo $this->_tpl_vars['form']['MSG']['html']; ?>
</b></TD>
        </TR>
    </TABLE>
</form>