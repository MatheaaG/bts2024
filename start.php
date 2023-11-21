<?php
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$isDevMode = true;
$proxyDir = null;
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


$entityManager =  EntityManager::create($dbParams, $config);

$class = "Controllers\\" .(isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET) ? $_GET : null;
$postParams = isset($_POST) ? $_POST : null;

$params = array(array(
    "url"=>"https://195.154.118.169/mathea/site/",
    "get"=>$getParams,
    "em"=> $entityManager,
    "getParams"=>$getParams

));

if ($class == "Controllers\IndexController" && in_array($target, get_class_methods($class)))
{
    $class = new Controllers\IndexController;
    call_user_func_array([$class, $target], $params);
} else
{
    $class = new $class;
    call_user_func_array([$class, $target], $params);
}
