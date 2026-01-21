<?php

namespace app\app\controllers;



use app\app\services\ProductService;

class ProductController
{
    private ProductService $productService;

    public function __construct(){
        $this->productService = new ProductService();
    }

    //afficher tous les produits
    public function index(){
        return $this->productService->getAll();
    }

    public function show(int $id): array|false{
        return $this->productService->getById($id);
    }



}