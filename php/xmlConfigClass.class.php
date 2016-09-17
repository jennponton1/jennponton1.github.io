<?php

class XMLConfigClass  {
	protected $fileName;
	protected $configData;
	protected $configCount;
	protected $curName;
	protected $curVal;
	
	public function __construct($file="") {
		$this->fileName = "";
		if ($file != "") $this->fileName = $file;
		else {
			throw new HTException ("You must specify a configuration file!!", HTFRK_EX_STOP);
		}
		$isCli = (strtolower( php_sapi_name() ) == "cli");
		if ($isCli) {
			$tmpAr = pathinfo($_SERVER["PHP_SELF"]);
			$this->fileName = $tmpAr["dirname"]."/".$this->fileName;
		}
		$this->configData = array();
		$parser = xml_parser_create();
		xml_set_element_handler($parser,array($this,"startElement"),array($this,"endElement"));
		xml_set_character_data_handler($parser,array($this,"getCharData"));
		$xml_data = file_get_contents($this->fileName);
		if ($xml_data === false) {
		  	throw new HTException("Could not open configuration file ".$this->fileName,HTFRK_EX_STOP);
		}
		$this->configCount = 0;
		xml_parse($parser,$xml_data);
	}
	
	public function startElement($parser, $name, $attribs) {
		if ($name == "CONFIG" || $name == "XML") {
			// Do Nothing
		}
		else 
		if ($name == "DATA") {
			$this->curVal ="";
			$this->curName = $name;
		}
		else {
		}
	}
	
	public function getCharData($parser, $data) {
		$this->curVal = $data;
	}
	
	public function endElement($parser,$name){
		if ($name == "CONFIG" || $name == "XML") {
			// Do Nothing
		}
		else 
		if ($name == "DATA") {
			$this -> configCount++; 			
		}
		else {
			$this->configData[$this->configCount][$name] = $this->curVal;
		}
	}
	
	public function dump() {
		echo "<pre>";
		var_dump($this->configData);
		echo "</pre>";
	}
	
	public function xml_dump() {
		echo "<pre>";
		echo $this->getXMLString();
		echo "</pre>";
	}
	
	public function getXMLString() {
		$str = "";
		$str .= "<config>\n";
		foreach ($this->configData as $ndx=>$row) {
			$str .= "<data>\n";
			foreach ($row as $field=>$val) {
				$field = strtolower($field);
				$str .= "<$field>$val</$field>\n";
			}
			$str .= "</data>\n";
		}
		$str .= "</config>\n";
		return $str;		
	}
		
	public function save() {
		$newName = $this->fileName.".save";
		if (file_exists($newName)){
			for ($i=1;file_exists($newName.$i);$i++);
			$newName = $newName.$i;
		}
		rename($this->fileName,$newName);
		$str = $this->getXMLString();
		file_put_contents($this->fileName,$str);
	}
	
	public function addItem($itemAr){
		$this->configData[$this->configCount] = $itemAr;
		$this->configCount++;		
	}
	
	public function getItems($critAr) {
		$retAr = array();
		$retCount = 0;
		for ($i=0;$i<$this->configCount;$i++) {
			$curRow = $this->configData[$i];
			$found = true;
			foreach ($critAr as $checkFld=>$checkVal) {
				$checkFld = strtoupper($checkFld);
				if (isset($curRow[$checkFld]) && $curRow[$checkFld]==$checkVal ) {
					// Do Nothing
				}
				else $found = false;
			}
			if ($found) {
				$retAr[$retCount] = $curRow;
				$retCount ++;
			}
		}
		return $retAr;
	}
	
} 

?>