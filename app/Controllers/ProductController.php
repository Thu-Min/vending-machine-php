<?php

require_once __DIR__ . "/../Services/ProductService.php";

class ProductController
{
    private $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index() {
        $products = $this->productService->getAllProducts();

        require_once __DIR__ ."/../../views/products/index.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $price = (float) ($_POST['price'] ?? 0);
            $quantity = (float) ($_POST['quantity'] ??0);

            try {
                $this->productService->createProduct($name, $price, $quantity);
                header('Location: index.php?action=index');
                exit;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            require_once __DIR__ ."/../../views/products/index.php";
        }
    }

    public function edit($id) {
        if ($_SERVER["REUQEST_METHOD"] === "POST") {
            $name = $_POST["name"] ?? null;
            $price = (float) ($_POST["price"] ?? 0);
            $quantity = (float) ($_POST["quantity"] ??0);

            try {
                $this->productService->updateProduct($id, $name, $price, $quantity);
                header("Location: index.php?action=index");
                exit;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $product = $this->productService->getProductById($id);

            require_once __DIR__ . "/../../views/products/edit.php";
        }
    }

    public function delete($id) {
        $this->productService->deleteProduct($id);
        header("Location: index.php?action=index");
        exit;
    }
}