<?php

namespace Koz;

class Model {
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
     * Creates and returns a new model.
     * Model name must be passed with its' original casing, e.g.
     *
     *    $model = ORM::make('User_Token');
     *
     * @chainable
     * @param   string  $model  Model name
     * @return  Model
     */
    public static function make ($name) {
        // Set class name
        $model = 'App\models\\'.$name;

        return new $model ($id);
    }

    /**
     * Displays the primary key of a model when it is converted to a string.
     *
     * @return string
     */
    public function __toString () {
        return (string) $this->$_pk;
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
