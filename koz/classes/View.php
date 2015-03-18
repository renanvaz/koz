<?php

namespace Koz;

/**
 * Acts as an object wrapper for HTML pages with embedded PHP, called "views".
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 *
 */
class View extends Data
{

    protected $_file;

    // Global view variables
    protected static $_globalData;

    /**
     * Sets the initial view filename and local data. Views should almost
     * always only be created using [View::factory].
     *
     *     $view = new View($file);
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  void
     * @uses    View::set_filename
     */
    public function __construct($filename, array $data = NULL)
    {
        $this->_file = Core::find('views/'.$filename);

        if ($this->_file) {
            if ($data !== NULL) {
                $this->_data = $data + $this->_data;
            }
        } else {
            $info = debug_backtrace();
            throw new Exception('The view file "'.$filename.'" not exists.');
        }
    }

    /**
     * Magic method, searches for the given variable and returns its value.
     * Local variables will be returned before global variables.
     *
     *     $value = $view->foo;
     *
     * [!!] If the variable has not yet been set, an exception will be thrown.
     *
     * @param   string  $key    variable name
     * @return  mixed
     * @throws  Exception
     */
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->_data[$key];
        } elseif (isset(self::$_globalData->$key)) {
            return self::$_globalData->$key;
        } else {
            throw new Exception('View variable "'.$key.'" is not set.');
        }
    }

    /**
     * Get reference of global variables
     *
     *      View::globals()->key
     *
     * @return  Data
     */
    public static function globals()
    {
        if (!isset(self::$_globalData)) {
            self::$_globalData = new Data;
        }

        return self::$_globalData;
    }

    /**
     * Magic method, returns the output of [View::render].
     *
     * @return  string
     * @uses    View::render
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Returns a new View object.
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  View
     */
    public static function make($file = NULL, array $data = NULL)
    {
        return new View($file, $data);
    }

    /**
     * Captures the output that is generated when a view is included.
     * The view data will be extracted to make local variables. This method
     * is static to prevent object scope resolution.
     *
     *     $output = View::capture($file, $data);
     *
     * @param   string  $filename   filename
     * @param   array   $data       variables
     * @return  string
     */
    protected static function capture($filename, array $data)
    {
        if (self::$_globalData) {
            // Import the global view variables to local namespace
            extract(self::$_globalData->asArray(), EXTR_SKIP | EXTR_REFS);
        }

        // Import the view variables to local namespace
        extract($data, EXTR_SKIP);

        // Capture the view output
        ob_start();

        try {
            // Load the view within the current scope
            include $filename;
        } catch (Exception $e) {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw $e;
        }

        // Get the captured output and close the buffer
        return ob_get_clean();
    }

    /**
     * Renders the view object to a string. Global and local data are merged
     * and extracted to create local variables within the view file.
     *
     *     $output = $view->render();
     *
     * [!!] Global variables with the same key name as local variables will be
     * overwritten by the local variable.
     *
     * @param   string  $file   view filename
     * @return  string
     * @throws  View_Exception
     * @uses    View::capture
     */
    public function render()
    {
        if (empty ($this->_file)) {
            throw new \ErrorException('You must set the file to use within your view before rendering');
        }

        // Combine local and global data and capture the output
        return self::capture($this->_file, $this->_data);
    }

}
