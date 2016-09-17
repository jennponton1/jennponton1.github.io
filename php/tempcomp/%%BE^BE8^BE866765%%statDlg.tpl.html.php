<?php /* Smarty version 2.6.13, created on 2013-07-15 14:28:48
         compiled from C:%5Cinetpub%5Cwwwroot%5Cdetstatus/views/statDlg.tpl.html */ ?>
<script type="text/javascript" src="public/js/detStatSheetDlg.js?vdt=1513"></script>
<!-- <?php echo ' -->
<style>
</style>
<!-- '; ?>
 -->
<div class="border">
<form class="fields">
        <fieldset class="row1">
            <legend>&nbsp;Order Information</legend>
            <label for="txtOrdNum">Ord #</label>
            <input type="text" name="txtOrdNum" disabled="disabled" id="txtOrdNum"  value="<?php echo $this->_tpl_vars['header'][0]['ordNbr']; ?>
"/>
            
            <label for="txtShipVia">Ship Via</label>
            <input type="text" name="txtShipVia" disabled="disabled" id="txtShipVia"  value="<?php echo $this->_tpl_vars['header'][0]['carrier']; ?>
"/>
                       
            <label for="txtCustOrdNum">Cust Ord #</label>
            <input type="text" name="txtCustOrdNum" disabled="disabled" id="txtCustOrdNum"  value="<?php echo $this->_tpl_vars['header'][0]['custOrdNbr']; ?>
"/>

            <label for="txtFOB">FOB</label>
            <input type="text" name="txtFOB" disabled="disabled" id="txtFOB" value="<?php echo $this->_tpl_vars['header']['fob']; ?>
"/>
            <br/>       
            <label for="txtOrdDate">Ord Date</label>
            <input type="text" name="txtOrdDate" disabled="disabled" id="txtOrdDate" value="<?php echo $this->_tpl_vars['header'][0]['ordDate']; ?>
"/>
            
            <label for="txtCustId">Customer ID</label>
            <input type="text" name="txtCustId" disabled="disabled" id="txtCustId" value="<?php echo $this->_tpl_vars['header']['custId']; ?>
"/>
                       
            <label for="rcvdDt">All Rcvd</label>
            <input type="text" name="rcvdDt" id="rcvdDt" class="stat-datepicker" tabindex="-1" value="<?php echo $this->_tpl_vars['header'][0]['dtAllRcd']; ?>
" readonly='readonly'/>  
            
            <label for="rdyDt">All Rdy</label>
            <input type="text" name="rdyDt" id="rdyDt" class="stat-datepicker" tabindex="-1" value="<?php echo $this->_tpl_vars['header'][0]['dtRdy']; ?>
" readonly='readonly'/>                            
            <label for="txtTerms">Terms </label>
            <input type="text" name="txtTerms" id="txtTerms" disabled="disabled" value="<?php echo $this->_tpl_vars['header']['terms']; ?>
"/> 
            
            <label for="txtSalesPersId">Sls Pers Id</label>
            <input type="text" name="txtSalesPersId" disabled="disabled" id="txtSalesPersId" value="<?php echo $this->_tpl_vars['header'][0]['slsPerId']; ?>
"/>  
            
            <label for="txtNotes">Notes </label>
            <textarea name="txtNotes" id="txtNotes" tabindex="2"><?php echo $this->_tpl_vars['header'][0]['notes']; ?>
</textarea>       
        </fieldset>      
        <br/>
        <fieldset class="row3">
            <legend>&nbsp;Billing Information</legend>
            <label for="txtBillTo">Bill To </label>
            <textarea name="txtBillTo" disabled="disabled" id="txtBillTo"><?php echo $this->_tpl_vars['billing'][0]; ?>
</textarea>

            <label for="txtShipTo">Ship To</label>
            <textarea name="txtShipTo" disabled="disabled" id="txtShipTo"><?php echo $this->_tpl_vars['billing'][1]; ?>
</textarea>
            
            <label for="request">Shipping Notes</label>
                <?php echo '';  if ($this->_tpl_vars['ordNotes'][0] != null):  echo '<textarea name="request" disabled="disabled" id="request">';  $_from = $this->_tpl_vars['ordNotes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['note']):
 echo '';  if ($this->_tpl_vars['note'] != null):  echo '';  echo $this->_tpl_vars['note'];  echo '';  endif;  echo '';  endforeach; endif; unset($_from);  echo '</textarea>';  endif;  echo ''; ?>

        </fieldset>
    <input type="text" id="tso" hidden="hidden" value="<?php echo $this->_tpl_vars['header']['tso']; ?>
">
</form>
    <table id="buttons">
        <tr>
            <td><button class="viewTrans">View Transactions for <?php echo $this->_tpl_vars['header'][0]['ordNbr']; ?>
</button>&nbsp;
                <button class="trkReq">Release Order</button>&nbsp;
                <button class="saveForm">  Save  </button>
                <button class="orderEdit" id="ordEditBtn" style="display: none;">Edit Order</button>
            </td>
            <td></td>
            <td><div id="trkReqMsg"></div></td>
        </tr>
    </table>
</div>
    <table id="statCont">
    <tr>
        <td> <div id="change"></div></td><td><div class="messagebox" id="messageBox"></div></td>
    </tr>
    </table> 
<div id="dlgWrapper">
     <table id="dlgGrid" class="display">
        <thead class="theading" >
            <tr>
                <th>Part #            </th>
                <th>PCS Order         </th>
                <th>PCS Ship          </th>
                <th>PCS Rem           </th>
                <th>BF Ordered   </th>
                <th>BF Ship      </th>
                <th>BF<br>Rem. </th>
                <th>Date All Rcvd</th>
                <th>Date<br>Due to Ship</th>
                <th>Status            </th>
                <th>Rank              </th>
                <th>PCS               </th>
                <th>Footage           </th>
            </tr>
        </thead>
        <tbody id="data2">
        </tbody>
    </table>
    <!-- <?php echo ' -->
    <script>
        $("#dlgGrid").delegate(\'.purchLink\', "click",function(event){
            DetStat.getPODetails($("#txtOrdNum").val(), $(event.target.parentNode.cells[0]).text());
        });
    </script>
    <!-- '; ?>
 -->
</div>