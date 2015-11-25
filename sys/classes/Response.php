<?php

namespace Koz;

class Response
{
    private static $_text;

    /**
     * Set a response header
     * @param  string  $key   Header name
     * @param  integer $value Header value
     * @return void
     */
    public static function header($key, $value) {
        header($key.': '.$value, true);
    }

    /**
     * Set the response status code
     * @param  integer $code Status code
     * @return void
     */
    public static function status($code) {
        http_response_code($code);
    }

    /**
     * Redirect current request
     * @param  string  $uri  Relative or absolute URI
     * @param  integer $code Status code
     * @return void
     */
    public static function redirect($uri, $code = 302) {
        self::status($code);
        self::header('location', preg_match('/^https?:\/\//', $uri) ? $uri : Core::$baseURL.ltrim($uri, '/'));
    }

    /**
     * The default response with a HTML content
     * @param  string $body Response text
     * @return void
     */
    public static function body($text) {
        self::header('Content-type', 'text/html; charset='.Core::$charset);
        self::$_text = $text;
    }

    /**
     * Response with a RAW text Content-type
     * @param  string $text Response text
     * @return void
     */
    public static function raw($text) {
        self::header('Content-type', 'text/plain; charset='.Core::$charset);
        self::$_text = $text;
    }

    /**
     * Response with a JSON text content
     * @param  mixed $data Array or string response text
     *                  if the value is an array,
     *                  it will be converted to a string by "json_encode" PHP function
     * @return void
     */
    public static function json($data) {
        self::header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        self::header('Content-type', 'application/json; charset='.Core::$charset);

        self::$_text = is_array($data) ? json_encode($data) : $data;
    }

    /**
     * Response with a downloadeble file content
     * @param  string $file    File location (relative to the index or a realpath)
     * @param  string $renamed Rename the download file
     * @return void
     */
    public static function download($file, $renamed = '') {
        $filename = $renamed ? $renamed : basename($file);

        self::header('Content-Description', 'File Transfer');
        self::header('Content-Type', 'application/octet-stream');
        self::header('Content-Disposition', 'attachment; filename="'.$filename.'"');
        self::header('Content-Transfer-Encoding', 'binary');
        self::header('Connection', 'Keep-Alive');
        self::header('Expires', '0');
        self::header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        self::header('Pragma', 'public');
        self::header('Content-Length', filesize($file));

        self::$_text = file_get_contents($file);
    }

    public static function file($file, $content = FALSE) {
        // Implements
        die('Response::file Implements');
    }

    /**
     * Get the response text
     * @return string Response Text
     */
    public static function render() {
        return self::$_text;
    }
}
