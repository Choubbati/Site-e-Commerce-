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

    public function getProductById(int $id): ?array{
        $sql = $this->conn->prepare("
            SELECT p.id, p.name, p.description, p.price, p.stock, p.image, c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
        ");
        $sql->execute([":id" => $id]);

        return $sql->fetch() ?: null;
    }


    public  function createProduct(string $name , string $description , float $price , int $stock , int $category_id, ?string $image = null):bool{
        $sql = $this->conn->prepare("INSERT INTO products(name,description,price,stock,category_id,image) VALUES (:name,:description,:price,:stock,:category_id,:image)");
        return $sql->execute([
            ":name"=>$name,
            ":description"=>$description,
            ":price"=>$price,
            ":stock"=>$stock,
            ":category_id"=>$category_id,
            ":image"=>$image

        ]);
    }

    public function Update(int $id, array $data):bool{
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE products SET ".implode(",", $fields)." WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data[":id"] = $id;
        return $stmt->execute($data);
    }

}