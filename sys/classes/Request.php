<?php

namespace Koz;

use \Koz\Router;
use \Helpers\Text;
use \Helpers\Debug;

// isMobile
// isIOS
// isAndroid
// isAjax

class Request
{
    private static $_uri;
    private static $_params;
    private static $_defaults;
    private static $_vars; // Request method vars: $_GET, $_POST...
    private static $_server; // Request server vars: $_SERVER

    private static $_method;
    private static $_controller;
    private static $_action;

    public static function make($method, $uri)
    {
        self::$_method      = $method;
        self::$_uri         = $uri;

        define('Request::METHOD', $method);

        if ($info = Router::parse($uri)) {
            self::$_params      = $info['params'];
            self::$_defaults    = $info['defaults'];

            self::$_vars        = [
                'GET'          => Input::parse('GET'),
                self::$_method => Input::parse(self::$_method),
            ];

            self::$_controller   = Text::studlyCaps(self::param('controller'));
            self::$_action       = Text::camelCase(self::param('action'));

            $class = 'Controllers\\'.self::$_controller;
            $action = self::$method.'_'.self::$_action;

            // Check if the Controller has a action for this request
            if (method_exists($controller, $action) OR method_exists($controller, $action = 'REQUEST_'.self::$_action)) {
                // TODO: Call before middlewares

                $controller = new $class();

                // Call controller
                $controller->before();
                $controller->{$action}();
                $controller->after();

                // TODO: Call before middlewares
            } else {
                Response::status(404);
                Response::body(View::make('errors/404')->render());
            }
        } else {
            Response::status(404);
            Response::body(View::make('errors/404')->render());
        }
    }

    // Return data readonly
    public static function method()
    {
        return self::$_method;
    }

    public static function controller()
    {
        return self::$_controller;
    }

    public static function action()
    {
        return self::$_action;
    }

    // Helpers
    public static function input($type)
    {
        return isset(self::$_vars[$type]) ? self::$_vars[$type] : [];
    }

    public static function param($name, $default = NULL)
    {
        return isset(self::$_params[$name]) ? self::$_params[$name] : (isset(self::$_defaults[$name]) ? self::$_defaults[$name] : $default);
    }

    public static function isHTTPS()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    }

    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }
}
