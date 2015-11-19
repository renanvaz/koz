<?php

namespace Koz;

use \Koz\Router;

class Route {
    private $route;
    private $rules;
    private $defaults;

    public function __construct($route, array $rules = [])
    {
        $this->route = $route;
        $this->rules = $rules;
    }

    public function defaults(array $defaults = [])
    {
        $this->defaults = $defaults;
    }

    /**
     * Get the route URI
     *
     * @param string $name The alias of URI
     * @param array $defaults The defaults values of params variables
     *
     * @example Route::get(['controller' => 'teste', 'action' => 'index']);
     */
    static public function get(array $params = [])
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
