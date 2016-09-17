<?php

function checkObjectOrArray($arguments = "") {
    if (!is_object($arguments) && !is_array($arguments)) {
        throw new Exception("You must pass an array or object! ".var_export($arguments, true));
    }
}

function stripQuotes($string) {
    if (substr($string, 0, 1) == "'") {
        $string = substr($string, 1);
    }
    if (substr($string, strlen($string) - 1, 1)) {
        $string = substr($string, 0, strlen($string) - 1);
    }
    return $string;
}

function appendFieldList($field, $list, $delim = ",") {
    if ($list != "") {
        $list .= "$delim ";
    }
    $list .= " $field ";
    return $list;
}

function checkIsValid($item, $validList, $checkSource = "Query") {
    if (!in_array($item, $validList)) {
        throw new Exception("The item $item is not valid for $checkSource");
    }
    return true;
}
