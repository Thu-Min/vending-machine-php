<?php

require_once __DIR__ . "/../Models/User.php";

class AuthService {
    private const HASH_ALGO = PASSWORD_BCRYPT;

    public function register($username, $password, $role) {
        $hashPassword = password_hash($password, self::HASH_ALGO);

        $response = User::create($username, $hashPassword, $role);

        if ($response) {
            $user = User::getByUsername($username);

            if ($user) {
                session_start();
                $_SESSION['isAuthenticated'] = true;
                $_SESSION['userId'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                return true;
            }

            return false;
        }

        return false;
    }    

    public function login($username, $password) {
        $user = User::getByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['isAuthenticated'] = true;
            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            return true;
        }

        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_unset();
        session_destroy();
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function hasRole($role) {
        return $this->isAuthenticated() && $_SESSION['role'] === $role;
    }
}