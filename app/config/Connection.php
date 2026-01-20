<?php

namespace app\app\config;

use PDO;
use PDOException;

class Connection
{
    protected static ?PDO $db = null;

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (is_null(static::$db)) {
            try {
                static::$db = new PDO(
                    "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
                    "root",
                    "root",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return static::$db;
    }

}