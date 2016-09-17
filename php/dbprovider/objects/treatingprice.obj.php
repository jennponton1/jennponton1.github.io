<?php

require_once "basetable.class.php";

class Treatingprice {

	public function findOpen() {
		return $this->findWhere(array("trtid"=>"%"));
	}

	public function findWhere($criteria) {
		$tbl = new GenericPVSWTable("httrprc");
		$ds = $tbl->findWhere($criteria);
		return $ds->fetchAll();
	}

}
