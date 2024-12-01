<?php

require_once __DIR__ . '/../../config/Database.php';

class CreateTransactionTable {
    public static function up(): void {
        $db = (new Database())->connect();

        $sql = "CREATE TABLE IF NOT EXISTS transactions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            user_id INT NOT NULL,
            quantity INT NOT NULL,
            total_amount DECIMAL(10, 2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )";

        try {
            $db->exec($sql);

            echo "Table 'transactions' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'transactions': " . $e->getMessage() . "\n";
        }
    }

    public static function down(): void {
        $db = (new Database())->connect();

        $sql = "DROP TABLE IF EXISTS transactions";

        try {
            $db->exec($sql);

            echo "Table 'transactions' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'transactions': " . $e->getMessage() . "\n";
        }
    }
}