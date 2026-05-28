<?php
class AuthController {
    public function login() {
        require "views/pages/login.php";
    }

    public function register() {
        require "views/pages/register.php";
    }

    public function profile() {
        require "views/pages/Profile.php";
    }
}