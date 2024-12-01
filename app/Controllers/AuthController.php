<?php

require_once __DIR__ . "/../Services/AuthService.php";

class AuthController
{
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;
            $role = $_POST['role'] ?? 'user';
    
            if (!$username || !$password) {
                echo "Username and password are required!";
                return;
            }
    
            $result = $this->authService->register($username, $password, $role);
    
            if ($result) {
                session_start();

                if ($_SESSION['role'] !== 'admin') {
                    header("Location: /vending-machine/views/user/home.php");
                    exit;
                } else {
                    header("Location: /vending-machine/views/admin/dashboard.php");
                    exit;
                }
            } else {
                echo "Failed to register user.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;

            if (!$username || !$password) {
                echo "Username and password are required!";
            
                return;
            }

            $result = $this->authService->login($username, $password);

            if ($result) {
                session_start();

                if ($_SESSION['role'] !== 'Admin') {
                    header("Location: /vending-machine/views/user/home.php");
                    exit;
                } else {
                    header("Location: /vending-machine/views/admin/dashboard.php");
                    exit;
                }                
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function logout() {
        $this->authService->logout();

        header("Location: /vending-machine/views/login.php");
        exit;
    }
}