<?php /* Smarty version 2.6.13, created on 2013-04-23 16:53:40
         compiled from C:%5Cinetpub%5Cwwwroot%5Cdetstatus/views/podetails.tpl.html */ ?>
<!-- <?php echo ' -->
<style>
    #itemtable, #itemtable td, #itemtable th {
        padding: 2px;
        border: thin solid black;
    }
    #commentstable, #commentstable td, #commentstable th {
        padding: 2px;
        border: thin solid black;
    }
</style>
<!-- '; ?>
 -->
<div>
    <div id="pohdr">
        PO# <?php echo $this->_tpl_vars['poInfo']->ponbr; ?>
   Vendor <?php echo $this->_tpl_vars['poInfo']->vendid; ?>
 <?php echo $this->_tpl_vars['poInfo']->vendlastname; ?>
<br>
        Order Date: <?php echo $this->_tpl_vars['poInfo']->podate; ?>
<br>
        Original Ship Date: <?php echo $this->_tpl_vars['poInfo']->origshipdt; ?>
<br>
        Revised ShipDate: <?php echo $this->_tpl_vars['poInfo']->modshipdt; ?>
<br>
        <br>
        Items:<br>
        <table id='itemtable'>
            <tr>
                <th>Item</th>
                <th>Units</th>
                <th>Ordered</th>
                <th>Received</th>
                <th>Assignment</th>
            </tr>
            <?php $_from = $this->_tpl_vars['poInfo']->detail; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['itemRow']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['itemRow']->invtid; ?>
</td>
                <td><?php echo $this->_tpl_vars['itemRow']->purchunit; ?>
</td>
                <td style='text-align: right;'><?php echo $this->_tpl_vars['itemRow']->qtyord; ?>
</td>
                <td style='text-align: right;'><?php echo $this->_tpl_vars['itemRow']->qtyrcvd; ?>
</td>
                <td><?php echo $this->_tpl_vars['itemRow']->assignmt; ?>
</td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
        <br>
        Comments:<br>
                <table id="commentstable">
                    <tr>
                        <th>#</th>
                        <th>Cmt Date</th>
                        <th>Orig. Ship</th>
                        <th>Rev. Ship</th>
                        <th>Comment</th>
                    </tr>
                    <?php $_from = $this->_tpl_vars['poInfo']->commentlist; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['comment']->cmtnbr; ?>
</td>
                            <td><?php echo $this->_tpl_vars['comment']->commentdt; ?>
</td>
                            <td><?php echo $this->_tpl_vars['comment']->origshipdt; ?>
</td>
                            <td><?php echo $this->_tpl_vars['comment']->modshipdt; ?>
</td>
                            <td><?php echo $this->_tpl_vars['comment']->comment; ?>
</td>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </table>
    </div>
</div>