<?php /* Smarty version 2.6.13, created on 2012-07-05 10:46:57
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5Cfreightlogs%5Cviews%5CDeltickPrompt.html */ ?>
<form method=POST name=fmDeltickPrompt id=fmDeltickPrompt <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


      <TABLE style = "width: 100%">
        <TR>
            <TD style = "font-size: 24; width: 100%", align='center';><B><?php echo $this->_tpl_vars['form']['Title']['label']; ?>
</B></TD>
        </TR>
    </TABLE>
    <TABLE style = "width: 100%">
        <br>
        <TR>
            <TD style = "width: 1%;"></TD>
            <TD style = "width: 17%;"><B><?php echo $this->_tpl_vars['form']['deltick']['label']; ?>
</B></TD>
            <TD style = "width: 10%;"><?php echo $this->_tpl_vars['form']['deltick']['html']; ?>
</TD>
            <TD style = "width: 72%;"></TD>
        </TR>
    </TABLE>

    <TABLE style = "width: 100%">
        <TR>
        <hr>
        <TD style = "width: 1%;"></TD> 
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
        <TD style = "color: red; width: 89%;"><b><?php echo $this->_tpl_vars['form']['Msg']['html']; ?>
</b></TD>
        </TR>
    </TABLE>

</form>