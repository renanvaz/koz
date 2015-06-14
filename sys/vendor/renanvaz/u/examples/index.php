<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

require_once('../src/ULib/UCore.php');

use ULib\UCore;

UCore::load('tests/Core.u.php');

echo UCore::getJSON();

