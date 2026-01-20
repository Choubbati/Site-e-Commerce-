<?php

namespace app\app\services;

use app\app\config\Connection;
use PDO;

class AuthService
{
    private PDO $pdo;
    public function __construct(){
        $this->conn = Connection::getConnection();
    }

    public function register(string $name,string $email,string $password):bool{
        $check = $this->conn->prepare("SELECT id FROM users WHERE email = ? ");
        $check->execute([$email]);

        if ($check->rowCount() > 0){
            return false;
        }

        $hashPassword = password_hash($password,PASSWORD_BCRYPT);

        $sql = $this->conn->prepare("INSERT INTO users(name,email,password) VALUES (?,?,?)");
        return
            $sql->execute([
            $name,
            $email,
            $hashPassword
        ]);
    }


    public function login(string $email,string $password)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE email=? AND is_active = 1");
        $sql->execute([$email]);

        $user = $sql->fetch();
        if(!$user){
            return false;
        }

        if (!password_verify($password,$user["password"])){
            return false;
        }

        return $user;

    }
}