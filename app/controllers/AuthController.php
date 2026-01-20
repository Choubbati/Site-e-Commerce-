<?php

namespace app\app\controllers;

use app\app\services\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService=new AuthService();
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;
        }

        $name = trim($_POST['name'] ?? "");
        $email = trim($_POST['email'] ?? "");
        $password = trim($_POST['password'] ?? "");

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            header("Location: /register.php");
            exit;
        }

        $success = $this->authService->register($name, $email, $password);

        if (!$success) {
            $_SESSION['error'] = "Email déjà utilisé";
            header("Location: /register.php");
            exit;
        }

        $_SESSION['success'] = "Compte créé avec succès";
        header("Location: /login.php");
        exit;
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] !== "POST"){
            return;
        }
        $email = trim($_POST['email'] ?? "");
        $password = trim($_POST['password'] ?? "");

        if(empty($email) || empty($password)){
            $_SESSION['error']="Email et Mot passe obligatoires";
            header("Location: /login");
            exit;
        }
        $user = $this->authService->login($email,$password);

        if(!$user){
            $_SESSION['error']="Email ou mot de passe incorrect";
            header("Location: /login.php");
            exit;
        }

        $_SESSION["user"] = [
            'id' => $user['id'],
            'name'=> $user['name'],
            'email'=> $user['email'],
            'role'=> $user['role'],
        ];
        header('Location: /dashboard.php');
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login.php");
        exit;
    }
}