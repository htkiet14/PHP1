<?php
class ProductController {
    private $pdo;
    public function __construct($pdo = null) {
        if ($pdo === null) {
            require_once __DIR__ . '/../../config/Database.php';
            $db = new Database();
            $this->pdo = $db->Connection();
        } else {
            $this->pdo = $pdo;
        }
    }

    public function list() {
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        require_once ROOT . '/Models/Product.php';
        require_once ROOT . '/Models/Category.php';

        $productModel = new Product($this->pdo);
        $categoryModel = new Category($this->pdo);

        $products = $productModel->getProductsWithPagination($category_id, $keyword, $limit, $offset);
        $totalProducts = $productModel->countProducts($category_id, $keyword);
        $categories = $categoryModel->getAll();
        $totalPages = ceil($totalProducts / $limit);

        require __DIR__ . '/../views/pages/products/List.php';
    }

    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            die('ID sản phẩm không hợp lệ');
        }

        require_once ROOT . '/Models/Product.php';
        require_once ROOT . '/Models/ProductImages.php';

        $productModel = new Product($this->pdo);
        $product = $productModel->getOneProduct($id);

        if (!$product) {
            die('Sản phẩm không tồn tại');
        }

        // Lấy ảnh phụ
        $imageModel = new ProductImages($this->pdo);
        $images = $imageModel->getByProductId($id);
        $product['images'] = !empty($images) ? array_column($images, 'image_path') : [];

        require __DIR__ . '/../views/pages/products/Detail.php';
    }
}