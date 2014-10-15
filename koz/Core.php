<?php

namespace Koz;

class Core {
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    public static $charset = 'utf-8';
    public static $baseURL = '';
    public static $uri = '';
    public static $env = Env::PRODUCTION;

    public static function init () {
        if (function_exists('mb_internal_encoding')) {
            // Set the MB extension encoding to the same character set
            mb_internal_encoding(Core::$charset);
        }

        if (function_exists('mb_substitute_character')) {
            mb_substitute_character('none');
        }

        self::$baseURL = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);
        self::$uri = preg_replace(['!'.self::$baseURL.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        // Set the defailt route to math all controllers and action
        Router::parse(self::$uri);
    }
}
