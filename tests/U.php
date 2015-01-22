<?php

require_once 'UCore.php';

class U {
    public static $_reports = ['reports' => []];
    private static $_pointer;

    /**
     * Init the U pointer
     * @return void
     */
    public static function init () {
        self::$_pointer = &self::$_reports;
    }

    /**
     * Register status of test
     * @param  string $description
     * @param  boolean $status
     * @return void
     */
    public static function assert ($description, $status) {
        $report = [
            'description' => $description,
            'status' => $status
        ];

        if ($status === FALSE) {
            $report['trace'] = debug_backtrace()[0];
        }

        self::$_pointer['reports'][] = $report;
    }

    /**
     * Create a group (or a sub group) of asserts with a description
     * @param  string $description
     * @param  function $fn
     * @return void
     */
    public static function group ($description, $fn) {
        $newGroup = ['description' => $description, 'reports' => []];
        $pointer = &self::$_pointer;

        self::$_pointer = &$newGroup;
        $pointer['reports'][] = &self::$_pointer;

        $fn();

        self::$_pointer = &$pointer;
    }
}
