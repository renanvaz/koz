<?php

namespace Koz;

class Core {
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    private static $instance;
    private $_baseURL;
    private $_uri;

    public static $charset  = 'utf-8';
    public static $env      = Env::PRODUCTION;

    private function __construct () {}

    public function __get ($key) {
        switch ($key) {
            case 'baseURL':
                return $this->_baseURL;
            break;
            case 'uri':
                return $this->_uri;
            break;
            default:
                return isset(self::$$key) ? self::$$key : $this->$key;
            break;
        }
    }

    public static function instance () {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function init () {
        if (function_exists('mb_internal_encoding')) {
            // Set the MB extension encoding to the same character set
            mb_internal_encoding(self::$charset);
        }

        if (function_exists('mb_substitute_character')) {
            mb_substitute_character('none');
        }

        $this->_baseURL = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);
        $this->_uri = preg_replace(['!'.$this->_baseURL.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        // Set the defailt route to math all controllers and action
        Router::parse($this->_uri);
    }
}
