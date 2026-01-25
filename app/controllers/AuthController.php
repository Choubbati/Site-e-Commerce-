<?php

namespace app\app\controllers;

use app\app\services\AuthService;

class AuthController {
    private AuthService $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function showLogin() {
        require __DIR__ . '/../views/login.php';
    }

    public function showRegister() {
        require __DIR__ . '/../views/register.php';
    }

    public function login()
    {
        $user = $this->service->login($_POST);

        if ($user) {

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;
            $_SESSION['user_name'] = $user->name;

            if ($user->role === 'admin') {
                header('Location: index.php?page=admin-dashboard');
            } else {
                header('Location: index.php?page=home');
            }
            exit;
        }

        header('Location: index.php?page=login');
        exit;
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/../views/register.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'email' => $_POST['email'] ?? null,
                'password' => $_POST['password'] ?? null,
            ];

            if (!$data['name'] || !$data['email'] || !$data['password']) {
                die('Tous les champs sont obligatoires.');
            }

            if ($this->service->register($data)) {
                header('Location: index.php?page=login'); 
                exit;
            } else {
                die('Erreur lors de l\'inscription.');
            }
        }
    }


    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $pdo = new \PDO(
            "mysql:host=localhost;dbname=site_ecommerce;charset=utf8",
            "root",
            ""
        );

        $stmt = $pdo->prepare("
        SELECT * FROM orders 
        WHERE user_id = ?
        ORDER BY created_at DESC
    ");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/profile.php';
    }


}