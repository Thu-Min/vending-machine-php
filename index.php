<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/routes/userRouter.php";
require_once __DIR__ . "/routes/productRouter.php";
require_once __DIR__ . "/routes/adminRouter.php";

$router = $_GET['router'] ?? null;

switch ($router) {
    case 'product':
        include __DIR__ . '/routes/productRouter.php';
        break;
    case 'user':
        include __DIR__ . '/routes/userRouter.php';
        break;
    case 'admin':
        include __DIR__ . '/routes/adminRouter.php';
        break;
    default:
        echo "Router not found.";
        break;
}