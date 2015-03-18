<?php

$private        = '../';
$application    = '../app/';
$modules        = '../modules/';
$system         = '../koz/';


if (!defined('PRIVATE_PATH')) {
    define('PRIVATE_PATH', realpath($private).DIRECTORY_SEPARATOR);
    define('APP_PATH', realpath($application).DIRECTORY_SEPARATOR);
    define('MOD_PATH', realpath($modules).DIRECTORY_SEPARATOR);
    define('SYS_PATH', realpath($system).DIRECTORY_SEPARATOR);

    unset($private, $application, $modules, $system);

    // Load the system autoloader
    require SYS_PATH.'classes/Autoloader.php';
    Koz\Autoloader::register();

    // Load the system bootstrap
    require APP_PATH.'bootstrap.php';
}
