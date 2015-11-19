<?php

$private        = './';
$public        = './public/';
$system         = './sys/';
$application    = './app/';
$modules        = './modules/';

define('PRIVATE_PATH', realpath($private).DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', realpath($private).DIRECTORY_SEPARATOR);
define('APP_PATH', realpath($application).DIRECTORY_SEPARATOR);
define('MOD_PATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath($system).DIRECTORY_SEPARATOR);

unset($private, $public, $application, $modules, $system);

require SYS_PATH.'bootstrap.php';

// if (file_exists('install.php')) {
//  return include 'install.php';
// }

// Init the Koz
Koz\Core::init();
