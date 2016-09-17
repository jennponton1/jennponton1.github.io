<?php

/**
 *  HTFramework.inc.php
 *  The only file required for HTFramework functionality. This file includes
 *  other class definition files as they are referenced by client (non-framework)
 *  code. This is done dynamically by PHP using the __autoload function.
 *  @package HTFramework
 *  @subpackage HTCommon
 *  @filesource
 *
 */
/**
 *  Framework Defines
 */
/**
 *  Define this boolean as true for the development phase of your project.
 *  This define should always be false for the production version of this file.
 */
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL);
//define (HTFRK_FRAMEWORK_DEBUG, true);

define('HTLIB_PATH', 'Libraries/');
define('HTFRK_PATH', 'Libraries/Framework/');
define('HTFRK_DB_PATH', 'Libraries/Framework/HTDb/');
define('HTFRK_EX_NOTICE', 5);
define('HTFRK_EX_WARNING', 10);
define('HTFRK_EX_STOP', 15);

/**
 *
 *  The Framework uses the convention of one PHP source file per-class definition
 *  PHP calls the __autoload function whenever a class is referenced which hasn't
 *  been defined yet.
 *
 *  When you add a class to the Framework, add a _require_once call for it here.
 */

function buildRegistryArray($which, $array) {
    $retArray = array();
    foreach ($array as $item) {
        $retArray[$item] = $which;
    }
    return $retArray;
}

function htwAppAutoload($className) {
    $frkArray   = buildRegistryArray(
        "FRK",
        array(
            'HTException',
            'HTQuickFormsExt',
            'HTConfig',
            'HTResult',
            'SolModel',
            'CorpSolModel',
            'DwhModel',
            'scrollTable',
            'HTDate'
        )
    );
    $libArray   = buildRegistryArray(
        "LIB",
        array(
            'TableTemplate',
        )
    );
    $dbArray    = buildRegistryArray(
        "DB",
        array(
            'SalesOrd',
            'STax',
            'CustomerModel',
            'TermsModel',
            'ArsetupModel',
            'Treatment',
            'ARDoc',
            'MeterReadings',
            'MeterReading',
            'Meters',
            'OrderSum',
            'CRMCalls',
            'AcctPeriods',
            'WoodIdModel',
            'TreatIdModel',
            'PartNbrModel',
            'UnitConvModel',
            'INConvModel',
            'SalesOrd',
            "SalesOrderDetail",
            'HistStockLevelModel',
            "StockLevelModel",
            "INSetup",
            "PlyWallDat",
            "HTExportCertModel",
            "StatSumModel",
            'negunrecstat',
        )
    );
    $modelArray = buildRegistryArray(
        "MODEL",
        array(
            'iHTModel',
            'clsHTModel',
        )
    );
    $allArray   = array_merge($frkArray, $libArray, $dbArray, $modelArray);
    if (!isset($allArray[$className])) {
        if (file_exists($className.".class.php")) {
            require_once "$className.class.php";
        }
        return;
    }
    switch ($allArray[$className]) {
        case "MODEL":
            require_once HTFRK_PATH . 'HTModel.class.php';
            break;
        case "LIB":
            require_once HTLIB_PATH . $className . '.class.php';
            break;
        case "DB":
            require_once HTFRK_DB_PATH . $className . '.class.php';
            break;
        case "FRK":
            require_once HTFRK_PATH . $className . '.class.php';
            break;
    }
}

//function __autoload($class) {
//    htwApp_autoload($class);
//}
spl_autoload_register(htwAppAutoload);

/**
 * HTApp Application Object
 *
 */
class HTApp {

    /**
     * @class implements Singleton pattern
     */
    private static $theOnlyInstance;

    /**
     * Only one app object ever gets instatiated. Use static call to
     * HTApp::getApp(); to get that object. Clone is not allowed.
     */
    public static function getApp() {
        if (!isset(self::$theOnlyInstance)) {
            self::$theOnlyInstance = new HTApp();
        }
        return self::$theOnlyInstance;
    }

    private function __construct() {
        if (HTFRK_FRAMEWORK_DEBUG) {
            error_reporting(E_ALL ^ E_NOTICE);
            //      error_reporting(E_ALL);
        }
        else {
            error_reporting(E_NONE);
        }
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function makeTable($headers, $widths, $height, $detail) {
        $table = new TableTemplate();
        echo $table->getTable($widths, $height, $headers, $detail);
    }

}

//$objApp = HTApp::getApp();
