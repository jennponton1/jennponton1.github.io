<?php /* Smarty version 2.6.13, created on 2014-04-24 09:50:06
         compiled from C:%5Cinetpub%5Cwwwroot%5Caccountspayable%5Cdataentry%5CVendor%5Cviews%5CVendorEdit.html */ ?>
<form method=POST name=fmVendorEdit id=fmVendorEdit <?php echo $this->_tpl_vars['form']['attributes']; ?>
><?php echo $this->_tpl_vars['form']['hidden']; ?>


      <div><center><h2><?php echo $this->_tpl_vars['form']['Title']['label']; ?>
</h2></center></div>     
    <br> 
    <div style="float: left; width: 600px">
         <table>
             <colgroup>
                 <col style="width: 200px;"/>
                 <col style="width: 200px;"/>
                 <col style="width: 200px;"/>
                 <col style="width: 10px;"/>   
             </colgroup>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['vendid']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['vendid']['html']; ?>
</td>
                 <td></td>
                 <td></td>                
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['lastname']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['lastname']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['status']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['status']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['apacct']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['apacct']['html']; ?>
</td>
                 <td><?php echo $this->_tpl_vars['form']['apsub']['html']; ?>
</td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['dftacct']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['dftacct']['html']; ?>
</td>
                 <td><?php echo $this->_tpl_vars['form']['dftsub']['html']; ?>
</td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['terms']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['terms']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['paydatedft']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['paydatedft']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['lastchkdt']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['lastchkdt']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['lastvodt']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['lastvodt']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['vend1099']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['vend1099']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['TIN']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['TIN']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['dfltbox']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['dfltbox']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['vendpaytype']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['vendpaytype']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['routingnbr']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['routingnbr']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['acctnbr']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['acctnbr']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['ouracctnbr']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['ouracctnbr']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['addendatype']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['addendatype']['html']; ?>
</td>
                 <td></td>
                 <td></td>
             </tr>
        </table>
    </div>
    
    <div style="left: 40px;" id="addrdiv">
        <table>
            <colgroup>
                 <col style="width: 125px;"/>
                 <col style="width: 300px;"/>   
             </colgroup>
            <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['addrid']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['addrid']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['attn']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['attn']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['salut']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['salut']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['addr1']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['addr1']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['addr2']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['addr2']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['city']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['city']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['state']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['state']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['zip']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['zip']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['phone']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['phone']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['telex']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['telex']['html']; ?>
</td>
             </tr>
             <tr>
                 <td><b><?php echo $this->_tpl_vars['form']['fax']['label']; ?>
</b></td>
                 <td><?php echo $this->_tpl_vars['form']['fax']['html']; ?>
</td>
             </tr>
             <tr>
                 <td></td>
                 <td></td>
             </tr>
             <tr>
                 <td></td>
                 <td></td>
             </tr>
        </table>
    </div>
    <br></br>
<TABLE style = "width: 100%">
        <TR>
        <hr>
        <TD style = "width: 1%;"></TD> 
        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['save']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>
<!--        <TD style = "width: 5%;"><?php echo $this->_tpl_vars['form']['cancel']['html']; ?>
</TD>
        <TD style = "width: 5%;"></TD>-->
        <TD style = "width: 5%;"><button id="close" type="button" onclick="javascript:window.close();">Close</button></TD>
        <TD style = "width: 84%;"></TD>
        </TR>
    </TABLE>

</form>