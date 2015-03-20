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
     * @param: array $rules - Regex rules for match acceptable values for params on URI
     *
     * @example Router::add('default', ':controller/:action(/:id)', ['controller' => 'teste', 'action' => 'index'], ['id' => '[0-9]+']);
     */

    static public function add ($name, $route, Array $defaults = [], Array $rules = []) {
        $defaultRegex = self::REGEX_VALID_CHARACTERS;

        self::$_routes[$name] = [
            'regex'    => preg_replace_callback('!:('.$defaultRegex.')!', function($matches) use ($rules, $defaultRegex) { return '(?P<'.$matches[1].'>'.(\Helpers\Arr::get($rules, $matches[1], $defaultRegex)).')'; }, preg_replace('!\)!', ')?', $route)),
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
            if (preg_match('!^'.$data['regex'].'$!', $uri, $matches)) {
                // Testar qual valor fica como default
                return ['uri' => $uri, 'method' => $_SERVER['REQUEST_METHOD'], 'defaults' => $data['defaults'], 'params' => $matches];
            }
        }

        return FALSE;
    }
}
