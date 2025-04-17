<?php

namespace App\Models;

use App\Helpers\Log;
use PDO;
use PDOException;
use Exception;

class ConnectDatabase
{
    private $connection;

    public function __construct()
    {
        // Load biến môi trường nếu chưa có
        if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_CHARSET'])) {
            throw new Exception("Database configuration is missing in .env file.");
        }

        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";

        try {
            $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
            // Log::global(["message" => "Database connection failed: " . $e->getMessage()]);
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
            // Log::global(["message" => "Query failed: " . $e->getMessage()]);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
