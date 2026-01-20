<?php

namespace app\app\models;

use app\app\config\Connection;
use PDO;

class Category
{
    private PDO $pdo;

    public function __construct(){
        $this->conn=Connection::getConnection();
    }

    public function getAllCategories(){
        $sql = $this->conn->prepare("SELECT id,name FROM categories");
        $sql->fetchAll();
    }

    public function createCategory(string $name){
        $sql = $this->conn->prepare("INSERT INTO categories (name) VALUES (:name)");
        $sql->execute([":name"=> $name]);
    }


    public function Update(int $id ,string $name){
        $sql = $this->conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
        return $sql->execute([
            ":name"=>$name,
            ":id"=>$id
        ]);
    }
}