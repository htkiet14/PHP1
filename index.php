<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// =======================
// LOAD CONFIG + MODEL
// =======================
require_once "config/database.php";
require_once "Models/Product.php";
require_once "Models/Category.php";

// =======================
// LOAD CONTROLLERS
// =======================
require_once "admin/controllers/DashboardController.php";
require_once "admin/controllers/ProductController.php";
require_once "admin/controllers/CategoryController.php";
require_once "admin/controllers/OrderController.php";
require_once "admin/controllers/UserController.php";


$db = new Database();
$pdo = $db->Connection();


require "admin/views/layouts/header.php";
require "admin/views/layouts/sidebar.php";


$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

   
    case "dashboard":
        $controller = new DashboardController();
        $controller->render();
        break;

   
    case "products":

        $controller = new ProductController();
        $act = $_GET['act'] ?? 'list';

        switch ($act) {

            case "add":
                $controller->add();
                break;

            case "edit":
                $controller->edit();
                break;

            case "delete":
                $controller->delete();
                break;

            default:
                $controller->render();
                break;
        }

        break;

  
    case "categories":

    $controller = new CategoryController();
    $act = $_GET['act'] ?? 'list';

    switch ($act) {

        case "add":
            $controller->add();
            break;

        case "edit":
            $controller->edit();
            break;

        case "delete":
            $controller->delete();
            break;

        default:
            $controller->render();
            break;
    }

    break;

   
    case "orders":
        $controller = new OrderController($pdo);
        $controller->render();
        break;

  
    case "users":
        $controller = new UserController();
        $controller->render();
        break;

    
    default:
        echo '
        <div class="main">
            <div class="alert alert-danger">
                <h2>404 - PAGE NOT FOUND</h2>
            </div>
        </div>
        ';
        break;
}


require "admin/views/layouts/footer.php";
?>