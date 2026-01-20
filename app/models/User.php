<?php

namespace app\app\models;

use app\app\config\Connection;

class User
{
    private $connec;

    public function __construct(){
        $this->conn=Connection::getConnection();
    }


    public function  getAll():array
    {
        $sql = $this->conn->query("SELECT id,name,role,is_Active FROM users");
        return $sql->fetchAll();
    }


    public  function getOne(int $id): ?array
    {
        $sql = $this->conn->prepare("SELECT id,name,role,is_Active FROM users WHERE id=:id");
        $sql->execute(["id"=>$id]);

        return $sql->fetch() ?: null;
    }

    public function Create(string $name,string $email,string $password,string $role='client'):bool{
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);

        $sql = $this->conn->prepare('INSERT INTO users(name,email,password,role) VALUES(:name,:email,:password,:role)');
        return  $sql->execute([
            "name"=>$name,
            "email"=>$email,
            "password"=>$hashPassword,
            "role"=>$role
        ]);

    }


    //actualisé status user

    public function toggleActive(int $id,bool $isActive):bool{

        $sql =$this->conn->prepare("UPDATE users SET is_active=:active WHERE id=:id");
        return $sql->execute([
            "id"=>$id,
            "active"=>$isActive,
        ]);
    }

}