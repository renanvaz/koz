<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

// Composer autoload
// require_once('../vendor/autoload.php');
require_once('koz-bootstrap.php');

use ULib\UCore;

UCore::load('tests/Router.u.php');

file_put_contents('u-ui/uReport.json', UCore::getJSON());
