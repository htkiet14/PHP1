<?php
class HomeController {
    public function render() {
        // Kết nối database
        require_once __DIR__ . '/../../config/Database.php';
        $db = new Database();
        $pdo = $db->Connection();

        // Load model Product
        require_once __DIR__ . '/../../Models/Product.php';
        $productModel = new Product($pdo);

        // Load model Category
        require_once __DIR__ . '/../../Models/Category.php';
        $categoryModel = new Category($pdo);

        // Lấy tất cả sản phẩm
        $allProducts = $productModel->getAllProducts();

        // Lấy 4 sản phẩm nổi bật (có thể thay đổi logic)
        $featured = array_slice($allProducts, 0, 4);

        // Lấy danh sách danh mục (để hiển thị trên home)
        $categories = $categoryModel->getAll();

        // Truyền dữ liệu vào view
        require __DIR__ . '/../views/pages/Home.php';
    }
}