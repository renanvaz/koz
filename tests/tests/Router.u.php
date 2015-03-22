<?php

use \ULib\U;
use \Koz\Router;
use \Helpers\Debug;

U::group('Test parser function (Router::parse) with URI "controller/action/param?get=test".', function(){
    Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'test', 'action' => 'index']);
    $info = Router::parse('controller/action/param');

    U::assert('The URI param must be "controller/action/param"', $info['uri'] === 'controller/action/param');
    U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'test' AND $info['defaults']['action'] === 'index');
    U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "param"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === 'param');
});
