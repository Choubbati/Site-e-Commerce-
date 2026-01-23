<?php
namespace app\app\controllers;
use app\app\services\ProductService;

class CartController{
        private ProductService $productService;

        public function __construct(){
            $this->productService = new ProductService();
            if (!isset($_SESSION)){
                session_start();
            }

        }

//        ajouter au panier

    public function add(int $produitId,int $quantity=1){
        $this->productService->addToCart($produitId,$quantity);
    }

    public function remove(int $produitId)
    {
        $this->productService->removeFromCart($produitId);
    }

    public function afficher():array
    {
        $cart= $this->productService->getCart();
        $produits =[];

        foreach ($cart as $id => $qty){
            $produit=$this->productService->getById($id);
            if ($produit){
                $produit['quantity'] = 1;
                $produits[]=$produit;
            }
        }
        return $produits;
    }



}