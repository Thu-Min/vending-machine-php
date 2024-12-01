<?php

require_once __DIR__ . '/../../config/Database.php';

class CreateUserTable {

    public static function up(): void {
        $db = (new Database())->connect();

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('Admin', 'User') NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        try {
            $db->exec($sql);

            echo "Table 'users' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'users': " . $e->getMessage() . "\n";
        }
    }

    public static function down(): void {
        $db = (new Database())->connect();

        $sql = "DROP TABLE IF EXISTS users";

        try {
            $db->exec($sql);

            echo "Table 'users' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'users': " . $e->getMessage() . "\n";
        }
    }
}