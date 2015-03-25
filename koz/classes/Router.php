<?php

namespace Koz;

class Router {
    const REGEX_VALID_CHARACTERS = '[a-zA-Z0-9_-]+';

    static private $_routes = [];

    /**
     * Set a new route to math URI
     *
     * @param string $name The alias of URI
     * @param string $route The URI mather
     * @param array $defaults The defaults values of params variables
     * @param: array $rules - Regex rules for match acceptable values for params on URI
     *
     * @example Router::set('default', ':controller/:action(/:id)', ['controller' => 'teste', 'action' => 'index'], ['id' => '[0-9]+']);
     */
    static public function set($name, $route, array $defaults = [], array $rules = [])
    {
        $defaultRegex = self::REGEX_VALID_CHARACTERS;

        self::$_routes[$name] = [
            'regex'    => preg_replace_callback('!:('.$defaultRegex.')!', function($matches) use ($rules, $defaultRegex) { return '(?P<'.$matches[1].'>'.(\Helpers\Arr::get($rules, $matches[1], $defaultRegex)).')'; }, preg_replace('!\)!', ')?', $route)),
            'defaults' => $defaults,
        ];
    }

    /**
     * Get the route URI
     *
     * @param string $name The alias of URI
     * @param array $defaults The defaults values of params variables
     *
     * @example Route::get('default', ['controller' => 'teste', 'action' => 'index']);
     */
    static public function get($name, $route, array $defaults = [], array $rules = [])
    {
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
    static public function parse ($uri)
    {
        foreach (self::$_routes as $name => $data) {
            if (preg_match('!^'.$data['regex'].'$!', $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_int($key)) {
                        unset($matches[$key]);
                    }
                }

                return ['route' => $name, 'uri' => $uri, 'params' => $matches, 'defaults' => $data['defaults']];
            }
        }

        return FALSE;
    }
}
