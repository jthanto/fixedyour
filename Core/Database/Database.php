<?php

namespace fixedyour\Core\Database;

use PDO;

/**
 * Class Database
 */
class Database extends PDO{

    /**
     * Database constructor.
     * @param $database, name of database
     */
    public function __construct($database)
    {
        $host = DB_MYSQL_HOST;
        $port = DB_MYSQL_PORT;
        $username=DB_MYSQL_USER;
        $password=DB_MYSQL_PASSWORD;
        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
        parent::__construct($dsn, $username, $password);
    }

}