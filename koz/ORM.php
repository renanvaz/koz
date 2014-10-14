<?php

namespace Koz;

class ORM {
    /**
     * Table primary key
     * @var string
     */
    public static $pk = 'id';

    /**
     * Relationships
     * @var array
     */
    protected $_hasOne = array();
    protected $_belongsTo = array();
    protected $_hasMany = array();

    /**
     * Table info
     * @var string
     */
    protected $_name;
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
        $model = 'App\models\\'.$model;

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
     * Creates a new "WHERE BETWEEN" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $value1  column value
     * @param   mixed   $value2  column value
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
     * @param   array   $condition   column name, operator, column name
     * @param   string  $type   join type (LEFT, RIGHT, INNER, etc)
     * @return  $this
     */
    public function join ($table, $condition, $type = 'INNER') {
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
     * Finds and loads a single database row into the object.
     *
     * @chainable
     * @throws Kohana_Exception
     * @return ORM
     */
    public function find () {
        return $this->_load_result(FALSE);
    }

    /**
     * Finds multiple database rows and returns an iterator of the rows found.
     *
     * @throws Kohana_Exception
     * @return Database_Result
     */
    public function find_all () {
        return $this->_load_result(TRUE);
    }

    /**
     * Delete multiple database rows and yours relationships.
     *
     * @throws Kohana_Exception
     * @return Database_Result
     */
    public function delete_all () {
        return $this->_load_result(TRUE);
    }
}
