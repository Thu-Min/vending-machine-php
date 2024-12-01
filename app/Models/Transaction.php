<?php

class Transaction {
    private static $table = 'transactions';

    public static function getAll(): array {
        $db = (new Database())->connect();
        $sql = $db->prepare("SELECT * FROM " . self::$table);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id): mixed {
        $db = (new Database())->connect();
        $sql = $db->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($productId, $userId, $quantity, $totalAmount): bool {
        $db = (new Database())->connect();
        $sql = $db->prepare("INSERT INTO " . self::$table . " (product_id, user_id, quantity, total_amount) VALUES (:productId, :userId, :quantity, :totalAmount)");
        $sql->bindParam(":productId", $productId);
        $sql->bindParam(":userId", $userId);
        $sql->bindParam(":quantity", $quantity);
        $sql->bindParam(":totalAmount", $totalAmount);
        $sql->execute();

        return $db->lastInsertId();
    }

    public static function update($id, $productId, $userId, $quantity, $totalAmount): bool {
        $db = (new Database())->connect();
        $sql = $db->prepare("UPDATE " . self::$table . " SET product_id = :productId, user_id = :userId, quantity = :quantity, totalAmount = :totalAmount WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":productId", $productId);
        $sql->bindParam(":userId", $userId);
        $sql->bindParam(":quantity", $quantity);
        $sql->bindParam(":totalAmount", $totalAmount);

        return $sql->execute();
    }
    
    public static function delete($id): bool {
        $db = (new Database())->connect();
        $sql = $db->prepare("DELETE FROM ". self::$table . " WHERE id = :id");
        $sql->bindParam(":id", $id);

        return $sql->execute();
    }
}