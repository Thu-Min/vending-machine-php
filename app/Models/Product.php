<?php

require_once __DIR__ . "/../../config/Database.php";

class Product {
    private static $table = 'products';

    public static function getAll(): array {
        $db = (new Database)->connect();
        $sql = $db->prepare("SELECT * FROM " . self::$table);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id): mixed {
        $db = (new Database)->connect();
        $sql = $db->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name, $price, $quantity): bool {
        $db = (new Database)->connect();
        $sql = $db->prepare("INSERT INTO " . self::$table . " (name, price, quantity) VALUES (:name, :price, :quantity)");
        $sql->bindParam(":name", $name);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":quantity", $quantity);
        $sql->execute();

        return $db->lastInsertId();
    }

    public static function update($id, $name, $price, $quantity): bool {
        $db = (new Database)->connect();
        $sql = $db->prepare("UPDATE " . self::$table . " SET name = :name, price = :price, quantity = :quantity WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":quantity", $quantity);

        return $sql->execute();
    }

    public static function delete($id): bool {
        $db = (new Database)->connect();
        $sql = $db->prepare("DELETE FROM ". self::$table . " WHERE id = :id");
        $sql->bindParam(":id", $id);

        return $sql->execute();
    }
}