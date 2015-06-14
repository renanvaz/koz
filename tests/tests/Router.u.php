<?php

use \ULib\U;
use \Koz\Router;
use \Helpers\Debug;

// U::group('Test "Router::set" function.', "Router::set('default', 'test/uri')", function(){
//     $uri = 'test/uri';
//     Router::set('default', $uri);

//     U::assert('The uri for get "default" route must be "'.$uri.'"', Router::get('default') === $uri);
// });

U::group('Test "Router::get" function.', "Router::get('default', ['controller' => 'user', 'action' => 'list'])", function(){
    Router::set('default', '(:controller(/:action(/:id)))');

    U::assert('The uri for get "default" route must be "user/list/123"', Router::get('default', ['controller' => 'user', 'action' => 'list', 'id' => 123]) === 'user/list/123');
    //U::assert('The uri for get "default" route must be "user/list"', Router::get('default', ['controller' => 'user', 'action' => 'list']) === 'user/list');
    //U::assert('The uri for get "default" route must be "user"', Router::get('default', ['controller' => 'user']) === 'user');

    Router::set('default', '(:controller(/:action/:id))');
    //$uri = Router::get('default', ['controller' => 'user', 'action' => 'list']);

    //echo Debug::vars($uri);

    U::assert('The uri for get "default" route must be "user/list"', $uri === 'user/list');
});

U::group('Test "Router::parse" function.', 'Router::parse(string $uri)', function(){
    Router::set('default', 'test/uri');
    U::assert('The uri for get "default" route must be "user/list"', Router::get('default') === 'user/list');
});

// U::group('Router::add(\'default\', \'(:controller(/:action(/:id)))\');', function(){
//     Router::add('default', '(:controller(/:action(/:id)))');

//     U::group('Test parser function (Router::parse) with URI "controller/action/param".', function(){
//         $info = Router::parse('controller/action/param');

//     });

//     U::group('Test parser function (Router::parse) with URI "controller/action/param".', function(){
//         $info = Router::parse('controller/action/param');

//     });

//     U::assert('The route matched name must be "default"', $info['route'] === 'default');
//     U::assert('The URI param must be "controller/action/param"', $info['uri'] === 'controller/action/param');
//     U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'test' AND $info['defaults']['action'] === 'index');
//     U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "param"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === 'param');
// });

// U::group('Router::add(\'default\', \'(:controller(/:action(/:id)))\', [\'controller\' => \'test\', \'action\' => \'index\']);', function(){
//     Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'user', 'action' => 'index']);
//     $info = Router::parse('controller/action/param');

//     U::assert('The route matched name must be "default"', $info['route'] === 'default');
//     U::assert('The URI param must be "controller/action/param"', $info['uri'] === 'controller/action/param');
//     U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'user' AND $info['defaults']['action'] === 'index');
//     U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "param"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === 'param');
// });

// U::group('Add a rule for the ":id" param to accept only numbers "[0-9]+".', function(){
//     Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'test', 'action' => 'index'], ['id' => '[0-9]+']);
//     $info = Router::parse('controller/action/param');

//     U::assert('The route should not pass', $info === false);
// });

// U::group('Test parser function (Router::parse) with URI "controller/action/123".', function(){
//     U::group('Set the route matcher to "(:controller(/:action(/:id)))".', function(){
//         Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'test', 'action' => 'index']);
//         $info = Router::parse('controller/action/123');

//         U::assert('The route matched name must be "default"', $info['route'] === 'default');
//         U::assert('The URI param must be "controller/action/123"', $info['uri'] === 'controller/action/123');
//         U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'test' AND $info['defaults']['action'] === 'index');
//         U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "param"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === '123');

//         U::group('Add a rule for the ":id" param to accept only numbers "[0-9]+".', function(){
//             Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'test', 'action' => 'index'], ['id' => '[0-9]+']);
//             $info = Router::parse('controller/action/123');

//             U::assert('The route matched name must be "default"', $info['route'] === 'default');
//             U::assert('The URI param must be "controller/action/123"', $info['uri'] === 'controller/action/123');
//             U::assert('The DEFAULTS param must contain: Controller as "test" and Action as "index"', $info['defaults']['controller'] === 'test' AND $info['defaults']['action'] === 'index');
//             U::assert('The PARAMS param must contain: Controller as "controller", Action as "action" and ID as "123"', $info['params']['controller'] === 'controller' AND $info['params']['action'] === 'action' AND $info['params']['id'] === '123');
//         });
//     });
// });
