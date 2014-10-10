<?php

$private        = './';
$application    = './app/';
$modules        = './modules/';
$system         = './koz/';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL | E_STRICT);

define('PRIVATE_PATH', realpath($private).DIRECTORY_SEPARATOR);
define('APP_PATH', realpath($application).DIRECTORY_SEPARATOR);
define('MOD_PATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath($system).DIRECTORY_SEPARATOR);

unset($private, $application, $modules, $system);

require SYS_PATH . 'Core.php';

// if (file_exists('install.php')) {
//  return include 'install.php';
// }
