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
 * Set the application Env.
 */
Koz\Core::$env = constant('KOZ::'.strtoupper($_SERVER['ENV']));

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Koz\Core::modules(array(
	// 'auth'       => MOD_PATH.'auth',       // Basic authentication
	// 'cache'      => MOD_PATH.'cache',      // Caching with multiple backends
	// 'database'   => MOD_PATH.'database',   // Database access
	// 'orm'        => MOD_PATH.'orm',        // Object Relationship Mapping
	// 'image'      => MOD_PATH.'image',      // Image manipulation
));
