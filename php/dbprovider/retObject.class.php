<?php

class RetObject {

    public $status;
    public $message;
    public $data;
    public $count;

    public function __construct() {
        $this->status = "FAILED";
        $this->message = "Only initialized";
        $this->data = array();
        $this->count = 0;
    }

    public function setMessage($message = '') {
        $this->message = $message;
    }

    public function setStatus($status = '') {
        $this->status = $status;
    }

    public function setData($data = null) {
        $this->data = $data;
        if (is_array($data)) {
            $this->count = count($data);
        }
    }

    public function toJSON() {
        $retStr = json_encode($this);
        $retStr = str_replace(":null,", ":[],", $retStr);
        return $retStr;
        //        return json_encode($this);
    }

}
