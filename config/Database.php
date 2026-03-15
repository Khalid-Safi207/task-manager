<?php

class Database {

    private $host = 'localhost';
    private $dbname = 'task_manager';
    private $username = 'root';
    private $password = '';

    public function connect_db() {

        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        try {

            $db = new PDO($dsn, $this->username, $this->password);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $db;

        } catch (PDOException $e) {

            error_log($e->getMessage());

            throw new Exception("Database connection error. Try again later");

        }
    }
}

?>