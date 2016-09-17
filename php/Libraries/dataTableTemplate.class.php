<?PHP

function checkNumeric($var) {
    // First remove all , AFTER the first character
    $tmp = substr($var, 0, 1);
    $tmp2 = substr($var, 1);
    $tmp2 = str_replace(",", "", $tmp2);
    $var = $tmp . $tmp2;
    //die("<br>".$var);
    return is_numeric($var);
}

// check_numeric

class TableTemplate {

    public $col_span = array();
    public $table_style = array();
    public $table_attribute = array();
    public $row_style = array();
    public $row_attribute = array();
    public $column_style = array();
    public $column_attribute = array();
    public $header_style = array();
    public $header_attribute = array();
    public $column_detail = array();
    public $header_width = 0;
    public $detail_width = 0;
    public $row_bgcolor = "#CCCCCC";

    public function setHeaderWidth($width) {
        $this->header_width = $width;
        $this->detail_width = $width + 15;
    }

    public function setColumns($col_array) {
        foreach ($col_array as $key => $value) {
            $this->col_span[$key] = $value;
        }
    }

    public function getStyle() {
        return "
				<STYLE>
                table tr.odd {
                    background-color: CCCCCC;
                }
                
                table {
                    font-family:arial;
                    
                    font-size:8pt;
                }   

                
                .dataTables_wrapper {
                    width: 90%;
                }
                
                .tbltmpcls {
                    border: thin solid black;
                    cellpadding: 0;
                    clear: both;
                }
                .tbltmpcls td, .tbltmpcls th {
                    cell-padding: 0;
                    border: thin solid black;
                }
                .nbrcol {
                    text-align: right;
                }

                .dataTables_wrapper {
                    width: 90%;
                }
                .dataTables_length {
                    width: 40%;
                    float: left;
                }

                .dataTables_filter {
                    width: 50%;
                    float: right;
                    text-align: right;
                }
                
                .dataTables_info {
                    float: left;
                    width: 40%;
                }


                .dataTables_paginate {
                    width: 44px;

                    float: right;
                    text-align: right;
                }

                /* Pagination nested */
                .paginate_disabled_previous, .paginate_enabled_previous,
                .paginate_disabled_next, .paginate_enabled_next {
                    height: 19px;
                    width: 19px;
                    margin-left: 3px;
                    float: left;
                    xdisplay: inline-block;
                }
                .paginate_disabled_previous,
                .paginate_enabled_previous,
                .paginate_disabled_next,
                .paginate_enabled_next {
                        height: 19px;
                        float: left;
                        cursor: pointer;
                        *cursor: hand;
                        color: #111 !important;
                }
                .paginate_enabled_next {
                    background-image: url('/globals/css/images/forward_enabled.jpg');

                }
                .paginate_enabled_previous {
                    background-image: url('/globals/css/images/back_enabled.jpg');

                }
                .paginate_disabled_next {
                    background-image: url('/globals/css/images/forward_disabled.jpg');

                }
                .paginate_disabled_previous {
                    background-image: url('/globals/css/images/back_disabled.jpg');

                }

                                           
				</STYLE>
                <script src='/globals/js/jquery/jquery.js'></script>
                <script src='/globals/js/jquery/jquery.dataTables.js'></script>                                
                ";
    }

    public function getDataTablesScript($aoCols, $height = '') {
        return "<script>
                           $(document).ready(function() {
                              $('#tbltmp".$GLOBALS['TBLTMPNBR']."').dataTable({
                                'aaSorting': [],
                                'oLanguage': {
                                     'oPaginate': {
                                       'sNext': '',
                                       'sPrevious': ''
                                     }
                                },
                                'sPaginationType': 'two_button',
                                'iDisplayLength' : 25,
                                'bSort' : false,
                                'bAutoWidth' : false,
                                'aoColumns': [ $aoCols ],
                                'aLengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']]
                                    }
                              );
                           });
                            function setupForPrint() {
                                var el=document.getElementById('httableContainer');
                                var theHeight =  el.style.overflow;
                               // alert(theHeight);
                                if (theHeight == 'visible') {
                                    el.style.height='".($height != '' ? $height : '400')."px';
                                    el.style.overflow='scroll';
                                }
                                else {
                                    el.style.height='';
                                    el.style.overflow='visible';

                                }
                            }
                        
                        </script>";
    }
    
    public function setTableNumber() {
        if (!isset($GLOBALS['TBLTMPNBR'])) {
            $GLOBALS['TBLTMPNBR'] = 1;
        }
        else {
            $GLOBALS['TBLTMPNBR']++;
        }
    }
    
    public function setNumericColumn($val, $y) {
        if (checkNumeric($val)) {
            if ($this->getColumnAttribute($y + 1, 'align') !== false) {
                $this->setColumnAttribute($y + 1, 'align', 'right');
            }
        }
    }

    public function getTable($width, $height, $header, $detail, $scroll = true) {

        $this->setTableNumber();
        
        $arb_width = count($width) * 3;
        $str = '';
        $this->header_width = array_sum($width) + $arb_width;
        $this->detail_width = round((array_sum($width) + $arb_width + 15)/0.90);

        $this->setColumns($width);
        $aoCols = "";
        foreach($this->col_span as $key => $val) {
            $curString = "{'sWidth': '$val'}";
            if ($aoCols != "") {
                $aoCols .= ", ";
            }
            $aoCols .= $curString;
        }
        if (!defined('TBLTMPEXISTS')) {
            $str .= $this->getStyle();
            define('TBLTMPEXISTS', 1);
        }
        $str .= $this->getDataTablesScript($aoCols, $height);
        $str .= "<DIV style='width:" . $this->detail_width . "px; display:block; '>\n";
        $str .= $this->openTable();
        $str .= $this->getColumns();
        $str .= "<thead>";

        //HEADERS
        $str .= $this->openRow();
        for ($i = 0; $i < count($header); $i++) {
            $str .= $this->makeHeader($i + 1, $header[$i]);
        }
        $str .= $this->closeRow();
        $str .= "</thead><tbody>";

        //DETAIL
        $x = "0"; // LineCounter;
        foreach ($detail as $row => $line) {
            $this->setRowAttribute("id", "row$x");
            $str .= $this->openRow();
            $y = 0;
            foreach ($line as $fld => $val) {
                if ($val == "") {
                    $val = "&nbsp;";
                } //if blank
                $this->setNumericColumn($val, $y);
                $str .= $this->makeColumn($y + 1, $val);
                $y++;
            } // foreach detail column
            $str .= $this->closeRow();
            if ($x % 2 <> 0) {
                $this->row_attribute = array();
                ;
            }
            $x++;
        } // foreach detail line
        $str .= $this->closeTable();
        $str .= "</DIV>";
        //END DETAIL and DIVISION 2
        return $str;
    }

    public function getColumns() {
        $column_string = "";
        if (count($this->col_span) <= 0) {
            throw new Exception("There are no columns in this table");
        }
        $column_string .= "<colgroup>";
        foreach ($this->col_span as $key => $value) {
            $column_string .= "<COL style=\"width:" . $value . "px;\">\n";
        }
        $column_string .= "</colgroup>";
        return $column_string;
    }

    public function setTableStyle($variable, $value) {
        //function sets a table style
        $this->table_style[$variable] = $value;
    }

    public function setTableAttribute($variable, $value) {
        //function sets a table attribute
        $this->table_attribute[$variable] = $value;
    }

    public function setRowStyle($variable, $value) {
        //function sets a row style
        $this->row_style[$variable] = $value;
    }

    public function setRowAttribute($variable, $value) {
        //function set a row attribute
        $this->row_attribute[$variable] = $value;
    }

    public function setRowColor($color_value) {
        $this->row_bgcolor = $color_value;
    }

    public function setColumnStyle($column, $variable, $value) {
        //function sets a detail style
        $this->column_style[$column]['style'][$variable] = $value;
    }

    public function setColumnAttribute($column, $variable, $value) {
        //function set a detail attribute
        $this->column_attribute[$column]['attribute'][$variable] = $value;
    }

    public function getColumnAttribute($column, $variable) {
        //function set a detail attribute
        if (isset($this->column_attribute[$column]['attribute'][$variable])) {
            return($this->column_attribute[$column]['attribute'][$variable]);
        }
        else {
            return false;
        }
    }

    public function setHeaderStyle($column, $variable, $value) {
        //function sets a detail style
        $this->header_style[$column]['style'][$variable] = $value;
    }

    public function setHeaderAttribute($column, $variable, $value) {
        //function set a detail attribute
        $this->header_attribute[$column]['attribute'][$variable] = $value;
    }

    public function copyColumnFormat($column, $copy) {
        $this->column_detail[$copy] = $this->column_style[$column];
    }

    public function OpenTable() {
        $table = "<TABLE class='tbltmpcls' id='tbltmp".$GLOBALS['TBLTMPNBR']."' ";
        if (count($this->table_style) > 0) {
            $table .= "style=\"";
            foreach ($this->table_style as $key => $value) {
                $table .= $key . ":" . $value . "; ";
            }
            $table .= "\"";
            $table .= " ";
        }
        if (count($this->table_attribute) > 0) {
            foreach ($this->table_attribute as $key => $value) {
                $table .= $key . "=\"" . $value . "\" ";
            }
        }

        $table .= ">\n";
        return $table;
    }

    public function CloseTable() {
        return "</tbody></TABLE>\n";
    }

    public function OpenRow() {
        $row = "<TR ";
        if (count($this->row_attribute) > 0) {
            foreach ($this->row_attribute as $key => $value) {
                $row .= $key . "='" . $value . "' ";
            }
        }
        $row .= ">\n";
        return $row;
    }

    public function CloseRow() {
        return "</TR>\n";
    }

    public function MakeColumn($column, $data) {
        $detail = "<TD ";
        if (@count($this->column_style[$column]['style']) > 0) {
            $detail .= "style=\"";
            foreach ($this->column_style[$column]['style'] as $key => $value) {
                $detail .= $key . ":" . $value . "; ";
            }
            $detail .= "\"";
            $detail .= " ";
        }
        if (@count($this->column_attribute[$column]['attribute']) > 0) {
            foreach ($this->column_attribute[$column]['attribute'] as $key => $value) {
                $detail .= $key . "='" . $value . "' ";
            }
        }
        $detail .= ">";
        $detail .= $data;
        $detail .= "</TD>\n";
        return $detail;
    }

    public function MakeHeader($column, $data) {
        $detail = "<TH ";
        if (@count($this->header_style[$column]['style']) > 0) {
            $detail .= "style=\"";
            foreach ($this->header_style[$column]['style'] as $key => $value) {
                $detail .= $key . ":" . $value . "; ";
            }
            $detail .= "\"";
            $detail .= " ";
        }
        if (@count($this->header_attribute[$column]['attribute']) > 0) {
            foreach ($this->header_attribute[$column]['attribute'] as $key => $value) {
                $detail .= $key . "='" . $value . "' ";
            }
        }
        $detail .= ">";
        $detail .= $data;
        $detail .= "</TH>\n";
        return $detail;
    }

}
