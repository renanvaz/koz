<?php

namespace Koz;

use \Koz\DataText;

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

        return new DataText(include Core::find('configs/messages/'.$lang.'/'.$filename), true);
    }
}
