<?php /* Smarty version 2.6.13, created on 2011-08-29 11:23:29
         compiled from C:%5Cinetpub%5Cwwwroot%5Crsk%5Cfinrpts%5CBuilders/views/AccountingPer.html */ ?>
<form method=POST name=fmAccountingPer id=fmAccountingPer <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>

    <table style="width: 100%">
        <tr>
            <td style="font-size: 24; width: 100%", align='center';><B><?php echo $this->_tpl_vars['form']['Title']['label']; ?>
</B></td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td style="width: 1%;"></td>
            <td style="width: 17%;"><b><?php echo $this->_tpl_vars['form']['period']['label']; ?>
</b></td>
            <td style="width: 10%;"><?php echo $this->_tpl_vars['form']['period']['html']; ?>
</td>
            <td style="width:72%;"></td>
        </tr>
    </table>
    <table style ="width: 100%">
        <tr>
            <hr>
            <td style="width: 1%;"></td>
            <td style="width: 5%;"><?php echo $this->_tpl_vars['form']['submit']['html']; ?>
</td>
            <td style="width: 5%;"></td>
        </tr>
    </table>
</form>