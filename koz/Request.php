<?php

namespace Koz;

class Request {
    private static $_uri;
    private static $_method;
    private static $_controller;
    private static $_action;
    private static $_params;
    private static $_defaults;

    public function __get ($v) {
        switch ($v) {
            case 'uri':
            case 'method':
            case 'controller':
            case 'action':
                return self::${'_'.$v};
            break;
            default:
                // Error
                return FALSE;
            break;
        }
    }

    public static function init ($uri, $method, $params, $defaults) {
        header('Content-type: text/html; charset='.Core::$charset);

        self::$_uri          = $uri;
        self::$_method       = $method;
        self::$_params       = $params;
        self::$_defaults     = $defaults;
        self::$_controller   = \Koz\Helpers\Text::studlyCase(self::param('controller'));
        self::$_action       = \Koz\Helpers\Text::camelCase(self::param('action'));

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
