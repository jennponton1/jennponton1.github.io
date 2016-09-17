<?php

/**
 *
 * Used to setup configuration variables for the framework
 * 
 * @package htwFramework
 * @subpackage Config
 * 
 */

class htwConfig {
	/**
	 * @var string solDSN DSN of Hoover Solomon DB
	 */
	var $solDSN = "adohtwsol";
	/**
	 * @var string ldapServer IP Address of LDAP Server
	 */
	var $ldapServer = "10.0.0.5";
	/**
	 * @var string dwhServer IP Address of MySQL DB Server
	 */
	var $dwhServer = "10.0.1.1";
	/**
	 * @var string dwhDBName Name of MySQL DB for DataWarehouse
	 */
	var $dwhDBName = "dwh";
	/**
	 * @var string dwhDBUser Name of MySQL DB User
	 */
	var $dwhDBUser = "root";
	/**
	 * @var string dwhDBPass Password for MySQL DB User
	 */
	var $dwhDBPass = "";
	/**
	 * @var boolean debug Used to generate Warning/Notice/Error Messages from PHP
	 */
	var $debug = true;
}
?>
