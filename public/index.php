<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use app\app\controllers\AuthController;
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

    default:
        $products = (new ProductController())->index();
        require __DIR__ . '../../app/views/home.php';
}
