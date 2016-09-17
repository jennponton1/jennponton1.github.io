<?php /* Smarty version 2.6.13, created on 2011-01-12 15:02:24
         compiled from C:%5Cinetpub%5Cwwwroot%5CMSA/views/areas.tpl.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>MSA Maintenance - Areas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script>
        <?php echo '
        function runAction(action,id) {
            ret = true;
            if (action == "deletearea") {
                ret = confirm("Area you sure you want to delete this area?");
            }
            if (!action == "deletearea" || ret ) {
                document.getElementById(\'do\').value=action;
                document.getElementById(\'areaid\').value=id;
                document.getElementById(\'runaction\').submit();
            }
        }
        '; ?>

    </script>
  </head>
  <body>
      <form method="post" id="runaction" action="">
          <input type="hidden" name="do" id="do">
          <input type="hidden" name="areaid" id="areaid">
      </form>
          <div>
          <a href="#" onclick="javascript:runAction('addarea','');">Add New Area</a><br>
          <table>
              <tr><th>Area</th></tr>
              <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
              <tr>
                  <td><?php echo $this->_tpl_vars['row']->areaname; ?>
</td>
<!--                  <td><a href="#" onclick="javascript:runAction('editarea',<?php echo $this->_tpl_vars['row']->id; ?>
);">Edit</a></td>   -->
                  <td><a href="#" onclick="javascript:runAction('deletearea',<?php echo $this->_tpl_vars['row']->id; ?>
);">Delete</a></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?>
          </table>
      </div>
  </body>
</html>