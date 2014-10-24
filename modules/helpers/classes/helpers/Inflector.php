<?php

namespace Helpers;

/**
 * Inflector helper class. Inflection is changing the form of a word based on
 * the context it is used in. For example, changing a word into a plural form.
 *
 * [!!] Inflection is only tested with English, and is will not work with other languages.
 */
class Inflector {

    /**
     * @var  array  cached inflections
     */
    protected static $cache = array();

    /**
     * @var  array  uncountable words
     */
    protected static $uncountable;

    /**
     * @var  array  irregular words
     */
    protected static $irregular;

    /**
     * Checks if a word is defined as uncountable. An uncountable word has a
     * single form. For instance, one "fish" and many "fish", not "fishes".
     *
     *     self::uncountable('fish'); // TRUE
     *     self::uncountable('cat');  // FALSE
     *
     * If you find a word is being pluralized improperly, it has probably not
     * been defined as uncountable in `config/inflector.php`. If this is the
     * case, please report [an issue](http://dev.kohanaphp.com/projects/kohana3/issues).
     *
     * @param   string  $str    word to check
     * @return  boolean
     */
    public static function uncountable($str) {
        if (self::$uncountable === NULL) {
            // Cache uncountables
            self::$uncountable = Koz->load('inflector')->uncountable;

            // Make uncountables mirrored
            self::$uncountable = array_combine(self::$uncountable, self::$uncountable);
        }

        return isset(self::$uncountable[strtolower($str)]);
    }

    /**
     * Makes a plural word singular.
     *
     *     echo self::singular('cats'); // "cat"
     *     echo self::singular('fish'); // "fish", uncountable
     *
     * You can also provide the count to make inflection more intelligent.
     * In this case, it will only return the singular value if the count is
     * greater than one and not zero.
     *
     *     echo self::singular('cats', 2); // "cats"
     *
     * [!!] Special inflections are defined in `config/inflector.php`.
     *
     * @param   string  $str    word to make singular
     * @param   integer $count  count of thing
     * @return  string
     * @uses    self::uncountable
     */
    public static function singular($str, $count = NULL) {
        // $count should always be a float
        $count = ($count === NULL) ? 1.0 : (float) $count;

        // Do nothing when $count is not 1
        if ($count != 1)
            return $str;

        // Remove garbage
        $str = strtolower(trim($str));

        // Cache key name
        $key = 'singular_'.$str.$count;

        if (isset(self::$cache[$key]))
            return self::$cache[$key];

        if (self::uncountable($str))
            return self::$cache[$key] = $str;

        if (empty(self::$irregular)) {
            // Cache irregular words
            self::$irregular = Kohana::$config->load('inflector')->irregular;
        }

        if ($irregular = array_search($str, self::$irregular)) {
            $str = $irregular;
        } elseif (preg_match('/us$/', $str)) {
            // http://en.wikipedia.org/wiki/Plural_form_of_words_ending_in_-us
            // Already singular, do nothing
        } elseif (preg_match('/[sxz]es$/', $str) OR preg_match('/[^aeioudgkprt]hes$/', $str)) {
            // Remove "es"
            $str = substr($str, 0, -2);
        } elseif (preg_match('/[^aeiou]ies$/', $str)) {
            // Replace "ies" with "y"
            $str = substr($str, 0, -3).'y';
        } elseif (substr($str, -1) === 's' AND substr($str, -2) !== 'ss') {
            // Remove singular "s"
            $str = substr($str, 0, -1);
        }

        return self::$cache[$key] = $str;
    }

    /**
     * Makes a singular word plural.
     *
     *     echo self::plural('fish'); // "fish", uncountable
     *     echo self::plural('cat');  // "cats"
     *
     * You can also provide the count to make inflection more intelligent.
     * In this case, it will only return the plural value if the count is
     * not one.
     *
     *     echo self::singular('cats', 3); // "cats"
     *
     * [!!] Special inflections are defined in `config/inflector.php`.
     *
     * @param   string  $str    word to pluralize
     * @param   integer $count  count of thing
     * @return  string
     * @uses    self::uncountable
     */
    public static function plural($str, $count = NULL) {
        // $count should always be a float
        $count = ($count === NULL) ? 0.0 : (float) $count;

        // Do nothing with singular
        if ($count == 1)
            return $str;

        // Remove garbage
        $str = trim($str);

        // Cache key name
        $key = 'plural_'.$str.$count;

        // Check uppercase
        $is_uppercase = ctype_upper($str);

        if (isset(self::$cache[$key]))
            return self::$cache[$key];

        if (self::uncountable($str))
            return self::$cache[$key] = $str;

        if (empty(self::$irregular)) {
            // Cache irregular words
            self::$irregular = Kohana::$config->load('inflector')->irregular;
        }

        if (isset(self::$irregular[$str])) {
            $str = self::$irregular[$str];
        } elseif (in_array($str, self::$irregular)) {
            // Do nothing
        } elseif (preg_match('/[sxz]$/', $str) OR preg_match('/[^aeioudgkprt]h$/', $str)) {
            $str .= 'es';
        } elseif (preg_match('/[^aeiou]y$/', $str)) {
            // Change "y" to "ies"
            $str = substr_replace($str, 'ies', -1);
        } else {
            $str .= 's';
        }

        // Convert to uppercase if necessary
        if ($is_uppercase) {
            $str = strtoupper($str);
        }

        // Set the cache and return
        return self::$cache[$key] = $str;
    }
}
