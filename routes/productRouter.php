<?php

require_once __DIR__ . "/../app/Services/ProductService.php";
require_once __DIR__ . "/../app/Controllers/ProductController.php";
require_once __DIR__ . "/../app/Middleware/AuthMiddleware.php";

$productService = new ProductService();
$controller = new ProductController($productService);

$action = $_GET['action'] ?? 'index';

if (in_array($action, ['create', 'edit', 'delete'])) {
    AuthMiddleware::checkAdmin();
}

switch ($action) {
    case 'index':
        $controller->index();
        break;
        
    case 'create':
        $controller->create();
        break;

    case 'edit':
        $id = (int) ($_GET['id'] ?? 0);
        $controller->edit($id);
        break;

    case 'delete':
        $id = (int) ($_GET['id'] ?? 0);
        $controller->edit($id);
        break;

    default:
        echo "Invalid action.";
}