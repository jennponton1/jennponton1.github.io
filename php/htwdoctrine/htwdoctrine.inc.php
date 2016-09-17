<?php

use Doctrine\DBAL;
use Doctrine\Common;
use Doctrine\ORM;

require_once "Doctrine/Common/ClassLoader.php";
require_once ("Doctrine/ORM/Tools/Setup.php");
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory(dirname(__FILE__) . "/../");
// Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();
$htwDoctrineEMArray = array();
/*
 * $classLoader = new Common\ClassLoader('Doctrine',
 * '/usr/local/zend/share/includes'); $classLoader->register(); $classLoader =
 * new Common\ClassLoader('Doctrine\DBAL', '/usr/local/zend/share/includes');
 * $classLoader->register(); $classLoader = new
 * Common\ClassLoader('Doctrine\ORM', '/usr/local/zend/share/includes');
 * $classLoader->register();
 */

function setupORM($db) {
    global $htwDoctrineEMArray;

    $path = dirname(__FILE__);
    if (file_exists($path . "/ORMRepos/$db")) {
        require_once ($path . "/ORMRepos/$db.repo.php");
        $repo = $db . "Repo";
        // Check that this repo has generated an EM yet
        if (isset($htwDoctrineEMArray[$repo])) {
            $em = $htwDoctrineEMArray[$repo];
        }
        else {
            $em = $repo::getEM();
            $htwDoctrineEMArray[$repo] = $em;
        }
        return $em;
    } else {
        throw new Exception("FAILED DURING ORM SETUP!!!");
    }
}
