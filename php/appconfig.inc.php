<?php

/**
 *
 * Used to setup configuration variables for the framework
 * 
 * @package htwAppFramework
 * @subpackage Config
 * 
 */

class htwConfig {
	/**
	 * @var string solDSN DSN of Hoover Solomon DB
	 */
//	var $solDSN = "adohtwsol";
	/**
	 * @var string ldapServer IP Address of LDAP Server
	 */
	var $ldapServer = "10.0.0.5";
	var $ldapBase = "o=htwp.com,c=US";
	/**
	 * @var Home URL of Home page of this application
	 */
	var $home="http://zmirror.htwp.com/";
	var $smartyTemplDir = "c:/inetpub/php/templates";
	var $smartyCompileDir =  "c:/inetpub/php/tempcomp";
	var $debug = true;
}
?>
