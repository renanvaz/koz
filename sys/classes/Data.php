<?php

namespace Koz;

class Data implements \Countable, \Serializable, \IteratorAggregate
{
    /**
     * Array of data Name => Value
     * @var array
     */
    protected $_data = [];

    /**
     * Flag to indicate if this data is read only
     * @var bool
     */
    protected $_readOnly;

    /**
     * Data
     * @param array|null $data
     * @param boolean    $readOnly
     */
    public function __construct(array $data = NULL, $readOnly = false)
    {
        $this->_readOnly = $readOnly;
        $data && $this->_data = $data;
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
        if (empty($this->_data)) {
            $this->_data = unserialize($data);
        } else {
            throw new \Koz\Exception('Can\'t unserialize data. This class is not empty.');
        }
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
     * @return void
     */
    public function set ($path, $value)
    {
        if (!$this->_readOnly) {
            \Helpers\Arr::set($this->_data, $path, $value);
        } else {
            throw new \Koz\Exception('The key "'.$path.'" is read only.');
        }
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
            throw new \Koz\Exception('The variable "'.$key.'" is not set.');
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
        if (!$this->_readOnly) {
            $this->_data[$key] = $value;
        } else {
            throw new \Koz\Exception('The variable "'.$key.'" is read only.');
        }
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
        if (!$this->_readOnly) {
            unset($this->_data[$key]);
        } else {
            throw new \Koz\Exception('The variable "'.$key.'" is read only.');
        }
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
        return \Koz\Helpers\Debug::vars($this->_data);
    }
}
