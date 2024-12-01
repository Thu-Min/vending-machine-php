<?php

require_once __DIR__ . "/../config/Database.php";

$database = new Database();
$connection = $database->connect();

if ($connection) {
    echo "Database connection is successful!";
} else{
    echo "Failed to connect to the database";
}