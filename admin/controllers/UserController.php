<?php


class UserController {

    public function render(){

        $db = new Database();

        $pdo = $db->Connection();

        $userModel = new User($pdo);

        // lấy dữ liệu
        $users = $userModel->getAllUsers();

        // truyền sang view
        require "admin/views/users/index.php";

    }

}