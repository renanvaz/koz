<?php

namespace Koz;

require 'Autoloader.php';

Autoloader::register();

use Env;

class App {
    const VERSION  = '1.0.0';
    const CODENAME = 'goma';

    static public $env = \Env::PRODUCTION;
}


die('Test '.\Env::PRODUCTION);
