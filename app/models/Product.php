<?php

namespace app\app\models;

use app\app\config\Connection;
use PDO;

class Product
{
    private PDO $pdo;
    public function __construct(){
        $this->conn = Connection::getConnection();
    }

    public function getAllProduct():array{
        $sql = $this->conn->query("
            SELECT p.id, p.name, p.description, p.price, p.stock, p.image, c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
        ");
        return $sql->fetchAll();
    }


}