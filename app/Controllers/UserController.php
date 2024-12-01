<?php

require_once __DIR__ . "/../Services/AuthService.php";

class UserController
{
    public function getAllUsers() {
        $users = User::getAll();

        require_once __DIR__ ."/../../views/admin/user/index.php";
    }
}