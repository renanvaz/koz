<?php

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
 * Set the default charset.
 */
Koz\Core::$charset = 'utf-8';

/**
 * Set the default locale.
 * Accepts string or array value.
 *
 * Koz\Core::$locale = 'pt_BR.utf8';
 * Koz\Core::$locale = ['pt_BR.utf8', 'pt_BR.UTF-8'];
 *
 * @link http://www.php.net/manual/function.setlocale
 */
Koz\Core::$locale = 'pt_BR.utf8';

/**
 * Set the default time zone.
 *
 * @link http://www.php.net/manual/timezones
 */
Koz\Core::$timezone = 'America/Sao_Paulo';

/**
 * Set the default i18n language.
 */
Koz\Messages::$lang = 'pt-br';

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
Koz\Router::set('default', '(:controller(/:action(/:id)))', ['controller' => 'home', 'action' => 'index'], ['id' => '[0-9]+']);
