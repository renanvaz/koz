<?php

namespace Koz;

class Input {
    public static GET ($key, $default = NULL) {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public static POST ($key, $default = NULL) {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public static PUT ($key, $default = NULL) {
        return isset($_PUT[$key]) ? $_PUT[$key] : $default;
    }

    public static DELETE ($key, $default = NULL) {
        return isset($_DELETE[$key]) ? $_DELETE[$key] : $default;
    }

    public static OPTIONS ($key, $default = NULL) {
        return isset($_OPTIONS[$key]) ? $_OPTIONS[$key] : $default;
    }

    public static TRACE ($key, $default = NULL) {
        return isset($_TRACE[$key]) ? $_TRACE[$key] : $default;
    }

    public static CONNECT ($key, $default = NULL) {
        return isset($_CONNECT[$key]) ? $_CONNECT[$key] : $default;
    }

    public static HEAD ($key, $default = NULL) {
        return isset($_HEAD[$key]) ? $_HEAD[$key] : $default;
    }
}
