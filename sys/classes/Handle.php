<?php

namespace Koz;

class Handle {
    public static function exception ($e) {
        $message    = $e->getMessage();
        $file       = $e->getFile();
        $line       = $e->getLine();
        $trace      = str_replace(['#', '\n'], ['<p>#', '</p>'], $e->getTraceAsString());
        $snippet    = '';

        $handle = fopen($file, 'r');

        if ($handle) {
            $l = 1;
            $numLines = 4;
            $pad = strlen($line);

            while (($fileline = fgets($handle)) !== false) {
                if ($l >= $line-$numLines AND $l <= $line+$numLines) {
                    $snippet .= '<p'.($l == $line ? ' class="highlight"' : '').'><span>'.$l.'</span>'.str_replace(['\n', ' ', '\t'], ['\n', '&nbsp;', '&nbsp;&nbsp;&nbsp;&nbsp;'], htmlentities($fileline)).'</p>';
                }
                $l++;
            }
        }

        fclose($handle);

        Response::status(500);
        Response::body(View::make('errors/debug', ['message' => $message, 'file' => str_replace(PRIVATE_PATH, '', $file), 'line' => $line, 'snippet' => $snippet, 'trace' => $trace])->render());
        echo Response::render();
    }

    public static function error($code, $error = '', $file = '', $line = '') {
        if (error_reporting() AND $code) {
            // This error is not suppressed by current error reporting settings
            // Convert the error into an Exception
            throw new Exception($error, $file, $line);
        }

        // Do not execute the PHP error handler
        return true;
    }

    public static function shutdown() {
        if ($error = error_get_last()) {
            // Clean the output buffer
            ob_get_level() AND ob_clean();

            // Fake an exception for nice debugging
            self::exception(new Exception($error['message'], $error['file'], $error['line']));

            // Shutdown now to avoid a "death loop"
            exit(1);
        }
    }
}
