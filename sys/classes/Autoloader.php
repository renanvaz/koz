<?php

namespace Koz;

class Autoloader {
    public static function autoload($className) {
        $className = ltrim($className, '\\');
        $fileName  = 'classes'.DIRECTORY_SEPARATOR;
        $namespace = '';

        // If the namespace starts with Koz\, use the system classes path
        if (strrpos($className, 'Koz\\') === 0) {
            $className = substr($className, 4); // Remove the Koz\
            $fileName = SYS_PATH.$fileName;
        }

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className);

        // Require file only if it exists. Else let other registered autoloaders worry about it.
        if (file_exists($fileName.'.php')) {
            require $fileName.'.php';
        } else if ($fileName = Core::find($fileName)) {
            require $fileName;
        }
    }

    public static function register() {
        spl_autoload_register(__NAMESPACE__.'\\Autoloader::autoload');
    }
}
