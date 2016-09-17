<?php

/*
 * Various utility functions related to objects &/or db
 */

/*
 * dbEmptyClone will take an input object ($object) and return
 * a similar object with all properties set to null
 */
function dbEmptyClone($object, $default = null) {
    // force $object to be an object
    try {
        $workVar = (object) $object;
        $newObj = new stdClass();
        foreach($workVar as $prop=>$value) {
            $value = $default;
            $newObj->$prop = $value;
        }
        return $newObj;
    }
    catch (Exception $e) {
        throw Exception("Failed cloning the object ".$e->getMessage());
    }
}
