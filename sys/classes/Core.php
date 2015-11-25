<?php

namespace Koz;

final class Core
{
    const VERSION  = '1.1.0';
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
        if (self::$debug) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL | E_STRICT);
        }

        if (function_exists('mb_internal_encoding')) {
            // Set the MB extension encoding to the same character set
            mb_internal_encoding(self::$charset);
        }

        if (function_exists('mb_substitute_character')) {
            mb_substitute_character('none');
        }

        // Set the default locale.
        setlocale(LC_ALL, self::$locale);

        // Set the default time zone.
        date_default_timezone_set(self::$timezone);

        // Set error handlers
        set_error_handler('\Koz\Handle::error');
        register_shutdown_function('\Koz\Handle::shutdown');

        // Get Base URL from SCRIPT_NAME
        self::$baseURL = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);

        // Get URI from REQUEST_URI
        $uri = preg_replace(['!'.self::$baseURL.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        try {
            Request::make($_SERVER['REQUEST_METHOD'], $uri);
        } catch (\Koz\Exception $e) {
            die('Koz Exception');
            // Response::status(500);
            // Response::body(View::make('errors/debug', ['message' => $message, 'file' => str_replace(PRIVATE_PATH, '', $file), 'line' => $line, 'snippet' => $snippet, 'trace' => $trace])->render());
        }

        echo Response::render();

        // Go back to the previous handlers
        restore_error_handler();
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

