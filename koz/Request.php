<?php

namespace Koz;

use \Koz\Helpers\Text;
use \Koz\Helpers\Debug;

class Request {
    private static $_uri;
    private static $_params;
    private static $_defaults;

    public static $method;
    public static $controller;
    public static $action;

    public static function init ($uri, $method, $defaults, $params) {
        header('Content-type: text/html; charset='.Core::$charset);

        self::$_uri          = $uri;
        self::$_params       = $params;
        self::$_defaults     = $defaults;
        self::$method       = $method;
        self::$controller   = Text::studlyCase(self::param('controller'));
        self::$action       = Text::camelCase(self::param('action'));

        $class = '\App\Controllers\\'.self::$controller;

        $controller = new $class();

        $action = self::$method.'_'.self::$action;

        // If the action doesn't exist, it's a 404
        if (!method_exists($controller, $action)) {
            $action = 'REQUEST_'.self::$action;

            if (!method_exists($controller, $action)) {
                // throw HTTP_Exception::factory(404,
                //     'The requested URL :uri was not found on this server.',
                //     [':uri' => self::request->uri()]
                // )->request(self::request);
            }
        }

        $controller->{$action}();
    }

    public static function param ($name, $default = NULL) {
        return isset(self::$_params[$name]) ? self::$_params[$name] : (isset(self::$_defaults[$name]) ? self::$_defaults[$name] : $default);
    }
}
