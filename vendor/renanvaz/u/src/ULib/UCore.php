<?php

namespace ULib;

class UCore {
    /**
     * Reset the report and pointer
     * @return void
     */
    public static function reset () {
        U::reset();
    }

    /**
     * Load a file with tests and create a group for this
     * @param  string $file Filename relative or absolute
     * @return void
     */
    public static function load ($file) {
        if (file_exists($file)) {
            U::group('Test '.$file, function () use ($file) {
                require($file);
            });
        } else {
            throw new \Exception('Error on loading "'.$file.'" file.');
        }
    }

    /**
     * Get test result in a boolean status
     * @return boolean
     */
    public static function getBool () {
        return !U::getReport()['summary']['asserts']['nok'];
    }

    /**
     * Get test result in a JSON string
     * @return string
     */
    public static function getJSON () {
        return json_encode(U::getReport());
    }
}
