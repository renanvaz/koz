<?php

namespace Koz;

require 'Autoloader.php';

Autoloader::register();

class Core {
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    public static $charset = 'utf-8';
    public static $base_url = '';
    public static $uri = '';
    public static $env = Env::PRODUCTION;

    public static function init () {
        if (function_exists('mb_internal_encoding')) {
            // Set the MB extension encoding to the same character set
            mb_internal_encoding(Core::$charset);
        }

        self::$base_url = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);
        self::$uri = preg_replace(['!'.self::$base_url.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        // Set the defailt route to math all controllers and action
        Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'home', 'action' => 'index']);
        Router::parse(self::$uri);
    }
}

Core::init();
