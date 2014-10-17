<?php

// Load the system autoloader
require SYS_PATH.'Autoloader.php';
Koz\Autoloader::register();

// Load the system bootstrap
require APP_PATH.'bootstrap.php';

// Init the Koz
Koz\Core::instance()->init();
