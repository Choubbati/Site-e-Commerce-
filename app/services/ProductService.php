<?php

namespace app\app\services;

use app\app\config;
use app\app\config\Connection;
use PDO;
class ProductService
{
    private PDO $pdo;

    public function __construct(){
        $this->pdo = Connection::getConnection();
    }

    public function getAll(): array {
        $sql = "SELECT * FROM products"; // بدون join
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id):array|false{
        $sql = $this->pdo->prepare("SELECT * FROM products WHERE id=?");
        $sql->execute([$id]);
        return $sql->fetch();
    }


    public function addToCart(int $productId,int $quantity = 1):void{
        if(!isset($_SESSION["cart"])){
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION["cart"][$productId])){
            $_SESSION['cart'][$productId] += $quantity;
        }else{
            $_SESSION['cart'][$productId] = $quantity;
        }
    }


    public function removeFromCart(int $productId)
    {
        unset($_SESSION["cart"][$productId]);
    }

    public function getCart()
    {
        return $_SESSION["cart"] ?? [];
    }





}