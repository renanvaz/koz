<?php

namespace Koz;

class Assets {
    private $_assets = [
        'css'           => [],
        'css_external'  => [],
        'css_inline'    => [],
        'js'            => [],
        'js_external'   => [],
        'js_inline'     => [],
    ];

    /**
     * Add a file asset
     * @param String $type  Type of script and method to load.
     *                      Types accepted: css, css_external, css_inline, js, js_external, js_inline.
     * @param Array  $files List of files to be added, eg for js: ['vendor/plugin.js', 'main.js']
     *                      File path must start on the specific folder.
     *                          For css files the filename will be prepended with "public/assets/css/"
     *                          For js files the filename will be prepended with "public/assets/js/"
     */
    public static function add ($type, Array $files) {
        if (in_array($type, array_keys(self::$_assets))) {
            self::$_assets[$type] = array_merge(self::$_assets[$type], $files);
        }
    }

    /**
     * Remove a file asset
     * @param String $type  Type of script and method to load
     * @param Array  $files List of files to be removed
     */
    public static function remove ($type, Array $files) {
        if (in_array($type, array_keys(self::$_assets))) {
            foreach ($files as $file) {
                unset(self::$_assets[$type][array_search($file, self::$_assets[$type])]);
            }
        }
    }
}
