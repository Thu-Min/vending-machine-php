<?php
// Simulate POST data for testing directly via command line
$_POST['username'] = 'testusertwo';
$_POST['password'] = 'testpassword';
$_POST['role'] = 'user';

// Simulate a POST request method
$_SERVER['REQUEST_METHOD'] = 'POST';

// Include necessary files
require_once __DIR__ . "/../app/Services/AuthService.php";
require_once __DIR__ . "/../app/Controllers/UserController.php";

// Create instances of the service and controller
$userService = new AuthService();
$controller = new UserController($userService);

// Directly call the register method
$controller->register();
