<?php

namespace fixedyour\Core\Database;

use PDO;

/**
 * Class Database
 */
class Database {

    /**
     * Database constructor.
     * @param $database, name of database
     */
    public function __construct($database)
    {
        $PDO = new PDO('mysql:host='.DB_MYSQL_HOST.';'.$database, DB_MYSQL_USER, DB_MYSQL_PSW);
        if($PDO){
            echo 'success';
        } else {
            echo 'Buuuu';
        }
    }

}