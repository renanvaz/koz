<?php

namespace Koz;

use \Koz\Data;
use \Koz\Helpers\Text;

class DataText extends Data
{
    /**
     * Search value from a path string
     * @param  string $path
     * @param  mixed $default
     * @return mixed
     */
    public function get ($path, $default = NULL)
    {
        return new DataTextParser(parent::get($path, $default = NULL));
    }

    /**
     * Magic method, searches for the key and returns its value.
     *
     *     $value = $this->foo;
     *
     * @param   string  $key    variable name
     * @return  mixed
     * @throws  Exception
     */
    public function __get ($key)
    {
        return new DataTextParser(parent::__get($key));
    }
}

class DataTextParser {
    private $_string = '';

    public function __construct ($string)
    {
        $this->_string = $string;
    }

    public function parse(array $data){
        return Text::parse($this->_string, $data);
    }

    public function __toString ()
    {
        return $this->_string;
    }
}
