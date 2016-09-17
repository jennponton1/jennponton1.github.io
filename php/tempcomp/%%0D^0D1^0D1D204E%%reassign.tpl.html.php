<?php /* Smarty version 2.6.13, created on 2014-01-10 15:09:11
         compiled from C:%5Cinetpub%5Cwwwroot%5Cstackermovement/public/views/reassign.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reassignment Screen</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="public/css/reassign.css">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="public/js/DndGrids.js"></script>
        <script src="public/js/reassign.js"></script>
    </head>
    <body>
        <div id="headerContent">
            <h2>Stacker Reassignment</h2>
            <form>
                <br />
                <label for="stkFrom" id="lblStkFrom">Select Stacker:
                    <select id="stkFrom">
                        <option value="From">From</option>
                        <option value="1">STK1</option>
                        <option value="2">STK2</option>
                        <option value="3">STK3</option>
                        <option value="4">STK4</option>
                        <option value="5">HANDSTK</option>
                    </select>
                </label>


                <label for="stkTo" id="lblStkTo"> To:
                    <select id="stkTo">
                        <option value="To">To</option>
                        <option value="1">STK1</option>
                        <option value="2">STK2</option>
                        <option value="3">STK3</option>
                        <option value="4">STK4</option>
                        <option value="5">HANDSTK</option>
                    </select>
                </label>


                <input type="button" value="Submit" id="submit" class="button">
            </form>
        </div>
            <div id="grids">
                <div class="tblwrapper" id="tblwrap1">
                    <table id="grid1">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="tblwrapper" id="tblwrap2">
                    <table id="grid2">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
    </body>
</html>