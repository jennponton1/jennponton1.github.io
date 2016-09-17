<?php /* Smarty version 2.6.13, created on 2013-03-26 16:11:20
         compiled from C:%5Cinetpub%5Cwwwroot%5Cutils%5Cwebsitepruning/views/main.tpl.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Pruning App</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/globals/js/jquery/jquery.js"></script>
        <!-- <?php echo ' -->
        <style>
            #content {
                width: 100%;
                border: thin solid black;
                min-height: 200px;
            }
        </style>
        <!-- '; ?>
 -->
    </head>
    <body>
        <div>Pruning App</div>
        <div id="content">Loading...</div>
        <!-- <?php echo ' -->
        <script>
            $("#content").load("?do=getfiles");
        </script>
        <!-- '; ?>
 -->
    </body>
</html>