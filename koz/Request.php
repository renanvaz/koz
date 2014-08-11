<?php

namespace Koz;

class Request {
    private static $uri;
    private static $method;
    private static $controller;
    private static $action;
    private static $params;
    private static $defaults;

    public function __get ($v) {
        switch ($v) {
            case 'uri':
                return self::$uri;
            break;
            case 'method':
                return self::$method;
            break;
            case 'controller':
                return self::$controller;
            break;
            case 'action':
                return self::$action;
            break;
            default:
                // Error
                return FALSE;
            break;
        }
    }

    public static function init ($uri, $method, $params, $defaults) {
        self::$uri          = $uri;
        self::$method       = $method;
        self::$params       = $params;
        self::$defaults     = $defaults;
        self::$controller   = \Koz\Helpers\Text::studlyCase(self::param('controller'));
        self::$action       = \Koz\Helpers\Text::camelCase(self::param('action'));

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
        return isset(self::$params[$name]) ? self::$params[$name] : (isset(self::$defaults[$name]) ? self::$defaults[$name] : $default);
    }
}
