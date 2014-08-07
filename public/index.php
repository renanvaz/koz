<?php

$application    = '../application';
$modules        = '../modules';
$system         = '../koz';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL | E_STRICT);

define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

unset($application, $modules, $system);

require SYSPATH . 'App.php';

// if (file_exists('install.php')) {
//  return include 'install.php';
// }
