<?php

namespace \Koz\Helpers;

/**
 * Array helper.
 */
class Arr {

    /**
     * @var  string  default delimiter for path()
     */
    public static $delimiter = '.';

    /**
     * Retrieve a single key by path string from an array. If the key does not exist in the
     * array, the default value will be returned instead.
     *
     *     // Get the value "user.name" from $array, if it exists
     *     $username = Arr::get($array, 'user.name');
     *
     * @param   array   $array      array to search
     * @param   mixed   $path       key path string (delimiter separated)
     * @param   mixed   $default    default value if the path is not set
     * @return  mixed
     */
    public static function get($array, $path, $default = NULL) {
        $path = explode(self::$delimiter, $path);

        foreach($path as $key) {
            if (isset($array[$key])) {
                $array = $array[$key];
            } else {
                return $default;
            }
        }

        return $array;
    }

    /**
     * Set a key by path string to an array. If the key does not exist in the
     * array, it will be created.
     *
     *     Arr::set($array, 'user.name', 'Test');
     *
     * @param   array   $array      array to search
     * @param   mixed   $path       key path string (delimiter separated)
     * @param   mixed   $value
     * @return  void
     */
    public static function set(&$array, $path, $value) {
        $path = explode(self::$delimiter, $path);
        $len = count($path) -1;

        foreach($path as $i => $key) {
            if ($i < $len) {
                if (!isset($pointer[$key])) {
                    $array[$key] = [];
                }

                $array = &$array[$key];
            } else {
                $array[$key] = $value;
            }
        }
    }
}
