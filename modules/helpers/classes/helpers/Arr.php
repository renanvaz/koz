<?php

namespace Koz\Helpers;

/**
 * Array helper.
 */
class Arr {

    /**
     * @var  string  default delimiter for path()
     */
    public static $delimiter = '.';

    /**
     * Gets a value from an array using a separated path.
     * @param   array   $array      array to search
     * @param   mixed   $path       key path string (delimiter separated)
     * @param   mixed   $default    default value if the path is not set
     * @return  mixed
     */
    public static function path($array, $path, $default = NULL) {
        try {
            $path = explode(self::$delimiter, $path);

            foreach($path as $key) {
                $array = $array[$key];
            }

            return $array;
        } catch (\ErrorException $e) {
            return $default;
        }
    }


    /**
     * Retrieve a single key from an array. If the key does not exist in the
     * array, the default value will be returned instead.
     *
     *     // Get the value "username" from $_POST, if it exists
     *     $username = Arr::get($_POST, 'username');
     *
     *     // Get the value "sorting" from $_GET, if it exists
     *     $sorting = Arr::get($_GET, 'sorting');
     *
     * @param   array   $array      array to extract from
     * @param   string  $key        key name
     * @param   mixed   $default    default value
     * @return  mixed
     */
    public static function get($array, $key, $default = NULL) {
        return isset($array[$key]) ? $array[$key] : $default;
    }

}
