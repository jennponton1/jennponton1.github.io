<?php /* Smarty version 2.6.13, created on 2014-01-10 15:09:02
         compiled from C:%5Cinetpub%5Cwwwroot%5Cstackermovement/public/views/scheduler.tpl.html */ ?>
<!doctype html>
<html>
    <head>
        <title>Scheduler</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" href="/globals/css/jquery/jquery.datatables.css">
        <link rel="stylesheet" href="public/css/scheduler.css">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="public/js/DndGrids.js"></script>
        <script src="public/js/scheduler.js"></script>
        <script src="public/js/dialog.js"></script>
        <script src="public/js/nestedGrid.js"></script>
        <script src="public/js/Messages.js"></script>
    </head>
    <body>
        <div id="headerContent" >
            <nav>
                <ul>
                    <li class="stk1" id="stk1"><img src="public/images/bundle.jpg" alt="Stacker 1"><br/><label>Stacker 1</label></li>
                    <li class="stk2" id="stk2"><img src="public/images/bundle.jpg" alt="Stacker 2"><br/><label>Stacker 2</label></li>
                    <li class="stk3" id="stk3"><img src="public/images/bundle.jpg" alt="Stacker 3"><br/><label>Stacker 3</label></li>
                    <li class="stk4" id="stk4"><img src="public/images/bundle.jpg" alt="Stacker 4"><br/><label>Stacker 4</label></li>
                    <li class="handStk" id="stk5"><img src="public/images/bundle.jpg" alt="Hand Stack"><br/><label>Hand Stack</label></li>
                    <li class="handStk" id="ndat"><img src="public/images/bundle.jpg" alt="NDAT"><br/><label>NDAT</label></li>
                </ul>
            </nav>
        </div>

        <div id="grids">
            <div id="message"></div>
            <div class="messagebox" id="messageBox" hidden="hidden" ></div>
            <div class="tblwrapper" id="tblwrap1">
                <div class="menu">
                    <label>Inventory</label>
                </div>
                <table id="grid1">
                    <tbody></tbody>
                </table>
            </div>
            <div class="tblwrapper" id="tblwrap2">
                <div class="menu">
                    <label>Stackers</label>
                    <div id="stkSelect">
                        <select id="stk">
                            <option value="Stacker" selected="selected">Stacker</option>
                            <option value="1">STK1</option>
                            <option value="2">STK2</option>
                            <option value="3">STK3</option>
                            <option value="4">STK4</option>
                            <option value="5">HANDSTK</option>
                        </select>
                    </div>
                    <input type="button" value="+" class="button" id="btn-ec">
                    <input type="button" value="General Note" class="button" id="btn-genNote">
                </div>
                <table id="grid2">
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <br/>
        <div id="dialog"></div>
        <input id="siteId" value="<?php echo $this->_tpl_vars['siteId']; ?>
" type="hidden">
    </body>
</html>