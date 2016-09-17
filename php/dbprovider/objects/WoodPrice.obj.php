<?php

require_once "basetable.class.php";

class WoodPrice {

    public function findOpen() {
		return $this->findWhere(array("woodid"=>"%"));
    }

    public function findWhere($criteria) {
    	$tbl = new GenericPVSWTable("htwdprc");
    	$ds = $tbl->findWhere($criteria);
    	return $ds->fetchAll();
    }

}
