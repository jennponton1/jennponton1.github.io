<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\DBAL;
use Doctrine\Common;
use Doctrine\ORM;

class IntranetRepo {

    public static function getEM() {
        $classLoader = new Common\ClassLoader('Intranet', dirname(__FILE__) . "/intranet");
        $classLoader->register();
        if (class_exists("Zend_Loader_Autoloader")) {
            $loader = Zend_Loader_Autoloader::getInstance();
            $loader->pushAutoloader($classLoader->loadClass, "Intranet");
        }
        $cache = new Common\Cache\ArrayCache;


        $config = new ORM\Configuration;
        $config->setMetadataCacheImpl($cache);
        // $driverImpl = $config->newDefaultAnnotationDriver(dirname(__FILE__) . '/DWH');
        $driverImpl = $config->newDefaultAnnotationDriver();
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(dirname(__FILE__) . '/proxies');
        $config->setProxyNamespace('proxies');

        //$config->setAutoGenerateProxyClasses(true);

        $connectionOptions = array(
            'dbname' => 'intranet',
            'user' => 'root',
            'password' => '',
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql',
        );
        $evm = new Common\EventManager();
        $em = ORM\EntityManager::create($connectionOptions, $config, $evm);
        return $em;
    }

}
