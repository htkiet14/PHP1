<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Đường dẫn đúng – không có 'client/' ở đầu
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CartController.php";
require_once "controllers/CheckoutController.php";
require_once "controllers/AuthController.php";

// Load giao diện header
require "views/layouts/Header.php";

// Xử lý page từ URL (ví dụ: ?page=home)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->render();
        break;

    case 'list':
        $controller = new ProductController();
        $controller->list();
        break;

    case 'detail':
        $controller = new ProductController();
        $controller->detail();
        break;

    case 'cart':
        $controller = new CartController();
        $controller->render();
        break;

    case 'checkout':
        $controller = new CheckoutController();
        $controller->render();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'profile':
        $controller = new AuthController();
        $controller->profile();
        break;

    default:
        echo "Trang không tồn tại";
        break;
}

// Load giao diện footer
require "views/layouts/Footer.php";
?>