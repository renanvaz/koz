<?php

namespace Koz;

class Router {
    const REGEX_VALID_CHARACTERS     = '[a-zA-Z0-9_-]+';

    static private $_routes = [];

    /**
     * Add a new route to math URI
     *
     * @param string $name The alias of URI
     * @param string $route The URI mather
     * @param array $defaults The defaults values of params variables
     *
     * @example Router::add('default', ':controller/:action(/:id)', ['controller' => 'teste', 'action' => 'index']);
     */

    static public function add ($name, $route, Array $defaults = []) {
        self::$_routes[$name] = [
            'regex'    => preg_replace('!:('.self::REGEX_VALID_CHARACTERS.')!', '(?P<$1>'.self::REGEX_VALID_CHARACTERS.')', preg_replace('!\)!', ')?', $route)),
            'defaults' => $defaults,
        ];
    }

    /**
     * Parse URL and call the controller and action
     *
     * @param string $uri The uri to parse
     *
     * @example Router::parse('uri/segment');
     */

    static public function parse ($uri) {
        foreach (self::$_routes as $name => $data) {
            if (preg_match('!'.$data['regex'].'!', $uri, $matches)) {
                // Testar qual valor fica como default
                Request::init($uri, $_SERVER['REQUEST_METHOD'], $data['defaults'] + $matches);
                return TRUE;
            }
        }

        return FALSE;
    }
}
