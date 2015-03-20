<?php

namespace Koz;

use \Helpers\Arr;

class Input {
    public static function GET($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_GET;
        } else {
            return Arr::get(Request::$_GET, $key, $default);
        }
    }

    public static function POST($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_POST;
        } else {
            return Arr::get(Request::$_POST, $key, $default);
        }
    }

    public static function PUT($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_PUT;
        } else {
            return Arr::get(Request::$_PUT, $key, $default);
        }
    }

    public static function DELETE($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_DELETE;
        } else {
            return Arr::get(Request::$_DELETE, $key, $default);
        }
    }

    public static function OPTIONS($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_OPTIONS;
        } else {
            return Arr::get(Request::$_OPTIONS, $key, $default);
        }
    }

    public static function TRACE($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_TRACE;
        } else {
            return Arr::get(Request::$_TRACE, $key, $default);
        }
    }

    public static function CONNECT($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_CONNECT;
        } else {
            return Arr::get(Request::$_CONNECT, $key, $default);
        }
    }

    public static function HEAD($key = NULL, $default = NULL) {
        if (is_null($key)) {
            return Request::$_HEAD;
        } else {
            return Arr::get(Request::$_HEAD, $key, $default);
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
