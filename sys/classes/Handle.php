<?php

namespace Koz;

class Handle {
    public static function error($code, $error = '', $file = '', $line = '') {
        if (error_reporting() AND $code) {
            // This error is not suppressed by current error reporting settings
            // Convert the error into an Exception
            throw new \Koz\Exception($error, $file, $line);
        }

        // Do not execute the PHP error handler
        return true;
    }

    public static function shutdown() {
        if ($error = error_get_last()) {
            // Clean the output buffer
            ob_get_level() AND ob_clean();

            // Fake an exception for nice debugging
            $e = new \Koz\Exception($error['message'], $error['file'], $error['line']);
            echo $e->render();

            // Shutdown now to avoid a "death loop"
            exit(1);
        }
    }
}
