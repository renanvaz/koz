<?php

namespace \Koz\Helpers;

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
