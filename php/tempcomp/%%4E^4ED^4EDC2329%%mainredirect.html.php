<?php /* Smarty version 2.6.13, created on 2014-10-07 11:44:01
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes/views/mainredirect.html */ ?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form id="redir" method="POST" action="<?php echo $this->_tpl_vars['script']; ?>
">
            <?php echo $this->_tpl_vars['vars']; ?>

            <div>Redirecting.. please wait</div>
        </form>
    <script>
        var theForm = document.getElementById('redir');
        theForm.submit();
    </script>
    </body>
</html>