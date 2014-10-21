<?php

namespace Koz;

class Messages {
    /**
     * Default lang set on bootstrap file
     */
    public static $lang;

    /**
     * Cache of config data
     */
    private static $_cached = [];

    /**
     * Default lang set on bootstrap file
     */
    public static function get ($filename, $key, $lang = NULL) {
        $lang OR $lang = self::$lang;

        if (!isset($_cached[$lang])) {
            $_cached[$lang] = Config::load('messages/'.$lang.'/'.$filename);
        }

        return $_cached[$lang]->get($key);
    }
}
