<?php

// Load the system autoloader
require SYS_PATH.'classes/Autoloader.php';
Koz\Autoloader::register();

// Load the system bootstrap
require APP_PATH.'bootstrap.php';

if (function_exists('mb_internal_encoding')) {
    // Set the MB extension encoding to the same character set
    mb_internal_encoding(Koz\Core::$charset);
}

if (function_exists('mb_substitute_character')) {
    mb_substitute_character('none');
}

// Set the default locale.
setlocale(LC_ALL, Koz\Core::$locale);

// Set the default time zone.
date_default_timezone_set(Koz\Core::$timezone);
