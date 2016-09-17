<?php

/**
 *
 * Used to setup configuration variables for the framework
 * 
 * @package HTFramework
 * @subpackage HTCommon
 * @filesource 
 * 
 */
/**
 *  HTConfig - class 
 *  Act as a single reference for all highly dependent configuration information.
 *    
 */ 
class HTConfig {
	/**
	 * @var string solDSN DSN of Hoover Solomon DB
	 */
	var $solDSN = "adohtwsol";
	/**
	 * @var string conSolDSN DSN of *Live* Hoover Financial Summary DB
	 */
	var $conSolDSN = 'adoconsol';
	
	/**
	 * @var string ldapServer IP Address of LDAP Server
	 */
	var $ldapServer = "10.0.0.5";
	/**
	 * @var string dwhServer IP Address of MySQL DB Server
	 */
	var $dwhServer = "127.0.0.1";
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
