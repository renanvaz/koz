<?php

namespace Koz;

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
     * @param: array $rules - Regex rules for match acceptable values for params on URI
     *
     * @example Router::set('default', ':controller/:action(/:id)', ['controller' => 'teste', 'action' => 'index'], ['id' => '[0-9]+']);
     */
    static public function set($name, $route, array $defaults = [], array $rules = [])
    {
        self::$_routes[$name] = [
            'route'     => $route,
            'defaults'  => $defaults,
            'rules'     => $rules,
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
    static public function get($name, array $params = [])
    {
        $uri = self::$_routes[$name]['route'];

        $uriParams = [];
        $uriParamsOptionals = [];

        $groups = [];

        self::getGroups($uri, $groups);

        print_r($groups);

        preg_replace_callback('!:('.self::REGEX_VALID_CHARACTERS.')!', function($matches) use (&$uriParams) { $uriParams[] = $matches[1]; }, $uri);

        $uriParamsMissing = array_diff($uriParams, array_keys($params));

        //echo Debug::vars($uriParamsMissing);

        foreach ($uriParamsMissing as $value) {
            // Fazer aceitar sem o "/"
            if (strpos($uri, '(/:'.$value) === false) {
                throw new \Exception('Missing param "'.$value.'"');
            }
        }

        foreach ($params as $key => $value) {
           $uri = preg_replace('!:'.$key.'!', $value, $uri);
        }

        foreach ($params as $key => $value) {
           $uri = preg_replace('!:'.$key.'!', $value, $uri);
        }

        return $uri;
    }

    static private function getGroups($uri, &$groups) {

        $match = preg_replace('!(^\(|\)$)!', '', preg_replace('![^\(]*(\(.+\))[^\)]*!', '$1', $uri));

        if (strpos($match, '(') !== false) {
            $groups[] = $match;
            self::getGroups($match, $groups);
        } else {
            $groups[] = $match;
        }
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
