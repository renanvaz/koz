<?php

namespace Koz;

class ORM {
    /**
     * @var array
     */
    private $_original_values = array();

    /**
     * Table primary key
     * @var string
     */
    private $_primary_key = 'id';

    /**
     * "Has one" relationships
     * @var array
     */
    protected $_has_one = array();

    /**
     * "Belongs to" relationships
     * @var array
     */
    protected $_belongs_to = array();

    /**
     * "Has many" relationships
     * @var array
     */
    protected $_has_many = array();

    /**
     * Table name
     * @var string
     */
    protected $_table_name;

    /**
     * Table columns
     * @var array
     */
    protected $_columns;

    /**
     * Query parts
     * @var array
     */
    protected $_queryParts array(
        'select'    => array(),
        'distinct'  => array(),
        'where'     => array(),
        'join'      => array(),
        'groupBy'   => array(),
        'having'    => array(),
        'orderBy'   => array(),
        'limit'     => NULL,
        'offset'    => NULL
    );

    /**
     * Query
     * @var string
     */
    protected $_query;

    /**
     * Creates and returns a new model.
     * Model name must be passed with its' original casing, e.g.
     *
     *    $model = ORM::make('User_Token');
     *
     * @chainable
     * @param   string  $model  Model name
     * @param   mixed   $id     Parameter for find()
     * @return  ORM
     */
    public static function make ($model, $id = NULL) {
        // Set class name
        $model = 'Model_'.$model;

        return new $model ($id);
    }

    /**
     * Enables or disables selecting only unique columns using "SELECT DISTINCT"
     *
     * @param   boolean  $value  enable or disable distinct columns
     * @return  $this
     */
    public function distinct () {
        $columns = func_get_args();

        return $this;
    }

    /**
     * Choose the columns to select from.
     *
     * @param   mixed  $columns  column name or array($column, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function select () {
        $columns = func_get_args();

        return $this;
    }

    /**
     * Creates a new "WHERE" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function where ($column, $op, $value) {
        return $this;
    }

    /**
     * Creates a new "WHERE" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function between ($column, $value1, $value2) {
        return $this;
    }

    /**
     * Create a group of condition
     *
     * @return  $this
     */
    public function open () {
        return $this->and_where_open();
    }

    /**
     * Close a group of condition
     *
     * @return  $this
     */
    public function close () {
        return $this->and_where_open();
    }

    /**
     * Applies sorting with "ORDER BY ..."
     *
     * @param   mixed   $column     column name or array($column, $alias) or object
     * @param   string  $direction  direction of sorting
     * @return  $this
     */
    public function orderBy ($column, $direction = NULL) {
        return $this;
    }

    /**
     * Adds addition tables to "JOIN ...".
     *
     * @param   mixed   $table  column name or array($column, $alias) or object
     * @param   string  $type   join type (LEFT, RIGHT, INNER, etc)
     * @return  $this
     */
    public function join ($table, $type = NULL) {
        return $this;
    }

    /**
     * Adds "ON ..." conditions for the last created JOIN statement.
     *
     * @param   mixed   $c1  column name or array($column, $alias) or object
     * @param   string  $op  logic operator
     * @param   mixed   $c2  column name or array($column, $alias) or object
     * @return  $this
     */
    public function on ($c1, $op, $c2) {
        return $this;
    }

    /**
     * Creates a "GROUP BY ..." filter.
     *
     * @param   mixed   $columns  column name or array($column, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function groupBy () {
        $columns = func_get_args();

        return $this;
    }

    /**
     * Alias of and_having()
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function having ($column, $op, $value = NULL) {
        return $this->and_having($column, $op, $value);
    }

    /**
     * Return up to "LIMIT ..." results
     *
     * @param   integer  $number  maximum results to return
     * @return  $this
     */
    public function limit ($number) {
        return $this;
    }

    /**
     * Start returning results after "OFFSET ..."
     *
     * @param   integer   $number  starting result number
     * @return  $this
     */
    public function offset ($number) {
        return $this;
    }

    /**
     * Displays the primary key of a model when it is converted to a string.
     *
     * @return string
     */
    public function __toString () {
        return (string) $this->pk();
    }
    /**
     * Handles retrieval of all model values, relationships, and metadata.
     * [!!] This should not be overridden.
     *
     * @param   string $column Column name
     * @return  mixed
     */
    public function __get($column) {
        return '';
    }

    /**
     * Base set method.
     * [!!] This should not be overridden.
     *
     * @param  string $column  Column name
     * @param  mixed  $value   Column value
     * @return void
     */
    public function __set ($column, $value) {

    }
}
