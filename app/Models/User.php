<?php

require_once __DIR__ . "/../../config/Database.php";

class User {
    private static $table = 'users';

    public static function getAll(): array {
        $db = (new Database)->connect();
        $sql = $db->prepare('SELECT * FROM ' . self::$table);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = (new Database)->connect();
        $sql = $db->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($username, $password, $role) {
        $db = (new Database)->connect();
        echo "Database connected";  // Debugging if the database connection works
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        // $sql->bindParam(":username", $username);
        // $sql->bindParam(":password", $password);
        // $sql->bindParam(":role", $role);
    

        try {
            $result = $db->exec($sql);

            echo "DATA INSERTED SUCCESSFULLY!";
        } catch (PDOException $e) {
            echo "ERROR: ". $e->getMessage();
        }
        
        echo "SQL executed: " . ($result ? 'Success' : 'Failure');  // Check if the query runs
    
        return $db->lastInsertId();  // Ensure this returns a valid ID
    }
    

    public static function update($id, $username, $password, $role) {
        $db = (new Database)->connect();
        $sql = $db->prepare("UPDATE " . self::$table . " SET username = :username, password = :password, role = :role WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":username", $username);
        $sql->bindParam(":password", $password);
        $sql->bindParam(":role", $role);

        return $sql->execute();
    }

    public static function delete($id): bool {
        $db = (new Database)->connect();
        $sql = $db->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
        $sql->bindParam(":id", $id);

        return $sql->execute();
    }

    public static function getByUsername($username) {
        $db = (new Database)->connect();
        $sql = $db->prepare("SELECT * FROM ". self::$table . " WHERE username = :username");
        $sql->bindParam(":username", $username);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}