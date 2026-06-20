<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__DIR__));

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load controllers
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CartController.php';
require_once __DIR__ . '/controllers/CheckoutController.php';
require_once __DIR__ . '/controllers/AuthController.php';

require_once __DIR__ . '/../config/Database.php';
require_once ROOT . '/Models/Product.php';
require_once ROOT . '/Models/Category.php';

$db = new Database();
$pdo = $db->Connection();
$productModel = new Product($pdo);
$categoryModel = new Category($pdo);
$danhSachSanPham = $productModel->getAllProducts();
$danhSachDanhMuc = $categoryModel->getAll();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Xử lý các action đặc biệt TRƯỚC header
switch ($page) {
    case 'cart_add':
        (new CartController())->addToCart();
        exit;
    case 'cart_update':
        (new CartController())->updateQuantity();
        exit;
    case 'cart_remove':
        (new CartController())->removeItem();
        exit;
    case 'logout':
        (new AuthController())->logout();
        exit;
}

require_once __DIR__ . '/views/layouts/Header.php';

switch ($page) {
    case 'home':
        (new HomeController())->render();
        break;
    case 'list':
        (new ProductController())->list();
        break;
    case 'detail':
        (new ProductController())->detail();
        break;
    case 'cart':
        (new CartController())->render();
        break;
    case 'checkout':
        (new CheckoutController())->render();
        break;
    case 'login':
        (new AuthController())->login();
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'profile':
        (new AuthController())->profile();
        break;
    case 'thankyou':
        require __DIR__ . '/views/pages/thankyou.php';
        break;
    default:
        echo "<div class='main'><div class='alert alert-danger'><h2>404 NOT FOUND</h2></div></div>";
        break;
}

require_once __DIR__ . '/views/layouts/Footer.php';
ob_end_flush();