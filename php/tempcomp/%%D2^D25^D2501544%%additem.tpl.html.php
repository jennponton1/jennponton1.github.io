<?php /* Smarty version 2.6.13, created on 2011-08-10 15:29:51
         compiled from C:%5Cinetpub%5Cwwwroot%5Crsk%5Caddpartnumbers/views/additem.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create new Woodid/Item</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="/Ajax/JQueryUI/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <script src="/ajax/jquery/jquery.js" ></script>
        <script src="/ajax/jquery/jquery-ui.js" ></script>        
        <script src="views/additem.js"></script>
        <style>
            <?php echo '
            .help-div { display:none;
                        position:absolute;}
            '; ?>

        </style>

    </head>
    <body><div style="width:50%;">
            <form action="?">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Wood Type</td>
                            <td><select name="woodtype" id="woodtype">
                                    <option value="A" Selected>Lumber</option>
                                    <option value="B">Plywood</option>
                                    <option value="C">Shakes</option>
                                    <option value="-">Other</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Select Species</td>
                            <td><select name="species" id="species" >
                                </select></td>
                            <td>Select Grade</td>
                            <td><select name="grade" id="grade">
                                </select></td>
                        </tr>
                        <tr>
                            <td>Select Prefix (FSC, etc)</td>
                            <td><select name="prefix" id="prefix"></select></td>
                        </tr>
                        <tr>
                            <td>Enter Dressing/Description</td>
                            <td colspan="3"><input type="text" name="wooddesc" size="70px" id="wooddesc" value="" />&nbsp; <span id="dressing_help" class="help_span" style="padding: 2px; border: thin solid black; background: lightblue;" >?</span></td>

                        </tr>
                        <tr>
                            <td>Select Dressing/Description</td>
                            <td><select name="wooddetail" id="wooddetail">
                                    <option>Please Select a species</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Width</th>
                                            <th>Thickness</th>
                                            <th>Length</th>
                                            <th>Bndl Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nominal/Billed</td>
                                            <td><input type="text" name="nomd1" id="nomd1" value="" /></td>
                                            <td><input type="text" name="nomd2" id="nomd2" value="" /></td>
                                            <td><input type="text" name="nomd3" id="nomd3" value="" /></td>
                                            <td><input type="text" name="bndlsz" id="bndlsz" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td>Actual</td>
                                            <td><input type="text" name="actd1" id="actd1" value="" /></td>
                                            <td><input type="text" name="actd2" id="actd2" value="" /></td>
                                            <td><input type="text" name="actd3" id="actd3" value="" /></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="button" value="Get List" onclick="javascript: getList();" /></td>
                            <td><!-- input type="button" value="Clear" onclick="javascript: clearForms();"/ --></td>
                            <td><input type="button" value="Guess Part #" onclick="javascript: guessPart();" /></td>
                        </tr>
                    </tbody>
                </table>

            </form>
        </div>
        <div style="float: right; width: 50%; height: 400px; overflow: scroll;">
            <div  style="text-align: left;" id="newnbr" >
            </div>
        </div>

        <div  id="result"  style="height: 400px; overflow: scroll;">
            A guess of existing items will show down here
        </div>
        
        <div id="addtreatment_dialog"></div>
        
        <div class="help-div" id="dressing_help-div">This input is intended for dressings or descriptions OTHER than
        Wood Type, Species, Grade or FSC or other prefix</div>

    </body>
</html>