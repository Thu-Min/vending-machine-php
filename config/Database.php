<?php

class Database {
    private $host = '127.0.0.1:3306';
    private $db = 'vending_machine';
    private $user = 'root';
    private $password = '';
    private $pdo;

    public function connect() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO("mysql:dbname=$this->db", $this->user, $this->password);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}