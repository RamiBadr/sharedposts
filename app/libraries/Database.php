<?php

/*

* PDO DATABASE CLASS
* CONNECT TO DATABASE
* CREATE PREPARE STATEMENTS
* BIND VALUES
* RETURN ROWS AND RESULTS

*/


class Database {
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pwd = DB_PWD;

    private $dbh;
    private $stmt;
    private $isConnected = false;
    private $error;

    // start connection to the database.
    function __construct() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        $dsn = "mysql:dbname=$this->db_name;host=$this->db_host";
        $this->isConnected = true;
        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pwd, $options);

        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            $this->isConnected = false;
        }

        echo $this->error;
    }

    // prepare query.
    function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // bind values.
    function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);

        
    }

    // execute stmt.
    function execute() {
        $this->stmt->execute();
    }

    // fetch multiple records.
    function fetchAll() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // fetch a single record.
    function fetch() {
        $this->execute();
        return $this->stmt->fetch();
    }

    // get error.
    function getError() {
        return $this->error;
    }

    // check if you're connected to the database or not.
    function isConnected() {
        return $this->isConnected;
    }

    // get row count.
    function rowCount() {
        return $this->stmt->rowCount();
    }
}