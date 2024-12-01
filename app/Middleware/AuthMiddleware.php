<?php

class AuthMiddleware
{
    public static function checkAdmin() {
        session_start();

        if (!isset($_SESSION['isAuthenticated']) || $_SESSION['role'] !== 'Admin') {
            header("Location: /vending-machine/views/login.php");
            exit;
        }
    }

    public static function checkUser()
    {
        session_start();

        if (!isset($_SESSION['isAuthenticated']) || $_SESSION['role'] !== 'User') {
            header("Location: /vending-machine/views/login.php");
            exit;
        }
    }
}
