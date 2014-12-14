<?php
class U {
    private $_reports = [];

    public static function assert($description, $status) {
        $report = [
            'description' => $description,
            'status' => $status
        ];

        if ($status === false) {
            echo '<pre>';
            die(print_r(debug_backtrace));
            $report['trace'] = '';
        }

        self::$_reports[] = $report;
    }
}
