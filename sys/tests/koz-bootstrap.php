<?php

$private        = '../';
$application    = '../app/';
$modules        = '../modules/';
$system         = '../koz/';

define('PRIVATE_PATH', realpath($private).DIRECTORY_SEPARATOR);
define('APP_PATH', realpath($application).DIRECTORY_SEPARATOR);
define('MOD_PATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath($system).DIRECTORY_SEPARATOR);

unset($private, $application, $modules, $system);

// Load the system autoloader
require SYS_PATH.'bootstrap.php';
