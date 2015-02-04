<?php

namespace Koz;

use \Helpers\Text;
use \Helpers\Debug;

// isMobile
// isIOS
// isAndroid
// isAjax

class Request {
    private static $_uri;
    private static $_params;
    private static $_defaults;

    public static $method;
    public static $controller;
    public static $action;

    public static function make ($uri, $method, $defaults, $params) {
        self::$_uri         = $uri;
        self::$_params      = $params;
        self::$_defaults    = $defaults;
        self::$method       = $method;
        self::$controller   = Text::studlyCaps(self::param('controller'));
        self::$action       = Text::camelCase(self::param('action'));

        $class = 'Controllers\\'.self::$controller;

        $controller = new $class();

        $action = self::$method.'_'.self::$action;

        // If the action doesn't exist, it's a 404
        if (!method_exists($controller, $action) AND !method_exists($controller, $action = 'REQUEST_'.self::$action)) {
            return FALSE;
        } else {
            $controller->before();
            $controller->{$action}();
            $controller->after();

            return TRUE;
        }
    }

    public static function param ($name, $default = NULL) {
        return isset(self::$_params[$name]) ? self::$_params[$name] : (isset(self::$_defaults[$name]) ? self::$_defaults[$name] : $default);
    }
}
