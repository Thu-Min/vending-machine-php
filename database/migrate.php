<?php

require_once __DIR__ . '/migrations/create_products_table.php';
require_once __DIR__ . '/migrations/create_users_table.php';
require_once __DIR__ . '/migrations/create_transactions_table.php';

echo "Running Migrations...\n";

try {
    CreateProductTable::up();
    CreateUserTable::up();
    CreateTransactionTable::up();

    echo "Migrations completed successfully.\n";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() ."\n";
}