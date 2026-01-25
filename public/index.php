<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use app\app\controllers\AdminController;
use app\app\controllers\AuthController;
use app\app\controllers\CartController;
use app\app\controllers\InvoiceController;
use app\app\controllers\ProductController;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        (new AuthController())->showLogin();
        break;

    case 'register':
        (new AuthController())->showRegister();
        break;

    case 'do-login':
        (new AuthController())->login();
        break;

    case 'do-register':
        (new AuthController())->register();
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $pdo = new PDO(
        "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
        "root",
        "44",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

        $stmt = $pdo->prepare("
        SELECT * FROM orders 
        WHERE user_id = ?
        ORDER BY created_at DESC
    ");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../app/views/profile.php';
        break;


    case 'logout':
        session_destroy();
        header('Location: index.php?page=login');
        exit;

    case 'add-to-cart':
        (new \app\app\controllers\CartController())->add();
        break;

// index.php
    case 'cart':
        $controller = new CartController();
        $produits = $controller->afficher();
        require '../app/views/cart.php';
        break;
    case 'checkout':
        (new CartController())->checkout();
        break;

    case 'place-order':
        (new CartController())->placeOrder();
        break;


    case 'remove-from-cart':
        (new \app\app\controllers\CartController())->remove();
        break;

    case 'order-success':
    require __DIR__ . '/../app/views/order-success.php';
    break;

    case 'order-detail' :
        if(!isset($_SESSION["user_id"])){
            header('Location: index.php?page=login');
            exit;
        }
        if (!isset($_GET["id"])){
            die("Commande introuvable");
        }

        $orderId = (int) $_GET['id'];

        $pdo = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",

        );

        $stmt = $pdo->prepare("
        SELECT * FROM orders 
        WHERE id = ? AND user_id = ?
    ");
        $stmt->execute([$orderId, $_SESSION['user_id']]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            die('Accès non autorisé');
        }

        $stmt = $pdo->prepare("
        SELECT oi.*, p.name, p.image
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        WHERE oi.order_id = ?
    ");
        $stmt->execute([$orderId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../app/views/order_detail.php';
        break;


    case 'invoice':
        if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
            die('Accès refusé');
        }

        require __DIR__ . '/../app/controllers/InvoiceController.php';
        (new InvoiceController())->generate((int)$_GET['id']);
        break;


    case 'admin-orders':
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            die('Accès refusé');
        }

        $pdo = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",

        );

        $stmt = $pdo->query("
        SELECT o.*, u.email 
        FROM orders o
        JOIN users u ON u.id = o.user_id
        ORDER BY o.created_at DESC
    ");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../app/views/admin/orders.php';
        break;

    case 'admin-order-detail':
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            die('Accès refusé');
        }

        $id = (int)$_GET['id'];

        $pdo = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",

        );
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id=?");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("
        SELECT oi.*, p.name 
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        WHERE oi.order_id=?
    ");
        $stmt->execute([$id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../app/views/admin/order_detail.php';
        break;

    case 'update-order-status':
        if ($_SESSION['user_role'] !== 'admin') die('Accès refusé');

        $pdo = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",

        );

        $stmt = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->execute([$_POST['status'], $_POST['id']]);

        header('Location: index.php?page=admin-orders');
        exit;


    case 'admin-dashboard':
        if ($_SESSION['role'] !== 'admin') {
            header('Location: index.php');
            exit;
        }
        $db = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",   

        );
        (new AdminController($db))->dashboard();
        break;



    default:
        $products = (new ProductController())->index();
        require __DIR__ . '/../app/views/home.php';
}



?>