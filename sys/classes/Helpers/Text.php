<?php

namespace Koz\Helpers;

/**
 * Text helper class. Provides simple methods for working with text.
 *
 * @package    \Koz\Helpers
 * @category   Helpers
 */
class Text {
    public static function uri(){
        // Implements
    }

    /**
     * Parse a string with variables notation
     * @param  string $string The text
     * @param  array  $data The variables to replace, where the key is the name (without ":") and the value is the replacement
     * @return string The text parsed
     */
    public static function parse($string, array $data){
        foreach ($data as $key => $value) {
            $string = preg_replace('/:'.$key.'/', $value, $string);
        }

        return $string;
    }

    /**
    * Convert strings with underscores into CamelCase
    *
    * @param    string $string The string to convert
    * @param    bool $first_char_caps camelCase or CamelCase
    * @return   string The converted string
    */
    public static function camelCase($string) {
        $string[0] = strtolower($string[0]);

        return preg_replace_callback('/[_-]([a-z])/', function ($c) { return strtoupper($c[1]); }, $string);
    }


    /**
    * Convert strings with underscores into StudlyCaps
    *
    * @param    string $string The string to convert
    * @param    bool $first_char_caps camelCase or CamelCase
    * @return   string The converted string
    */
    public static function studlyCaps($string) {
        $string = self::camelCase($string);
        $string[0] = strtoupper($string[0]);

        return $string;
    }


    /**
     * Converts a camel case phrase into a spaced phrase.
     *
     *     $str = Text::deCamelCase('houseCat');    // "house-cat"
     *     $str = Text::deCamelCase('kingAllyCat'); // "king-ally-cat"
     *
     * @param   string  $str    phrase to decamelCase
     * @param   string  $sep    word separator
     * @return  string
     */
    public static function deCamelCase($str, $sep = '-') {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1'.$sep.'$2', trim($str)));
    }
}
