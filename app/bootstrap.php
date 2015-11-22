<?php

/**
 * Set the application ENV.
 * @var enum
 * Values accepts:
 *     KOZ\Env::PRODUCTION
 *     KOZ\Env::STAGING
 *     KOZ\Env::TESTING
 *     KOZ\Env::DEVELOPMENT
 */
Koz\Core::$env = Koz\Env::DEVELOPMENT;

/**
 * Enable debug errors
 * @var boolean
 */
Koz\core::$debug = Koz\Core::$env > KOZ\Env::PRODUCTION;

/**
 * Set the default charset.
 */
Koz\Core::$charset = 'utf-8';

/**
 * Set the default locale.
 * @var string or array value.
 *
 * Koz\Core::$locale = 'pt_BR.utf8';
 * Koz\Core::$locale = ['pt_BR.utf8', 'pt_BR.UTF-8'];
 *
 * @link http://www.php.net/manual/function.setlocale
 */
Koz\Core::$locale = 'pt_BR.utf8';

/**
 * Set the default time zone.
 * @var string
 *
 * @link http://www.php.net/manual/timezones
 */
Koz\Core::$timezone = 'America/Sao_Paulo';

/**
 * Set the default i18n language.
 * @var string
 */
Koz\Messages::$lang = 'pt-br';

/**
 * Enable modules.
 */
Koz\Core::modules([
    'helpers',          // Helpers community maintained.
    // 'tests',         // Koz unit tests, access by the URI /tests.
]);

/**
 * Set the application Env.
 * @param: string $name - A alias for a route
 * @param: string $routeMatch - A regexpr to math the route
 * @param: array $paramRules - Regex rules for match acceptable values for params on URI
 */
Koz\Route::set('default', '(:controller(/:action/:id))', ['id' => '[0-9]+'])
    ->defaults(['controller' => 'home', 'action' => 'index']);
