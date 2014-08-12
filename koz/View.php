<?php

namespace Koz;

/**
 * Acts as an object wrapper for HTML pages with embedded PHP, called "views".
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 *
 */
class View {

    protected $_file;

    // Array of local variables
    protected $_data = array();

    // Array of global variables
    protected static $_global_data = array();

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
    public function __construct($file = NULL, array $data = NULL) {
        if ($file !== NULL) {
            $this->_file = $file;
        }

        if ($data !== NULL) {
            $this->_data = $data + $this->_data;
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
    public function __get($key) {
        if (array_key_exists($key, $this->_data)) {
            return $this->_data[$key];
        } elseif (array_key_exists($key, View::$_global_data)) {
            return View::$_global_data[$key];
        } else {
            throw new Exception('View variable is not set: :var',
                array(':var' => $key));
        }
    }


    /**
     * Magic method, calls [View::set] with the same parameters.
     *
     *     $view->foo = 'something';
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  value
     * @return  void
     */
    public function __set($key, $value) {
        $this->_data[$key] = $value;
    }

    /**
     * Magic method, returns the output of [View::render].
     *
     * @return  string
     * @uses    View::render
     */
    public function __toString() {
        return $this->render();
    }

    /**
     * Returns a new View object.
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  View
     */
    public static function make($file = NULL, array $data = NULL) {
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
    protected static function capture($filename, array $data) {
        if (View::$_global_data) {
            // Import the global view variables to local namespace
            extract(View::$_global_data, EXTR_SKIP | EXTR_REFS);
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
     * Sets a global variable, similar to [View::set], except that the
     * variable will be accessible to all views.
     *
     *     View::global($name, $value);
     *
     * @param   string  $key    variable name or an array of variables
     * @param   mixed   $value  value
     * @return  void
     */
    public static function global($key, $value = NULL) {
        if (is_array($key)) {
            foreach ($key as $key2 => $value) {
                View::$_global_data[$key2] = $value;
            }
        } else {
            View::$_global_data[$key] = $value;
        }
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
    public function render() {
        if (empty($this->_file)) {
            throw new View_Exception('You must set the file to use within your view before rendering');
        }

        // Combine local and global data and capture the output
        return View::capture($this->_file, $this->_data);
    }

}
