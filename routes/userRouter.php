<?php

require_once __DIR__ . "/../app/Services/AuthService.php";
require_once __DIR__ . "/../app/Controllers/AuthController.php";
require_once __DIR__ . "/../app/Controllers/UserController.php";
require_once __DIR__ . "/../app/Middleware/AuthMiddleware.php";

$authService = new AuthService();
$authController = new AuthController($authService);
$userController = new UserController();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $authController->login();
        break;

    case 'register':
        $authController->register();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'home':
        if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated']) {
            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
        } else {
            header("Location: /vending-machine/views/login.php");
            exit;
        }

        break;

    default:
        echo "Invalid action.";
        break;
}
