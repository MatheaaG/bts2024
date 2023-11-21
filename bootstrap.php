<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes

$isDevMode = false;
$proxyDir = false;
$cache = null;


// configuring the database connection
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'mathea',
    'password' => 'plop',
    'dbname' => 'BTS_Mathea',
);

$useSimpleAnnotationReader = false;

$config = ORMSetup::createAttributeMetadataConfiguration(
    array(__DIR__."/src"),
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
 );

// obtaining the entity manager
$entityManager =  EntityManager::create($dbParams, $config);

