<?php

use \ULib\U;

U::group('Test parser function (Router::parse) with URI "controller/action/param?get=test".', function(){
    $_SERVER['SCRIPT_NAME'] = '';
    $_SERVER['QUERY_STRING'] = '';
    $_SERVER['REQUEST_URI'] = '';

    //\Koz\Core::init();

    Koz\Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'test', 'action' => 'index']);

    //$info = \Koz\Router::parse('controller/action/param?get=test');

    // die(\Helpers\Debug::vars($info));

    U::assert('The URI param must be "controller/action/param?get=test"', $info['uri'] === 'controller/action/param?get=test');
    U::assert('The METHOD param must be "GET"', $info['method'] === 'GET');
    U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'test' AND $info['defaults']['action'] === 'index');
    U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "param"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === 'param');
});
