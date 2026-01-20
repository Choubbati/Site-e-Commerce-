<?php

namespace app\app\services;

use app\app\config;
use app\app\config\Connection;
use PDO;
class ProductService
{
    private PDO $pdo;

    public function __construct(){
        $this->conn = Connection::getConnection();
    }

    function getAll():array{
        $sql = $this->conn->query("SELECT p.*, c.name , as category
            FROM products p 
            LEFT JOIN ategories c ON p.category_id = c.id");
        return $sql->fetchAll();
    }

    public function getById(int $id):array|false{
        $sql = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $sql->execute([$id]);
        return $sql->fetch();
    }
}