<?php

namespace Koz;

class Response {
    public static function body ($body) {
        HTTP::header('Content-type', 'text/html; charset='.Core::$charset);
        die ($body);
    }

    public static function raw ($text) {
        HTTP::header('Content-type', 'text/plain; charset='.Core::$charset);
        die ($text);
    }

    public static function json (Array $data) {
        HTTP::header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        HTTP::header('Content-type', 'application/json; charset='.Core::$charset);
        die (json_encode($data));
    }

    public static function download ($file) {
        HTTP::header('Content-Description', 'File Transfer');
        HTTP::header('Content-Type', 'application/octet-stream');
        HTTP::header('Content-Disposition', 'attachment; filename="'.basename($file).'"');
        HTTP::header('Content-Transfer-Encoding', 'binary');
        HTTP::header('Connection', 'Keep-Alive');
        HTTP::header('Expires', '0');
        HTTP::header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        HTTP::header('Pragma', 'public');
        HTTP::header('Content-Length', filesize($file));

        readfile($file);

        die();
    }

    public static function file ($file, $content = FALSE) {
        // Implements
        die();
    }
}
