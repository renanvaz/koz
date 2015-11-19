<?php

namespace Koz;

use \Koz\Route;
use \Helpers\Debug;

class Router {
    const REGEX_VALID_CHARACTERS = '[a-zA-Z0-9_-]+';

    static private $_routes = [];

    /**
     * Set a new route to math URI
     *
     * @param string $name The alias of URI
     * @param string $route The URI mather
     * @param array $defaults The defaults values of params variables
     * @param array $rules - Regex rules for match acceptable values for params on URI
     * @return \Koz\Route
     *
     * @example Router::set('default', ':controller/:action(/:id)', ['id' => '[0-9]+'])->defaults(['controller' => 'teste', 'action' => 'index']);
     */
    static public function set($name, $route, array $rules = [])
    {
        return self::$_routes[$name] = new Route($route, $rules);
    }

    /**
     * Get the route URI
     *
     * @param string $name The alias of URI
     * @param array $defaults The defaults values of params variables
     *
     * @example Route::get('default', ['controller' => 'teste', 'action' => 'index']);
     */
    static public function get($name, array $params = [])
    {
        return self::$_routes[$name]->get($params);
    }

    /**
     * Parse URL and call the controller and action
     *
     * @param string $uri The uri to parse
     *
     * @example Router::parse('uri/segment');
     */
    static public function parse($uri)
    {
        $defaultRegex = self::REGEX_VALID_CHARACTERS;

        foreach (self::$_routes as $name => $data) {
            $route = $data['route'];
            $rules = $data['rules'];
            $defaults = $data['defaults'];
            $regex = '!^'.preg_replace_callback('!:('.$defaultRegex.')!', function($matches) use ($rules, $defaultRegex) { return '(?P<'.$matches[1].'>'.(\Helpers\Arr::get($rules, $matches[1], $defaultRegex)).')'; }, preg_replace('!\)!', ')?', $route)).'$!';

            if (preg_match($regex, $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_int($key)) {
                        unset($matches[$key]);
                    }
                }

                return ['route' => $name, 'uri' => $uri, 'params' => $matches, 'defaults' => $defaults];
            }
        }

        return FALSE;
    }
}
