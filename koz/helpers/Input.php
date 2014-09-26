<?php

namespace Koz;

use Arr;

class Input {
    public static function GET ($key, $default = NULL) {
        return Arr::get($_GET, $key, $default);
    }

    public static function POST ($key, $default = NULL) {
        return Arr::get($_POST, $key, $default);
    }

    public static function PUT ($key, $default = NULL) {
        return Arr::get($_PUT, $key, $default);
    }

    public static function DELETE ($key, $default = NULL) {
        return Arr::get($_DELETE, $key, $default);
    }

    public static function OPTIONS ($key, $default = NULL) {
        return Arr::get($_OPTIONS, $key, $default);
    }

    public static function TRACE ($key, $default = NULL) {
        return Arr::get($_TRACE, $key, $default);
    }

    public static function CONNECT ($key, $default = NULL) {
        return Arr::get($_CONNECT, $key, $default);
    }

    public static function HEAD ($key, $default = NULL) {
        return Arr::get($_HEAD, $key, $default);
    }
}
