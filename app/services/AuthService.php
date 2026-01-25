<?php

namespace app\app\services;

use app\app\config\Connection;
use PDO;

class AuthService {
    private PDO $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function register(array $data): bool {
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }



    public function login(array $data)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );

        $stmt->execute([
            'email' => $data['email']
        ]);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($data['password'], $user->password)) {
            return $user;
        }

        return false;
    }



}