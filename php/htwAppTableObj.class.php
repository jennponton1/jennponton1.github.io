<?php

class TableObj {

	protected $hdrs;
	protected $widths;
	protected $height;
	protected $detail;

	public function __construct() {
		$this->hdrs   = array();
		$this->widths = array();
		$this->height = 400;
		$this->detail = array();
	}

	public function addColumn($hdrName, $colWidth, $align = "") {
		$this->hdrs []       = $hdrName;
		$this->widths []     = $colWidth;
		$this->alignments [] = $align;
	}

	public function addDetail($det) {
		$this->detail = $det;
	}

	public function setHeight($in_height) {
		$this->height = $in_height;
	}

	public function getHdrs() {
		return $this->hdrs;
	}

	public function getWidths() {
		return $this->widths;
	}

	public function getHeight() {
		return $this->height;
	}

	public function getDetail() {
		return $this->detail;
	}

}
