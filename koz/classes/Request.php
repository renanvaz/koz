<?php

namespace Koz;

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

    public static $method;
    public static $controller;
    public static $action;


    public static function make($method, $uri, array $params = [], array $defaults = [])
    {
        self::$method       = $method;
        self::$_uri         = $uri;
        self::$_params      = $params;
        self::$_defaults    = $defaults;
        self::$_defaults    = $defaults;
        self::$_vars        = [
            'GET'       => Input::parse('GET'),
            'POST'      => Input::parse('POST'),
            'PUT'       => Input::parse('PUT'),
            'DELETE'    => Input::parse('DELETE'),
            'OPTIONS'   => Input::parse('OPTIONS'),
            'TRACE'     => Input::parse('TRACE'),
            'CONNECT'   => Input::parse('CONNECT'),
            'HEAD'      => Input::parse('HEAD'),
        ];

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
