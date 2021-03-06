<?PHP

	class TableTemplate {

		var $col_span = array();
		var $table_style = array();
		var $table_attribute = array();
		var $row_style = array();
		var $row_attribute = array();
		var $column_style = array();
		var $column_attribute = array();
		var $header_style = array();
		var $header_attribute = array();
		var $column_detail = array();
		var $header_width = 0;
		var $detail_width = 0;
	        var $row_bgcolor = "#CCCCCC";

		function setHeaderWidth($width){
			$this -> header_width = $width;
			$this -> detail_width = $width + 15;
		}
		
		function setColumns($col_array){
			foreach($col_array as $key=>$value){
				$this -> col_span[$key] = $value;				
			}
		}
		
		function getStyle(){
			return "
				<STYLE>
					  TD   {display: run-in; overflow: hidden;}
					  TH   {display: run-in; overflow: hidden;}
				</STYLE>";
		}
		
		function getTable($width,$height, $header,$detail){

			$arb_width = count($width)*3;
			$str='';
//			global $header_width;
			$this->header_width = array_sum($width)+$arb_width;
//			global $detail_width;
			$this->detail_width = array_sum($width)+$arb_width+15;


			$this->setColumns($width);
			$this->setTableAttribute("border","1");
			$this->setTableAttribute("width","100%");
			$this->setTableStyle("font-family","arial");
			$this->setTableStyle("height","5px");
			$this->setTableStyle("font-size","8pt");
			$this->setTableStyle("table-layout","fixed");

			$str .= "
			<STYLE>
	  			TD   {display: run-in; overflow: hidden;}
			</STYLE>";

			//DIV1
			$str .= "<DIV style='width:".$this->header_width."px; display:block; '>\n";
			$str .= $this->openTable();
			$str .= $this->getColumns();

			//HEADERS
			$str .= $this->openRow();
			for($i=0;$i<count($header);$i++){
				$str .= $this->makeHeader($i+1,$header[$i]);
			}
			$str .= $this->closeRow();
			$str .= $this->closeTable();
			$str .= "</DIV>";
			//END DIV1 and HEADER

			//DIVISION 2
			$str .= "<DIV style='width:".$this->detail_width."px; display:block; height:".$height."px; overflow:scroll;'>\n";
			$str .= $this->openTable();
			$str .= $this->getColumns();		
			
			//DETAIL
			for($x=0;$x<count($detail);$x++){
                                if($x%2 <> 0){$this->setRowAttribute("bgcolor",$this->row_bgcolor);}
				$str .= $this->openRow();
				for($y=0;$y<count($detail[$x]);$y++){
					if($detail[$x][$y]==""){
						$str .= $this->makeColumn($y+1,"&nbsp;");
					}
					else{$str .= $this->makeColumn($y+1,$detail[$x][$y]);}
				}
				$str .= $this->closeRow();
                                if($x%2 <> 0){$this->row_attribute = array();;}
			}		

			$str .= $this->closeTable();
			$str .= "</DIV>";
			//END DETAIL and DIVISION 2
			
			return $str;
		
		}
			
		
		function getColumns(){
			$column_string = "";
			if (count($this->col_span)<=0){exit;}			
			foreach($this->col_span as $key=>$value){
				$column_string .= "<COL style=\"width:".$value."px;\">\n";				
			}
			return $column_string;
		}
		
		
		function setTableStyle($variable, $value){
			//function sets a table style
			$this -> table_style[$variable] = $value;
		}
		function setTableAttribute($variable, $value){
			//function sets a table attribute
			$this -> table_attribute[$variable] = $value;
		}
		function setRowStyle($variable, $value){
			//function sets a row style
			$this -> row_style[$variable] = $value;
		}
		function setRowAttribute($variable, $value){
			//function set a row attribute
			$this -> row_attribute[$variable] = $value;
		}
		
		function setRowColor($color_value){
	                 $this -> row_bgcolor = $color_value;
	        }
		function setColumnStyle($column, $variable, $value){
			//function sets a detail style
			$this -> column_style[$column]['style'][$variable] = $value;
		}
		function setColumnAttribute($column, $variable, $value){
			//function set a detail attribute
			$this -> column_attribute[$column]['attribute'][$variable] = $value;
		}
		function setHeaderStyle($column, $variable, $value){
			//function sets a detail style
			$this -> header_style[$column]['style'][$variable] = $value;
		}
		function setHeaderAttribute($column, $variable, $value){
			//function set a detail attribute
			$this -> header_attribute[$column]['attribute'][$variable] = $value;
		}
		
		function copyColumnFormat($column,$copy){
			$this -> column_detail[$copy] = $this -> column_style[$column];	
		}
		
		

		
		function OpenTable(){
			$table = "<TABLE ";
			if(count($this->table_style)>0){
				$table .= "style=\"";
				foreach($this->table_style as $key=>$value){
					$table .= $key.":".$value."; ";				
				}
				$table .= "\"";
				$table .= " ";
			}		
			if(count($this->table_attribute)>0){
				foreach($this->table_attribute as $key=>$value){
					$table .= $key."=\"".$value."\" ";				
				}
			}
						
			$table .= ">\n";
			return $table;		  
		}


		function CloseTable(){
			return "</TABLE>\n";
		}

		function OpenRow(){
			$row = "<TR ";
			if(count($this->row_style)>0){
				$row .= "style=\"";
				foreach($this->row_style as $key=>$value){
					$row .= $key.":".$value.";";				
				}
				$row .= "\"";
				$row .= " ";
			}		
			if(count($this->row_attribute)>0){
				foreach($this->row_attribute as $key=>$value){
					$row .= $key."='".$value."' ";				
				}
			}
			$row .= ">\n";
			return $row;		  
		}		
		
		function CloseRow(){
			return "</TR>\n";
		}
		
		function MakeColumn($column,$data){
			$detail = "<TD ";
			if(@count($this->column_style[$column]['style']) >0){
				$detail .= "style=\"";
				foreach($this->column_style[$column]['style'] as $key=>$value){
					$detail .= $key.":".$value."; ";
				}
				$detail .= "\"";
				$detail .= " ";
			}
			if(@count($this->column_attribute[$column]['attribute']) >0){
				foreach($this->column_attribute[$column]['attribute'] as $key=>$value){
					$detail .= $key."='".$value."' ";
				}
			}
			$detail .= ">";
			$detail .= $data;
			$detail .= "</TD>\n";
			return $detail;
		}

		function MakeHeader($column,$data){
			$detail = "<TH ";
			if(@count($this->header_style[$column]['style']) >0){
				$detail .= "style=\"";
				foreach($this->header_style[$column]['style'] as $key=>$value){
					$detail .= $key.":".$value."; ";				
				}
				$detail .= "\"";
				$detail .= " ";
			}
			if(@count($this->header_attribute[$column]['attribute']) >0){
				foreach($this->header_attribute[$column]['attribute'] as $key=>$value){
					$detail .= $key."='".$value."' ";				
				}
			}
			$detail .= ">";
			$detail .= $data;
			$detail .= "</TH>\n";		
			return $detail;		  
		}
		
	
	}	
?>
