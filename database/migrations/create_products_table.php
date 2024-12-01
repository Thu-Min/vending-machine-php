<?php

require_once __DIR__ . '/../../config/Database.php';

class CreateProductTable {
    public static function up(): void {
        $db = (new Database())->connect();

        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            quantity INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        try {
            $db->exec($sql);

            echo "Table 'products' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'products': " . $e->getMessage() . "\n";
        }
    }

    public static function down(): void{
        $db = (new Database())->connect();
        
        $sql = "DROP TABLE IF EXISTS products";

        try {
            $db->exec($sql);

            echo "Table 'products' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'products': " . $e->getMessage() . "\n";
        }
    }
}