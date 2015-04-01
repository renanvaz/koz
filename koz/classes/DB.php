<?php

namespace Koz;

class Where
{
    public static function group()
    {
        return ;
    }
}


class DBExpr
{
    private $_expr;

    public function __construct($expr)
    {
        $this->_expr = $expr;
    }
}

class DB
{

    protected static $pdo;

    /**
     * Query parts
     * @var array
     */
    protected $_queryParts = [
        'type'      => '',
        'table'     => array(),
        'set'       => array(),
        'distinct'  => FALSE,
        'fields'    => array(),
        'where'     => array(),
        'join'      => array(),
        'groupBy'   => array(),
        'having'    => array(),
        'orderBy'   => array(),
        'limit'     => NULL,
        'offset'    => NULL
    ];

    /**
     * Query
     * @var string
     */
    protected $_query;

    /**
     * Open a database connection
     * @param  string $connName
     * @return $this
     */
    public function open($connName = 'default')
    {
        $engine     = 'mysql';
        $database   = 'koz';
        $host       = 'localhost';

        $user       = 'admin';
        $password   = 'luver';

        $dns = $engine.':dbname='.$database.";host=".$host;
        $options = [];

        self::$pdo = new \PDO($dns, $user, $password);

        return $this;
    }

    /**
     * Close the current connection
     * @return $this
     */
    public function close()
    {
        self::$pdo = null;

        return $this;
    }

    /**
     * Choose the table to select from.
     *
     * @param   string  $table  Table name
     * @return  $this
     */
    public function select($table)
    {
        $this->_queryParts['type'] = 'SELECT';
        $this->_queryParts['table'] = $table;

        return $this;
    }

    /**
     * Choose the table to delete from.
     *
     * @param   string  $table  Table name
     * @return  $this
     */
    public function delete($table) {
        $this->_queryParts['type'] = 'DELETE';
        $this->_queryParts['table'] = $table;

        return $this;
    }

    /**
     * Choose the table to update.
     *
     * @param   string  $table  Table name
     * @return  $this
     */
    public function update($table)
    {
        $this->_queryParts['type'] = 'UPDATE';
        $this->_queryParts['table'] = $table;

        return $this;
    }

    /**
     * Choose the table to insert.
     *
     * @param   string  $table  Table name
     * @return  $this
     */
    public function insert($table)
    {
        $this->_queryParts['type'] = 'INSERT';
        $this->_queryParts['table'] = $table;

        return $this;
    }

    /**
     * Fields to SELECT
     *
     * @param   mixed field to select
     * @return  $this
     */
    public function fields()
    {
        $columns = func_get_args();

        $this->_queryParts['fields'] = ($this->_queryParts['fields'] + $columns);

        return $this;
    }

    /**
     * Fields to SET
     *
     * @param   mixed field to set ['field' => 'value']
     * @return  $this
     */
    public function set()
    {
        $columns = func_get_args();

        $this->_queryParts['set'] = ($this->_queryParts['set'] + $columns);

        return $this;
    }

    /**
     * Enables or disables selecting only unique columns using "SELECT DISTINCT"
     *
     * @param   boolean  $value  enable or disable distinct columns
     * @return  $this
     */
    public function distinct($is = TRUE)
    {
        $this->_queryParts['distinct'] = (bool) $is;

        return $this;
    }

    /**
     * Creates a new "AND WHERE" condition for the query.
     *
     * @param   mixed   $condition  Condition string PDO like
     * @uses  $this->andWhere
     * @return  $this
     */
    public function where($condition)
    {
        return $this->andWhere($condition);
    }

    /**
     * Creates a new "AND WHERE" condition for the query.
     *
     * @param   mixed   $condition  Condition string PDO like
     * @return  $this
     */
    public function andWhere($condition)
    {
        $this->_queryParts['where'][] = ['AND', '('.trim(trim($condition), '()').')'];

        return $this;
    }

    /**
     * Creates a new "OR WHERE" condition for the query.
     *
     * @param   mixed   $column  Condition string PDO like
     * @return  $this
     */
    public function orWhere($condition)
    {
        $this->_queryParts['where'][] = ['OR', '('.trim(trim($condition), '()').')'];

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
    public function between($column, $value1, $value2)
    {
        return $this;
    }

    /**
     * Applies sorting with "ORDER BY ..."
     *
     * @param   mixed   $column     column name or array($column, $alias) or object
     * @param   string  $direction  direction of sorting
     * @return  $this
     */
    public function orderBy($column, $direction = NULL)
    {
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
    public function join($table, $condition, $type = 'INNER')
    {
        return $this;
    }

    /**
     * Creates a "GROUP BY ..." filter.
     *
     * @param   mixed   $columns  column name or array($column, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function groupBy()
    {
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
    public function having($column, $op, $value = NULL)
    {
        return $this->and_having($column, $op, $value);
    }

    /**
     * Return up to "LIMIT ..." results
     *
     * @param   integer  $number  maximum results to return
     * @return  $this
     */
    public function limit($number)
    {
        $this->_queryParts['limit'] = (int) $number;

        return $this;
    }

    /**
     * Start returning results after "OFFSET ..."
     *
     * @param   integer   $number  starting result number
     * @return  $this
     */
    public function offset($number)
    {
        $this->_queryParts['offset'] = (int) $number;

        return $this;
    }

    private function _security($value)
    {
        return trim(preg_replace('/( +)/', ' ', $value)).';';
    }

    private function _normalize($query)
    {
        return trim(preg_replace('/( +)/', ' ', $query)).';';
    }

    private function _quote($field)
    {
        return preg_replace('/`\*`/', '*', '`'.preg_replace('/\./', '`.`', preg_replace('/`/', '', $field)).'`');
    }

    public function s()
    {
        $q = '';

        $table      = $this->_queryParts['table'];
        $set        = $this->_queryParts['set'];
        $distinct   = $this->_queryParts['distinct'];
        $fields     = $this->_queryParts['fields'];
        $where      = $this->_queryParts['where'];
        $join       = $this->_queryParts['join'];
        $groupBy    = $this->_queryParts['groupBy'];
        $having     = $this->_queryParts['having'];
        $orderBy    = $this->_queryParts['orderBy'];
        $limit      = $this->_queryParts['limit'];

        // Distinct
        $distinct = $distinct ? 'DISTINCT' : '';

        // Fields
        if (count($fields)) {
            $_fields = [];
            foreach ($fields as $field) {
                $_fields[] = is_array($field) ? $this->_quote(key($field)).' as '.$this->_quote(current($field)) : $this->_quote($field);
            }

            $fields = implode(', ', $_fields);
        } else {
            $fields = $this->_quote($table.'.*');
        }

        // SET
        if (count($set)) {
            $_set = [];
            foreach ($set as $data) {
                $_set[key($data)] = current($data);
            }

            //die(\Helpers\Debug::vars($_set));
        }

        // WHERE
        $where = '';

        // HAVING
        $having = '';

        // JOIN
        $join = '';

        // GROUP BY
        $groupBy = '';

        // ORDER BY
        $orderBy = '';

        // LIMIT
        $limit = '';

        if ($this->_queryParts['type'] === 'SELECT') {
            return $this->_normalize("SELECT $distinct $fields FROM $table $join $where $groupBy $having $orderBy $limit");
        } else if ($this->_queryParts['type'] === 'DELETE') {
            return $this->_normalize("DELETE FROM $table $where");
        } else if ($this->_queryParts['type'] === 'UPDATE') {
            return $this->_normalize("UPDATE $table $set $where");
        } else if ($this->_queryParts['type'] === 'INSERT') {
            // Keys
            $keys  = array_keys($set);
            $keys = implode(', ', $keys);

            // Values
            $values = array_values($set);
            $values = implode(', ', $values);

            return $this->_normalize("INSERT INTO $table ($keys) VALUES ($values)");
        } else {
            return FALSE;
        }
    }

    /**
     * Finds and loads a single database row into the object.
     *
     * @chainable
     * @throws Kohana_Exception
     * @return ORM
     */
    public function find($id = null)
    {
        return $this->_load_result(FALSE);
    }

    /**
     * Finds multiple database rows and returns an iterator of the rows found.
     *
     * @throws Kohana_Exception
     * @return Database_Result
     */
    public function all($limit = null, $offset = null)
    {
        if (!is_null($limit)) {

        }

        return $this->_load_result(TRUE);
    }

    /**
     * Delete multiple database rows and yours relationships.
     *
     * @throws Kohana_Exception
     * @return Database_Result
     */
    public function delete()
    {
        return $this->_load_result(TRUE);
    }

    /**
     * Create a DB expression. It not will be parsed
     * @param  string $expr
     * @return DBExpr
     */
    public static function expr($expr)
    {
        return new DBExpr($expr);
    }
}
