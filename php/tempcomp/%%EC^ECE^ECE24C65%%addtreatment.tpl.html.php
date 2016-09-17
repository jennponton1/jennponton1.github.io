<?php /* Smarty version 2.6.13, created on 2011-09-16 08:17:15
         compiled from C:%5Cinetpub%5Cwwwroot%5CInventory%5Cdataentry%5Caddpartnumbers/views/addtreatment.tpl.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.

THIS IS A TEMPLATE FOR A SNIPPET OF CODE, NOT THE WHOLE PAGE!!
-->

<div>
    <div id="addtreatment_woodid">Adding a new treatment for <?php echo $this->_tpl_vars['woodid']; ?>
</div>
    <div id="addtreatment_newitem" >
        New item: <?php echo $this->_tpl_vars['wooddescr']; ?>

    </div>
    <div id="addtreatment_alreadyin" style="width: 20%; float:left;">
        <p>Items already in:</p>
        <?php $_from = $this->_tpl_vars['existingList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
        <?php echo $this->_tpl_vars['row']; ?>
<br>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div id="addtreatment_treatments" style="float:right;">
        <p>Available Treatments:</p>
        <table>
        <?php $_from = $this->_tpl_vars['availableList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
        <tr><td><?php echo $this->_tpl_vars['row']['id']; ?>
</td><td> <?php echo $this->_tpl_vars['row']['descr']; ?>
</td><td><a href="javascript: insertNewTreatedPartNumber('<?php echo $this->_tpl_vars['row']['id']; ?>
','<?php echo $this->_tpl_vars['woodid']; ?>
');">Add</a></td></tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>

</div>