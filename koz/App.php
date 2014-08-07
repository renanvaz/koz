<?php

namespace Koz;

require 'Autoloader.php';

\Koz\Autoloader::register();

use \Koz\Env as Env;

class App {
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    static public $env = Env::PRODUCTION;
}

preg_match("!(?P<te>[^/]+)/(?P<year>\d{4})!", 'teste/2014', $results);
echo '<pre>';

print_r($results);
