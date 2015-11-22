<?php

namespace Koz;

use \Helpers\Arr;

class Input {
    public static function __callStatic($name, $arguments)
    {
        $name = strtoupper($name);
        $_VAR = Request::input($name);

        if (isset($arguments[0])) {
            $key     = $arguments[0];
            $default = isset($arguments[1]) ? $arguments[1] : NULL;

            return Arr::get($_VAR, $key, $default);
        } else {
            return $_VAR;
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
