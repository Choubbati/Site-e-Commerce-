<?php

namespace app\app\controllers;

use app\app\models\Product;

class AdminController
{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }







    public function dashboard()
    {
        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?page=home');
            exit;
        }


        $productModel = new Product();
        $products = $productModel->getAllProduct()();
        require __DIR__ . '/../views/admin/dashboard.php';
    }



}
