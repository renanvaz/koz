<?php

namespace Koz;

class Config {
    public static function get ($path, $default) {
        return Arr::path($array, $path, $default);
    }
}
