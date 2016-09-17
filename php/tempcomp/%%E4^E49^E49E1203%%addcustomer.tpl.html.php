<?php /* Smarty version 2.6.13, created on 2011-01-12 15:04:37
         compiled from C:%5Cinetpub%5Cwwwroot%5CMSA/views/addcustomer.tpl.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
      <form method="post" action="">
          <input type="hidden" name="do" value="editCust">
          <input type="hidden" name="subdo" value="<?php echo $this->_tpl_vars['action']; ?>
Cust">
      <table>
          <tr></tr>
          <tr>
              <td>Select your customer</td>
              <td><select name="custid">
                      <?php $_from = $this->_tpl_vars['custs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cust']):
?>
                      <option value="<?php echo $this->_tpl_vars['cust']->custid; ?>
"><?php echo $this->_tpl_vars['cust']->lastname; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                  </select>
              </td>
          </tr>
          <tr>
              <td>Select your Area</td>
              <td><select name="area">
                      <?php $_from = $this->_tpl_vars['areas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['area']):
?>
                      <option value="<?php echo $this->_tpl_vars['area']->areaname; ?>
"><?php echo $this->_tpl_vars['area']->areaname; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                  </select>
              </td>
          </tr>
          <tr>
              <td><input type="submit" name="Save" value="Save">
          </tr>
      </table>
      </form>
  </body>
</html>