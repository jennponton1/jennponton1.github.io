<?php

/**
 * Application Dispatcher/Controller Class
 *
 * the object provides a mechanism to control what actions occur when in multi-call
 * scripts
 *
 * data elements:
 * - $action : the name of the variable to be taken from the $_REQUEST in order to determine what to do
 	* - $dispatchArray : an array with the value for the action variable as an index and a function
 * 		name to execute as the value
 */
class htwAppController {
	public $action;
	public $dispatchArray;

	public function __construct($varName, $dispatchAr = '') {
		if (isset($varName)) {
			$this->action = @$_REQUEST[$varName];
			if (!isset($this->action)) {
				$this->action = "null";
			}
			if ($dispatchAr != '') {
				$this->dispatchArray = $dispatchAr;
			}
		}
		else {
			die("You must specify an action parameter");
		} // else no var passed
	} // constructor

	public function addElement($actionVal, $functionName){
		$dispatchArray[$actionVal] = $functionName;
	}

	public function dispatch(){
		if (isset($this->dispatchArray[$this->action])) {
			$this->dispatchArray[$this->action]();
		}
		else {
			throw new Exception('Unknown Action');
		}
	} // dispatch
}
