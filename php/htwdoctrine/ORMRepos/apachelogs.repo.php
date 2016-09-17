<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

use Doctrine\DBAL;
use Doctrine\Common;
use Doctrine\ORM;

class ApachelogsRepo {

    public static function getEM() {
        $classLoader = new Common\ClassLoader('Apachelogs', dirname(__FILE__) . "/apachelogs");
        $classLoader->register();

        $cache = new Common\Cache\ArrayCache();

        $config = new ORM\Configuration();
        $config->setMetadataCacheImpl($cache);
        // $driverImpl = $config->newDefaultAnnotationDriver(dirname(__FILE__) .
        // '/archivedb');
        $driverImpl = $config->newDefaultAnnotationDriver();
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(dirname(__FILE__) . '/proxies');
        $config->setProxyNamespace('proxies');

        // $config->setAutoGenerateProxyClasses(true);

        $connectionOptions = array(
            'dbname' => 'apachelogs',
            'user' => 'root',
            'password' => '',
            'host' => '10.0.0.164',
            'driver' => 'pdo_mysql'
        );
        $evm = new Common\EventManager();
        $em = ORM\EntityManager::create($connectionOptions, $config, $evm);
        return $em;
    }

}
