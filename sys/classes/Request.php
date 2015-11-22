<?php

namespace Koz;

use \Koz\Router;
use \Helpers\Text;
use \Helpers\Arr;
use \Helpers\Debug;

// isMobile
// isIOS
// isAndroid
// isAjax

class Request
{
    private static $_params;
    private static $_vars; // Request method vars: $_GET, $_POST...
    private static $_server; // Request server vars: $_SERVER

    public static $route;
    public static $uri;
    public static $method;
    public static $controller;
    public static $action;

    public static function make($method, $uri)
    {
        self::$method      = $method;
        self::$uri         = $uri;

        if ($info = Route::matcher($uri)) {
            self::$_params      = $info['params'];
            self::$route        = $info['route'];

            self::$_vars        = [
                'GET'          => Input::parse('GET'),
                self::$method => Input::parse(self::$method),
            ];

            self::$controller   = Text::studlyCaps(self::param('controller'));
            self::$action       = Text::camelCase(self::param('action'));

            $class = 'Controllers\\'.self::$controller;
            $action = self::$method.'_'.self::$action;

            // Check if the Controller has a action for this request
            if (method_exists($class, $action) OR method_exists($class, $action = 'REQUEST_'.self::$action)) {
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

    // Helpers
    public static function input($type)
    {
        return Arr::get(self::$_vars, $type, []);
    }

    public static function param($name, $default = NULL)
    {
        return Arr::get(self::$_params, $name, $default);
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
