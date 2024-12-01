<?php

require_once __DIR__ . "/../Services/AuthService.php";
require_once __DIR__ . "/../Controllers/AuthController.php";

$authService = new AuthService();
$controller = new AuthController($authService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'login':
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$username || !$password) {
                echo "Both username and password are required!";
                exit;
            }

            $controller->login();

            break;
        
        case "register":
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
        
            if (!$username || !$password) {
                echo "Username and password are required!";
                exit;
            }
        
            $controller->register();    

            break;

        case "logout":
            $controller->logout();

            break;

        default:
            echo "";
            break;
    }


} else {
    echo "Invalid request method.";
}
