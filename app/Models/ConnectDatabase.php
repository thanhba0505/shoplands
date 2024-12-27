<?php

require_once 'config.php';

class ConnectDatabase
{
    private $connection;

    public function __construct()
    {
        $dsn = "mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=" . CHARSET;

        try {
            $this->connection = new PDO($dsn, USER, PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, 'errors.log');
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }


    public function getConnection()
    {
        return $this->connection;
    }
}
