<?php

namespace Koz;

class Autoloader {
    public static function autoload($className) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        // Require file only if it exists. Else let other registered autoloaders worry about it.
        if (file_exists(PRIVATE_PATH.$fileName)) {
            require PRIVATE_PATH.$fileName;
        }
    }

    public static function register() {
        spl_autoload_register(__NAMESPACE__ . '\\Autoloader::autoload');
    }
}
