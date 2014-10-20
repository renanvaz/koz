<?php

namespace Koz;

class Core {
    const VERSION  = '1.0.0';
    const CODENAME = 'ão';

    public static $baseURL;
    public static $uri;
    public static $charset  = 'utf-8';
    public static $env      = Env::PRODUCTION;


    public static function instance () {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public static function init () {
        set_error_handler(array('\Koz\Core', 'handleError'));
        set_exception_handler(array('\Koz\Core', 'handleException'));

        if (function_exists('mb_internal_encoding')) {
            // Set the MB extension encoding to the same character set
            mb_internal_encoding(self::$charset);
        }

        if (function_exists('mb_substitute_character')) {
            mb_substitute_character('none');
        }

        $a = '<div attr="value">asdasd</div>'.(1/0);

        self::$baseURL = preg_replace('!/[^\./]+\.php$!', '/', $_SERVER['SCRIPT_NAME']);
        self::$uri = preg_replace(['!'.self::$baseURL.'!', '!\?'.$_SERVER['QUERY_STRING'].'!'], '', $_SERVER['REQUEST_URI']);

        // Set the defailt route to math all controllers and action
        Router::parse(self::$uri);

        // Go back to the previous handlers
        restore_error_handler();
        restore_exception_handler();
    }

    public static function handleException($e) {
        $type       = get_class($e);
        $code       = $e->getCode();
        $message    = $e->getMessage();
        $file       = $e->getFile();
        $line       = $e->getLine();
        $trace      = str_replace(array('#', '\n'), array('<p>#', '</p>'), $e->getTraceAsString());
        $snippet    = '';

        $handle = fopen($file, 'r');

        if ($handle) {
            $l = 1;
            $numLines = 4;
            $pad = strlen($line);

            while (($fileline = fgets($handle)) !== false) {
                if ($l >= $line-$numLines AND $l <= $line+$numLines) {
                    $snippet .= '<p'.($l == $line ? ' class="highlight"' : '').'><span>'.str_pad($l, $pad, '0', STR_PAD_LEFT).'</span>'.str_replace(['\n', ' ', '\t'], ['\n', '&nbsp;', '&nbsp;&nbsp;&nbsp;&nbsp;'], htmlentities($fileline)).'</p>';
                }
                $l++;
            }
        }

        fclose($handle);

        HTTP::status(500);
        Response::body(View::make('errors/debug', array('type' => $type, 'code' => $code, 'message' => $message, 'file' => $file, 'line' => $line, 'snippet' => $snippet, 'trace' => $trace))->render());
    }

    public static function handleError($code, $error = '', $file = '', $line = '') {
        if (error_reporting() AND $code) {
            // This error is not suppressed by current error reporting settings
            // Convert the error into an ErrorException
            throw new \ErrorException($error, $code, 0, $file, $line);
        }

        // Do not execute the PHP error handler
        return TRUE;
    }
}
