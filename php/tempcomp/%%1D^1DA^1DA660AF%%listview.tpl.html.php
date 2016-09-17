<?php /* Smarty version 2.6.13, created on 2013-09-24 09:16:22
         compiled from C:%5Cinetpub%5Cwwwroot%5CExportTools%5CProformaUtils/views/listview.tpl.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/ajax/jquery/jquery.js"></script>
        <script src="/ajax/jquery/jquery.datatables.js"></script>
        <?php echo '
        <script>
            
            function deletePFI(pfinbr) {
                var data = {};
                data[\'do\'] = \'deletepfi\';
                data.pfinvcnbr = pfinbr;
                $.ajax( {
                    dataType: "json",
                    data: data,
                    uri: "?",
                    type: "POST",
                    success: function(retData) {
                        if (retData.response == "SUCCESS") {
                            alert("Success!: "+retData.message);
                        }
                        else {
                            alert("FAILED!!: "+retData.message);
                        }
                    }
                }
            )
                
            }
            
            
            $(document).ready(function() {
                $("#pflist").dataTable( {
                    "aaSorting" : [ [ 0,\'asc\'] ],
                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "iDisplayLength": 25
                    
                   
                }); 
                //$("table tr").live("click",function(e) {
                $("table").delegate("tr","click",function(e) {
                    if (e.target.tagName != "TH") {
                        var ndx = e.target.cellIndex;
                        var ordnbr = $(e.currentTarget.cells[0]).text();
                        var req = {};
                        req.pfinvcnbr = ordnbr
                        req[\'do\'] = \'getdetails\'
                        $.ajax( {
                            data : req,
                            dataType: "json",
                            type: "POST",
                            uri: "?",
                            success: function(retData) {
                                var ans = confirm(" Delete PF# "+ordnbr+" with details:\\n"+retData);
                                if (ans) {
                                    deletePFI(ordnbr);
                                }
                            }
                   
                        });
                    }
                    //                 alert(" index is "+ndx+" and invcnbr is "+ordnbr);
                    //                 var ans = confirm("Are you sure you want to delete "+ordnbr+"?");
                 
                })
            });
            
        </script>
        <style>
            /* Pagination nested */
            .paginate_disabled_previous, .paginate_enabled_previous, .paginate_disabled_next, .paginate_enabled_next {
                height: 19px;
                width: 19px;
                margin-left: 3px;
                float: left;
                xdisplay: inline-block;
            }

            .paginate_enabled_next {
                background-image: url(\'/ajax/jquery/images/forward_enabled.jpg\');

            }
            .paginate_enabled_previous {
                background-image: url(\'/ajax/jquery/images/back_enabled.jpg\');

            }
            .paginate_disabled_next {
                background-image: url(\'/ajax/jquery/images/forward_disabled.jpg\');

            }
            .paginate_disabled_previous {
                background-image: url(\'/ajax/jquery/images/back_disabled.jpg\');

            }

        </style>
        '; ?>


    </head>
    <body>
        <div>
            <h3>Proforma List</h3>
            <table id="pflist">
                <thead>
                    <tr>
                        <th>PFI #</th>
                        <th>Date</th>
                        <th>Cust</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['item']['pfinvcnbr']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['pfinvcdate']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['item']['custid']; ?>
</td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>

            </table>
        </div>
    </body>
</html>