<?php

namespace Apachelogs;

abstract class BaseEntityClass {

    protected $fields;

    public function __construct() {
        $this->fields = array();
        $this->buildFieldArray();
    }

    public function __get($name) {
        if ($this->validField($name)) {
            return $this->$name;
        } else {
            throw new \Exception("$name is not a valid field!");
        }
    }

    public function __set($name, $value = "") {
        if ($this->validField($name)) {
            $this->$name = $value;
        } else {
            throw new \Exception("$name is not a valid field!");
        }
    }

    protected function buildFieldArray() {
        $Refl = new \ReflectionClass($this);
        $this->fields = array();
        foreach ($Refl->getProperties() as $prop) {
            $comment = $prop->getDocComment();
            $comment = strtolower($comment);
            if (strpos($comment, "@column") !== false) {
                $this->fields[] = $prop->getName();
            }
        }
    }

    public function validField($name) {
        if ($this->fields == null) {
            $this->buildFieldArray();
        }
        $ret = in_array($name, $this->fields);
        return ($ret);
    }

    public function toJSON() {
        if ($this->fields == null) {
            $this->buildFieldArray();
        }
        $ret = array();
        foreach ($this->fields as $field) {
            $val = $this->$field;
            if ($val == null || $val == "null") {
                $val = "";
            }
            $ret[$field] = $val;
        }
        return json_encode($ret);
    }

    public function __call($method, $parms) {

        $str = "";
        if (substr($method, 1, 2) == 'et') {
            $which = substr($method, 0, 3);
            $prop = substr($method, 3);
            $prop = strtolower(substr($prop, 0, 1)) . substr($prop, 1);
            if (!$this->validField($prop)) {
                throw new Exception("Unknown field $prop");
            }
            switch ($which) {
                case "get":
                    //$str = "I would have gotten the value for $prop  by returning \$this->$prop";
                    return $this->$prop;
                    break;
                case "set":
                    //$str = "I would have set the value for $prop  by calling \$this->$prop=$parms[0]";
                    $this->$prop = $parms[0];
                    break;
                default:
                    $str = "You tried to call undefined method $method";
                    throw new Exception($str);
                    break;
            }
        } else {
            $str = "You tried to call undefined method $method";
            throw new Exception($str);
        }
    }

}
