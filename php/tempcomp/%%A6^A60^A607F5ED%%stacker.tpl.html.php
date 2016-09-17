<?php /* Smarty version 2.6.13, created on 2014-01-10 15:09:56
         compiled from C:%5Cinetpub%5Cwwwroot%5Cstackermovement/public/views/stacker.tpl.html */ ?>
<!doctype html>
<html>
    <head>
        <title>Stacker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="/globals/css/jquery/jquery-ui.css">
        <link rel="stylesheet" href="/globals/css/jquery/jquery.datatables.css">
        <link rel="stylesheet" href="public/css/stacker.css">
        <script src="/globals/js/jquery/jquery.js"></script>
        <script src="/globals/js/jquery/jquery-ui.js"></script>
        <script src="/globals/js/jquery/jquery.datatables.js"></script>
        <script src="public/js/DndGrids.js"></script>
        <script src="public/js/stacker.js"></script>
        <script src="public/js/dialog.js"></script>
        <script src="public/js/nestedGrid.js"></script>
        <script src="public/js/stamp.js"></script>
        <script src="public/js/downtime.js"></script>
        <script src="public/js/genNotes.js"></script>
        <script src="public/js/Messages.js"></script>
    </head>
    <body>
        <div id="upDown">
        <div class="downArrow"></div>
        </div>
        <div id="headerContent">
            <div id="showHide" class="upArrow"></div>
            <nav class="titlebar">
                <ul>
                    <li>Operator Info</li>
                    <li>Down Time</li>
                    <li>Stamp</li>
                    <li>Notes</li>
                </ul>
            </nav>
            <nav>
                <ul>
                    <li>
                        <div id="op-info">
                            <label for="date">Date: </label>
                            <input id="date" type="text"><br/>
                            <label for="time">Time: </label>
                            <input id="time" type="text"><br/>
                            <label for="op">Operator: </label>
                            <input id="op" type="text" value="<?php echo $this->_tpl_vars['username']; ?>
"><br/>
                            <label for="shift">Shift: </label>
                            <input id="shift" type="text">
                        </div>
                    </li>
                    <li>
                        <div id="downTime">
                            <table class="pretty">
                                <tbody></tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div id="stamp">
                            <table class="pretty">
                                <tbody></tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div id="notes">
                            <div id="genNotes"></div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>


        <div id="grids">
            <div class="messagebox" id="messageBox" hidden="hidden" ></div>
            <div class="tblwrapper" id="tblwrap1">
                <div class="menu">
                    <label>Stacker <?php echo $this->_tpl_vars['stkId']; ?>
</label>
                    <input type="button" value="Refresh" class="button" id="btn-refresh">
                </div>

                <table id="grid1" class="pretty">
                    <tbody></tbody>
                </table>
            </div>
            <div class="tblwrapper" id="tblwrap2">
                <div class="menu">
                    <label>Unposted</label>
                    <input type="button" value="Post Batch" class="button" id="btn-post">
                </div>

                <table id="grid2" class="pretty">
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div id="dialog"></div>
        <input type="hidden" id="stkId" value="<?php echo $this->_tpl_vars['stkId']; ?>
">
    </body>
</html>