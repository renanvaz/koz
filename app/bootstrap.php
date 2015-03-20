<?php

/**
 * Set the default time zone.
 *
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'pt_BR.utf-8');

/**
 * Set the default i18n language.
 */
Koz\Messages::$lang = 'pt-br';

/**
 * Set the application ENV.
 * Values accepts:
 *     KOZ\Env::PRODUCTION
 *     KOZ\Env::STAGING
 *     KOZ\Env::TESTING
 *     KOZ\Env::DEVELOPMENT
 */
Koz\Core::$env = constant('Koz\Env::'.strtoupper($_SERVER['ENV']));

/**
 * Enable modules.
 */
Koz\Core::modules([
    'helpers',          // Helpers community maintained.
    'tests',            // Koz unit tests, access by the URI /tests.
    //'auth',           // Basic authentication.
    // 'cache',         // Caching with multiple backends.
    // 'database',      // Database access.
    // 'orm',           // Object Relationship Mapping.
    // 'image',         // Image manipulation.
]);

/**
 * Set the application Env.
 * @param: string $name - A alias for a route
 * @param: string $routeMatch - A regexpr to math the route
 * @param: array $defaultValues - Default values for missing parameters on the URI
 * @param: array $paramRules - Regex rules for match acceptable values for params on URI
 */
Koz\Router::add('default', '(:controller(/:action(/:id)))', ['controller' => 'home', 'action' => 'index'], ['id' => '[0-9]+']);


/*
Koz\Router::add('name')
        ->match('(:controller(/:action(/:id)))')
        ->defaults(['controller' => 'home', 'action' => 'index'])
        ->rules(['id' => '[0-9]+']));

Koz\Router::add('name', '(:controller(/:action(/:id)))')
        ->defaults(['controller' => 'home', 'action' => 'index'])
        ->rules(['id' => '[0-9]+']));
 */
