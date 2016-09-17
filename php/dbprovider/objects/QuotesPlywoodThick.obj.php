<?php

require_once "basetable.class.php";

class Quotesplywoodthick  {

    public function findOpen() {
        return $this->findWhere(array("nomthick"=>"%"));
    }

    public function findWhere($parms = "") {
        if (!is_array($parms)) {
            throw new Exception("You must pass an array to the findWhere method! ");
        }
        $plyThick = new GenericMySqlTable("plythick", "quotes");
        $stmt = $plyThick->findWhere($parms);
        $tmpArray = $stmt->fetchAll();
        $retArray = array_map(
            function ($el) {
                $el->nomThick = $el->nomthick;
                $el->actThick = $el->actthick;
                unset($el->nomthick);
                unset($el->actthick);
                return $el;
            },
            $tmpArray
        );
        return $retArray;
    }
}
