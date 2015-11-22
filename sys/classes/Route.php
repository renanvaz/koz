<?php

namespace Koz;

use \Koz\Router;
use \Helpers\Arr;
use \Helpers\Debug;

class Route {
    const REGEX_VALID_CHARACTERS = '[a-zA-Z0-9_-]+';

    /**
     * List of all routes created
     * @var array
     */
    static private $_routes = [];

    /**
     * Set a new route to math URI
     *
     * @param string $name      The alias of URI
     * @param string $route     The URI mather
     * @param array $rules      Regex rules for match acceptable values for params on URI
     * @param array $defaults   The defaults values of params variables
     * @return \Koz\Route
     *
     * @example Route::set('default', ':controller/:action(/:id)', ['id' => '[0-9]+'])->defaults(['controller' => 'teste', 'action' => 'index']);
     */
    static public function set($name, $route, array $rules = [])
    {
        return self::$_routes[$name] = new Route($route, $rules);
    }

    /**
     * Get the route URI
     *
     * @param string $name The alias of route
     * @return Route
     *
     * @example Route::get('default');
     */
    static public function get($name)
    {
        return self::$_routes[$name];
    }

    /**
     * Parse URL and call the controller and action
     *
     * @param string $uri The URI to parse
     * @return bool
     *
     * @example Route::matcher('uri/segment');
     */
    static public function matcher($uri)
    {
        foreach (self::$_routes as $name => $route) {
            if ($params = $route->match($uri)) {
                return ['route' => $name, 'params' => $params];
            }
        }

        return FALSE;
    }

    /**
     * Schema of URI matcher
     * @var string
     */
    protected $_schema;

    /**
     * Rules of params in URI
     * @var array
     */
    protected $_rules = [];

    /**
     * Default values for missing params in URI
     * @var array
     */
    protected $_defaults = [];

    /**
     * Constructor class
     * @param string $schema    Schema of URI matcher
     * @param array  $rules     Rules of params in URI
     */
    public function __construct($schema, array $rules = [])
    {
        $this->_schema = $schema;
        $this->_rules = $rules;
    }

    /**
     * Seter of default values for missing params in URI
     * @param  array  $defaults
     * @return void
     */
    public function defaults(array $defaults = [])
    {
        $this->_defaults = $defaults;
    }

    /**
     * Verify if this route match the URI
     * @param  string $uri
     * @return void
     *
     * @example $route->match('uri/segment');
     */
    public function match($uri) {
        $defaultRegex = self::REGEX_VALID_CHARACTERS;

        $route      = $this->_schema;
        $rules      = $this->_rules;
        $defaults   = $this->_defaults;

        $regex = '!^'.preg_replace_callback('!:('.$defaultRegex.')!', function($matches) use ($rules, $defaultRegex) { return '(?P<'.$matches[1].'>'.(Arr::get($rules, $matches[1], $defaultRegex)).')'; }, preg_replace('!\)!', ')?', $route)).'$!';

        if (preg_match($regex, $uri, $matches)) {
            $params = array();

            foreach ($matches as $key => $value) {
                if (is_int($key)) {
                    continue;
                }

                $params[$key] = $value;
            }

            foreach ($defaults as $key => $value) {
                if (!isset($params[$key]) OR empty($params[$key])) {
                    $params[$key] = $value;
                }
            }

            return $params;
        }

        return false;
    }

    /**
     * Get the route scheme as URI
     *
     * @param array $defaults The defaults values of params variables
     * @return string The parsed URI
     *
     * @example $route->get(['controller' => 'teste', 'action' => 'index']);
     */
    static public function uri(array $params = [])
    {
        $uri = self::$_routes[$name]['route'];

        $uriParams = [];
        $uriParamsOptionals = [];
        $groups = [];

        self::getGroups($uri, $groups);

        print_r($groups);

        preg_replace_callback('!:('.Router::REGEX_VALID_CHARACTERS.')!', function($matches) use (&$uriParams) { $uriParams[] = $matches[1]; }, $uri);

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

        foreach ($uriParamsMissing as $key) {
            $uri = preg_replace('!(/:'.$key.')!', '', $uri);
        }

        return $uri;
    }

    static private function getGroups($uri, &$groups)
    {
        $match = preg_replace('!(^\(|\)$)!', '', preg_replace('![^\(]*(\(.+\))[^\)]*!', '$1', $uri));

        if (strpos($match, '(') !== false) {
            $groups[] = $match;
            self::getGroups($match, $groups);
        } else {
            $groups[] = $match;
        }
    }
}
