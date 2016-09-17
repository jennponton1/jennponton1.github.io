<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "page.class.php";

class meshPage extends Page {

    public function __construct($in) {
        parent::__construct($in);
    }

    public function  getBody() {
        return $this->_body;
    }

    public function getHead() {
        return $this->_head;
    }

    public function  getTitle() {
        return $this->_title;
    }




}


?>
