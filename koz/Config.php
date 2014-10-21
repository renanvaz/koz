<?php

namespace Koz;

class Config {
    public static function load ($filename) {
        return new ConfigFile(include Core::find('configs/'.$filename));
    }
}

class ConfigFile {
    private $data;

    public function __construct (array $data) {
        $this->data = $data;
    }

    public function get ($path, $default = NULL) {
        return Helpers\Arr::path($this->data, $path, $default);
    }
}
