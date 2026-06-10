<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// LOAD CONTROLLER

require_once "admin/controllers/DashboardController.php";
require_once "admin/controllers/ProductController.php";
require_once "admin/controllers/CategoryController.php";
require_once "admin/controllers/OrderController.php";
require_once "admin/controllers/UserController.php";


// LOAD GIAO DIỆN
require "admin/views/layouts/header.php";
require "admin/views/layouts/sidebar.php";
require "Models/Product.php";
require "config/database.php";

$db = new Database();
$pdo = $db->Connection();

$product = new Product($pdo);
$danhSachSanPham = $product->getAllProducts();


// KIỂM TRA PAGE
if(isset($_GET['page']) && !empty($_GET['page'])){
    switch($_GET['page']){
        // DASHBOARD
        case "dashboard":
            $controller = new DashboardController();
            $controller->render();
            break;

        // PRODUCTS
        case "products":
            $controller = new ProductController();
            $controller->render();
            break;



        // CATEGORIES
        case "categories":
            $controller = new CategoryController();
            $controller->render();
            break;

        // ORDERS
        case "orders":
            $controller = new OrderController();
            $controller->render();
            break;

        // USERS
        case "users":
            $controller = new UserController();
            $controller->render();
            break;


        // 404
        default:
            echo "
            <div class='main'>
                <div class='alert alert-danger'>
                    <h2>404 NOT FOUND</h2>
                </div>
            </div>
            ";
            break;
    }
}else{

    // MẶC ĐỊNH
    $controller = new DashboardController();
    $controller->render();
}


// FOOTER
require "admin/views/layouts/footer.php";
?>