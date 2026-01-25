<?php
namespace app\app\controllers;

use app\app\config\Connection;
use app\app\services\ProductService;
use PDO;

class CartController
{
    private ProductService $productService;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->productService = new ProductService();
    }

    //  Ajouter au panier

    public function add()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'not_logged'
            ]);
            exit;
        }

        $productId = $_POST['product_id'] ?? null;
        $quantity  = $_POST['quantity'] ?? 1;

        if (!$productId) {
            echo json_encode(['success' => false]);
            exit;
        }

        $this->productService->addToCart((int)$productId, (int)$quantity);

        $count = array_sum($_SESSION['cart']);

        echo json_encode([
            'success' => true,
            'count' => $count
        ]);
        exit;
    }

    public function checkout(){
        $produits = $this->afficher();
        require __DIR__ . '/../views/checkout.php';
    }

    public function placeOrder()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            die('Panier vide');
        }

        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = $this->productService->getById($id);
            if ($product) {
                $total += $product['price'] * $qty;
            }
        }

        $pdo = new  PDO(
        "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
        "root",
        "44",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

        $stmt = $pdo->prepare("
        INSERT INTO orders (user_id, total, status)
        VALUES (?, ?, 'pending')
    ");

        $stmt->execute([
            $_SESSION['user_id'],
            $total
        ]);

        // vider le panier
        unset($_SESSION['cart']);

        header('Location: index.php?page=order-success');
        exit;
    }


    //  Supprimer du panier
    public function remove()
    {
        $produitId = $_GET['id'] ?? null;

        if ($produitId) {
            $this->productService->removeFromCart((int)$produitId);
        }

        header('Location: index.php?page=cart');
        exit;
    }

    // 🛒 Afficher panier
    public function afficher(): array
    {
        $cart = $_SESSION['cart'] ?? [];
        $produits = [];

        foreach ($cart as $id => $qty) {
            $produit = $this->productService->getById($id);
            if ($produit) {
                $produit['quantity'] = $qty;
                $produits[] = $produit;
            }
        }
        return $produits;
    }



}
