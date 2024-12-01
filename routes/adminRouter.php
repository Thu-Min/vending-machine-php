<?php

require_once __DIR__ . "/../app/Controllers/UserController.php";
require_once __DIR__ . "/../app/Middleware/AuthMiddleware.php";

AuthMiddleware::checkAdmin();

$userController = new UserController();

$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'dashboard':
        $authController->login();
        break;

    case 'get-all-users':
        $userController->getAllUsers();
        break;

    default:
        echo "Invalid action.";
        break;
}
