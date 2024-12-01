<?php

require_once __DIR__ . "/../Models/Product.php";

class ProductService {
    public function getAllProducts() {
        return Product::getAll();
    }

    public function getProductById($id) {
        return Product::getById($id);
    }

    public function createProduct($name, $price, $quantity) {
        if ($price < 0 || $quantity < 0) {
            throw new Exception("Price and quantity must be non-negative values.");
        }

        return Product::create($name, $price, $quantity);
    }

    public function updateProduct($id, $name, $price, $quantity) {
        if ($price < 0 || $quantity < 0) {
            throw new Exception("Price and quantity must be non-negative values.");
        }

        return Product::update($id, $name, $price, $quantity);
    }

    public function deleteProduct($id) {
        return Product::delete($id);
    }
}