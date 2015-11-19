<?php

namespace Koz;

class Data implements \Countable, \Serializable, \IteratorAggregate
{
    // Array of variables
    protected $_data = [];

    public function __construct(array $data = NULL)
    {
        $data AND $this->_data += $data;
    }

    /**
     * Count number of data
     * @return int
     */
    public function count()
    {
        return count($this->_data);
    }

    /**
     * Serialize data
     * @return string Data serialized
     */
    public function serialize()
    {
        return serialize($this->_data);
    }

    /**
     * Unserialize data
     * @param  string $data Data serialized
     * @return void
     */
    public function unserialize($data)
    {
        $this->_data = unserialize($data);
    }

    /**
     * Get the array iterator
     * @return \ArrayIterator Class data as array interator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_data);
    }

    /**
     * Search value from a path string
     * @param  string $path
     * @param  mixed $default
     * @return mixed
     */
    public function get ($path, $default = NULL)
    {
        return \Helpers\Arr::get($this->_data, $path, $default);
    }

    /**
     * Set value from a path string
     * @param  string $path
     * @param  mixed $value
     * @return mixed
     */
    public function set ($path, $value)
    {
        $item = \Helpers\Arr::set($this->_data, $path, $value);
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
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->_data[$key];
        } else {
            throw new Exception('The variable "'.$key.'" is not set.');
        }
    }

    /**
     * Magic method, set value to the key.
     *
     *     $this->foo = 'something';
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  value
     * @return  void
     */
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * Check if the key is set.
     *
     *     isset($this->key);
     *
     * @param   string  $key    variable name
     * @return  bool
     */
    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }

    /**
     * Unset the key.
     *
     *     unset($this->key);
     *
     * @param   string  $key    variable name
     * @return  bool
     */
    public function __unset($key)
    {
        unset($this->_data[$key]);
    }

    /**
     * Get the data as array.
     *
     *     $this->asArray();
     *
     * @return  array
     */
    public function asArray()
    {
        return $this->_data;
    }

    /**
     * Magic method, returns the output of [View::render].
     *
     * @return  string
     * @uses    Helpers\Debug::vars
     */
    public function __toString()
    {
        return \Helpers\Debug::vars($this->_data);
    }
}
