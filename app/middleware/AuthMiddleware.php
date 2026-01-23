<?php

namespace app\app\middleware;

class AuthMiddleware
{
    public static function check():void{
        if(!isset($_SESSION["user"])){
            $_SESSION["error"] = "Veuillez vous connecter d'abord .";
            header('Location: /login.php');
            exit;
        }
    }

    public static function admin():void{
        self::check();

        if($_SESSION["user"]["role"] !== "admin"){
            $_SESSION['error'] = 'Accès refusé';
            header('Location: /dashboard.php');
            exit;
        }
    }
}