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

    public static $_GET;
    public static $_POST;
    public static $_PUT;
    public static $_DELETE;
    public static $_OPTIONS;
    public static $_TRACE;
    public static $_CONNECT;
    public static $_HEAD;



    public static function make ($uri, $method, $defaults, $params) {
        self::$_uri         = $uri;
        self::$_params      = $params;
        self::$_defaults    = $defaults;

        self::$method       = $method;

        self::$_GET         = Input::parse('GET');
        self::$_POST        = Input::parse('POST');
        self::$_PUT         = Input::parse('PUT');
        self::$_DELETE      = Input::parse('DELETE');
        self::$_OPTIONS     = Input::parse('OPTIONS');
        self::$_TRACE       = Input::parse('TRACE');
        self::$_CONNECT     = Input::parse('CONNECT');
        self::$_HEAD        = Input::parse('HEAD');

        self::$controller   = Text::studlyCaps(self::param('controller'));
        self::$action       = Text::camelCase(self::param('action'));

        $class = 'Controllers\\'.self::$controller;
        $action = self::$method.'_'.self::$action;

        $controller = new $class();

        // If the action doesn't exist, it's a 404
        if (!method_exists($controller, $action) AND !method_exists($controller, $action = 'REQUEST_'.self::$action)) {
            return FALSE;
        } else {
            // Call middlewares
            // TODO

            // Call controller
            $controller->before();
            $controller->{$action}();
            $controller->after();

            return TRUE;
        }
    }

    public static function param ($name, $default = NULL) {
        return isset(self::$_params[$name]) ? self::$_params[$name] : (isset(self::$_defaults[$name]) ? self::$_defaults[$name] : $default);
    }

    public static function isAjax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }
}
