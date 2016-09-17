<?php

require_once "basetable.class.php";

class WoodFactors {
	public function __construct() {

	}

	public function findOpen() {
		$tbl = new GenericMySqlTable("woodconv");
		$retAr = $tbl->findWhere(array("woodid"=>"%"));
		return $retAr->fetchAll();
	}

	public function findWhere() {
		return $this->findOpen();
	}
}