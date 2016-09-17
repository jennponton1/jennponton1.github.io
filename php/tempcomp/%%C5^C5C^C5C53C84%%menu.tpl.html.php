<?php /* Smarty version 2.6.13, created on 2011-01-12 15:01:06
         compiled from C:%5Cinetpub%5Cwwwroot%5CMSA/views/menu.tpl.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>MSA Maintenance Menu</title>
    <script>
    <?php echo '
    function runAction(action) {
        var formEl = document.getElementById(\'runform\');
        var runEl = document.getElementById(\'do\');
        runEl.value = action;
        formEl.submit();
    }
    '; ?>

    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
      <form action="" method="POST" id="runform">
          <input type="hidden" name="do" id="do" value="">
      </form>
      <ul>
          <li><a href="#" onclick="javascript:runAction('add');">Add Customer to MSA</a></li>
          <li><a href="#" onclick="javascript:runAction('edit');">Edit Customer's MSA</a></li>
          <li><a href="#" onclick="javascript:runAction('list');">List Customers and MSAs</a></li>
          <li><a href="#" onclick="javascript:runAction('delete');">Delete Customer from MSA</a></li>
          <li><a href="#" onclick="javascript:runAction('areas');">Edit MS Areas</a></li>
      </ul>
  </body>
</html>