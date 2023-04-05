<?php

namespace Database\Connections;

use PDO;

class DB
{
    private $host;

    private $username;

    private $password;

    private $database;

    private $port;

    private $connection;


    public function __construct($host, $username, $password, $database = null, $port = 3306)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }

    public function getDBConnection()
    {
        $this->connection = new PDO(sprintf("mysql:host=%s;dbname=%s", $this->host, $this->database), $this->username, $this->password);

        if ($this->connection === false) {
            throw new \Exception("Couldn't connect to database server");
        }

        return $this->connection;
    }
    public function getConnection()
    {
        $this->connection = new PDO(sprintf("mysql:host=%s", $this->host), $this->username, $this->password);

        if ($this->connection === false) {
            throw new \Exception("Couldn't connect to database server");
        }

        return $this->connection;
    }
}
