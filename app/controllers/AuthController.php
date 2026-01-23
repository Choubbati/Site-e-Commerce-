<?php

namespace app\app\controllers;

use app\app\services\AuthService;

class AuthController {
    private AuthService $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function showLogin() {
        require __DIR__ . '/../../public/views/login.php';
    }

    public function showRegister() {
        require __DIR__ . '/../views/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/../views/login.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$email || !$password) {
                die('Email ou mot de passe manquant');
            }

            $this->authService->login($email, $password);
        }
    }


    public function register() {
        if ($this->service->register($_POST)) {
            header('Location: index.php?page=login');
            exit;
        }
    }
}