<?php

namespace Koz;

class Messages {
    /**
     * Default lang set on bootstrap file
     */
    public static $lang;

    /**
     * Load the config message file for the selected lang
     * @param  string $filename
     * @param  string $lang
     * @return ConfigFile
     */
    public static function load($filename, $lang = NULL) {
        $lang OR $lang = self::$lang;

        return Config::load('messages/'.$lang.'/'.$filename);
    }
}


class Text {
    private static $_string = '';

    public static function parse(array $data){
        $string = self::$_string;

        foreach ($data as $key => $value) {
            $string = preg_replace('/'.$key.'/', $value, $string);
        }

        return $string;
    }
}
