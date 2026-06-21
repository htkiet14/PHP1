<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Lấy tất cả sản phẩm (kèm tên danh mục) – từ file thứ 2
     */
    public function getAllProducts() {
        $sql = "SELECT product.*, categories.name AS category_name 
                FROM product 
                JOIN categories ON categories.id = product.category_id 
                ORDER BY product.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy chi tiết một sản phẩm theo ID – từ file thứ 2
     */
    public function getOneProduct($id) {
        $sql = "SELECT product.*, categories.name AS category_name 
                FROM product 
                JOIN categories ON categories.id = product.category_id 
                WHERE product.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy sản phẩm phân trang, có lọc theo danh mục và từ khóa – từ file thứ 2
     */
    public function getProductsWithPagination($category_id = 0, $keyword = '', $limit = 6, $offset = 0) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p 
                JOIN categories c ON p.category_id = c.id 
                WHERE 1=1";
        $params = [];
        if ($category_id > 0) {
            $sql .= " AND p.category_id = ?";
            $params[] = (int)$category_id;
        }
        if (!empty($keyword)) {
            $sql .= " AND p.name LIKE ?";
            $params[] = "%$keyword%";
        }
        $sql .= " ORDER BY p.id DESC LIMIT ? OFFSET ?";
        $params[] = (int)$limit;
        $params[] = (int)$offset;
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key+1, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Đếm tổng số sản phẩm (hỗ trợ lọc) – từ file thứ 2
     */
    public function countProducts($category_id = 0, $keyword = '') {
        $sql = "SELECT COUNT(*) FROM product WHERE 1=1";
        $params = [];
        if ($category_id > 0) {
            $sql .= " AND category_id = ?";
            $params[] = (int)$category_id;
        }
        if (!empty($keyword)) {
            $sql .= " AND name LIKE ?";
            $params[] = "%$keyword%";
        }
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key+1, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Thêm sản phẩm mới – từ file thứ 1
     */
    public function addProduct($name, $price, $image, $description, $category_id) {
        $sql = "INSERT INTO product(name, price, image, description, category_id)
                VALUES(?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $price, $image, $description, $category_id]);
    }

    /**
     * Cập nhật sản phẩm – từ file thứ 1
     */
    public function updateProduct($id, $name, $price, $image, $description, $category_id) {
        $sql = "UPDATE product 
                SET name=?, price=?, image=?, description=?, category_id=? 
                WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $price, $image, $description, $category_id, $id]);
    }

    /**
     * Xóa sản phẩm – từ file thứ 1 (tự viết lại SQL thay vì dùng BaseModel::delete)
     */
    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}