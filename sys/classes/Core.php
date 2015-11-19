<?php

namespace Koz;

final class Core
{
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    public static $baseURL;

    public static $charset;
    public static $locale;
    public static $timezone;
    public static $env;
    public static $debug;

    private static $_modules = [];

    public static function init()
    {
        // Set error handlers
        set_error_handler('\Koz\Handle::error');
        set_exception_handler('\Koz\Handle::exception');
        register_shutdown_function('\Koz\Handle::shutdown');

        // Get Base URL from SCRIPT_NAME
        self::$baseURL = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);

        // Get URI from REQUEST_URI
        $uri = preg_replace(['!'.self::$baseURL.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        Request::make($_SERVER['REQUEST_METHOD'], $uri);
        echo Response::render();

        // Go back to the previous handlers
        restore_error_handler();
        restore_exception_handler();
    }

    public static function find($file)
    {
        $filename = APP_PATH.$file.'.php';

        if (file_exists($filename)) {
            return $filename;
        } else {
            // If file is not found in the APP path, search in the modules
            foreach (self::$_modules as $module) {
                $filename = MOD_PATH.$module.DIRECTORY_SEPARATOR.$file.'.php';

                if (file_exists($filename)) {
                    return $filename;
                }
            }

            // Not found
            return FALSE;
        }
    }

    public static function modules(array $list)
    {
        self::$_modules += $list;
    }
}

