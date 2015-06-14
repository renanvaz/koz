<?php

namespace Koz;

use \Helpers\Arr;

class Input {
    public static function GET($key = NULL, $default = NULL) {
        $_GET = Request::input('GET');

        if (is_null($key)) {
            return $_GET;
        } else {
            return Arr::get($_GET, $key, $default);
        }
    }

    public static function POST($key = NULL, $default = NULL) {
        $_POST = Request::input('POST');

        if (is_null($key)) {
            return $_POST;
        } else {
            return Arr::get($_POST, $key, $default);
        }
    }

    public static function PUT($key = NULL, $default = NULL) {
        $_PUT = Request::input('PUT');

        if (is_null($key)) {
            return $_PUT;
        } else {
            return Arr::get($_PUT, $key, $default);
        }
    }

    public static function DELETE($key = NULL, $default = NULL) {
        $_DELETE = Request::input('DELETE');

        if (is_null($key)) {
            return $_DELETE;
        } else {
            return Arr::get($_DELETE, $key, $default);
        }
    }

    public static function OPTIONS($key = NULL, $default = NULL) {
        $_OPTIONS = Request::input('OPTIONS');

        if (is_null($key)) {
            return $_OPTIONS;
        } else {
            return Arr::get($_OPTIONS, $key, $default);
        }
    }

    public static function TRACE($key = NULL, $default = NULL) {
        $_TRACE = Request::input('TRACE');

        if (is_null($key)) {
            return $_TRACE;
        } else {
            return Arr::get($_TRACE, $key, $default);
        }
    }

    public static function CONNECT($key = NULL, $default = NULL) {
        $_CONNECT = Request::input('CONNECT');

        if (is_null($key)) {
            return $_CONNECT;
        } else {
            return Arr::get($_CONNECT, $key, $default);
        }
    }

    public static function HEAD($key = NULL, $default = NULL) {
        $_HEAD = Request::input('HEAD');

        if (is_null($key)) {
            return $_HEAD;
        } else {
            return Arr::get($_HEAD, $key, $default);
        }
    }

    public static function RAW() {
        return file_get_contents('php://input');
    }

    public static function parse($type) {
        if ($type === 'GET') {
            return $_GET;
        } elseif ($type === 'POST') {
            return $_POST; // Use parsed cached
        } elseif (Request::$method === $type) {
            parse_str(self::RAW(), $_type);

            return $_type;
        } else {
            return [];
        }
    }
}
