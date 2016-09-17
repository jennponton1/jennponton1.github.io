<?php /* Smarty version 2.6.13, created on 2014-01-10 15:08:53
         compiled from C:%5Cinetpub%5Cwwwroot%5Cstackermovement/public/views/stackerSelect.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Stacker Select</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" href="/globals/css/jquery/jquery.datatables.css">
        <link rel="stylesheet" href="public/css/stackerSelect.css">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="public/js/stackerSelect.js"></script>
    </head>
    <body>
        <div id="headerContent">
            <div id="stackers">
                <h2>Stacker Select</h2>
                <input type="button"  id="schedule" class="button" value="Print Daily Schedule">
                <br/>
                <button id="stack1" class="button"> Stacker 1</button>
                <button id="stack2" class="button">Stacker 2</button>
                <button id="stack3" class="button">Stacker 3</button>
                <button id="stack4" class="button">Stacker 4</button>
                <button id="stack5" class="button">Hand Stack</button>
            </div>
        </div>

        <form method="POST" action="Stacker.php">
            <input id="selectedStk" type="hidden" name="stkId">
            <input id="stkName" type="hidden" name="stkName">
        </form>
    </body>
</html>