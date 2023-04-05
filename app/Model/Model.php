<?php

namespace App\Model;

use Database\Connections\DB;

abstract class Model
{
    protected $sql;

    protected $table;

    protected $dbConnection;

    protected $fields;

    protected $params;

    public function __construct()
    {
        $dbConfig = require(__DIR__ . '/../../config/database.php');
        $connection = new DB($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db']);
        $this->dbConnection = $connection->getDBConnection();
    }

    /**
     * All query
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->dbConnection->query($sql)->fetchAll();
    }

    /**
     * select specific column query
     */
    public function select(array $cols)
    {
        $this->sql = "";
        foreach ($cols as $index => $col) {
            if ($index === 0) {
                $this->sql .= "SELECT {$col}";
            } else {
                $this->sql .= ", {$col}";
            }
        }

        $this->sql .= " FROM {$this->table}";

        return $this;
    }

    /**
     * Return only one row based on query
     */
    public function first()
    {
        $stmt = $this->dbConnection->prepare($this->sql);
        $stmt->execute($this->params);

        return $stmt->fetch();
    }

    /**
     * Return all rows based on query
     */
    public function get()
    {
        $stmt = $this->dbConnection->prepare($this->sql);
        $stmt->execute($this->params);

        return $stmt->fetchAll();
    }

    /**
     * Add where clause
     *
     * @param string $col
     * @param string $value
     * @param string $operator
     */
    public function where($col, $value, $operator = '=')
    {
        $this->sql = "SELECT * from {$this->table} WHERE {$col} {$operator} :{$col} ";
        $this->params[$col] = $value;

        return $this;
    }

    /**
     * Chaining orWhere clause
     *
     * @param string $col
     * @param string $value
     * @param string $operator
     */
    public function orWhere($col, $value, $operator = "=")
    {
        $this->sql .= "OR {$col} {$operator} :{$col} ";
        $this->params[$col] = $value;


        return $this;
    }

    /**
     * Chaining orWhere for date
     *
     * @param string $col
     * @param string $value
     * @param string $operator
     */
    public function orWhereDate($col, $value, $operator = "=")
    {
        $this->sql .= "OR DATE({$col}) {$operator} :dateVal ";
        $this->params['dateVal'] = $value;


        return $this;
    }

    /**
     * delete data from db
     *
     * @param string $col
     * @param string $value
     * @param string $operator
     */
    public function delete($col, $value, $operator = '=')
    {
        $sql = "DELETE FROM {$this->table} WHERE {$col} {$operator} :{$col}";
        $param[$col] = $value;

        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($param);
    }

    /**
     * order by col
     *
     * @param string $col
     */
    public function orderBy($col)
    {
        $this->sql .= " ORDER BY {$col}";

        return $this;
    }

    /**
     * Update query 
     *
     * @param array $data
     * @param string $whereCol
     * @param string $value
     */
    public function update(array $data, $whereCol, $value)
    {
        $str = "";

        $params = [];

        foreach ($this->fields as $key) {
            if (isset($data[$key])) {
                $str .= "`$key` = :$key,";
                $params[$key] = $data[$key];
            }
        }

        $str = rtrim($str, ",");
        $this->sql = "UPDATE {$this->table} SET  {$str} WHERE {$whereCol} = :whereVal";
        $params['whereVal'] = $value;

        return $this->dbConnection->prepare($this->sql)->execute($params);
    }

    /**
     * Store query
     * @param array $data
     */
    public function store($data)
    {
        $fields = "";
        $values = "";
        $params = [];

        foreach ($this->fields as $key) {
            if (isset($data[$key])) {
                $fields .= "`$key`,";
                $values .= ":$key,";
                $params[$key] = $data[$key];
            }
        }

        $fields = rtrim($fields, ",");
        $values = rtrim($values, ",");

        $sql = "INSERT INTO {$this->table} ({$fields})
        VALUES ({$values})";

        $statement = $this->dbConnection->prepare($sql);

        return $statement->execute($params);
    }
}
