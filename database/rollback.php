<?php

require_once __DIR__ . '/migrations/create_products_table.php';
require_once __DIR__ . '/migrations/create_users_table.php';
require_once __DIR__ . '/migrations/create_transactions_table.php';

echo "Rolling Back Migrations...\n";

try {
    CreateProductTable::down();
    CreateUserTable::down();
    CreateTransactionTable::down();

    echo "Rollback completed successfully.\n";
} catch (Exception $e) {
    echo "Rollback failed: " . $e->getMessage() ."\n";
}