<?php

namespace Koz;

class Server {
    public static function get ($key) {
        if (isset($_SERVER[$key])) {
            switch ($key) {
                case '':
                    return $_SERVER[$key];
                break;
                default:
                    return $_SERVER[$key];
                break;
            }
        } else {
            // Throw error
            return FALSE;
        }
    }
}
