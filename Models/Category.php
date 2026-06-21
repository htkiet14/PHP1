<?php
class Category {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ── Từ file thứ 1 ──
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM categories ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ── Từ file thứ 2 (bổ sung các phương thức mà không kế thừa BaseModel) ──
    public function getAllCategories() {
        return $this->getAll();
    }

    public function getOneCategory($id) {
        return $this->getById($id);
    }

    public function addCategory($name) {
        $sql = "INSERT INTO categories(name) VALUES(?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name]);
    }

    public function updateCategory($id, $name) {
        $sql = "UPDATE categories SET name=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $id]);
    }

    // Tiện ích thêm: xóa danh mục (nếu cần)
    public function deleteCategory($id) {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}