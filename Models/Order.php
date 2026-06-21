<?php
class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Tạo đơn hàng mới (từ file 1)
     */
    public function create($data) {
        $sql = "INSERT INTO orders (fullname, phone, address, email, total) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['fullname'],
            $data['phone'],
            $data['address'],
            $data['email'],
            $data['total']
        ]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Lấy đơn hàng theo ID (từ file 1)
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tất cả đơn hàng, sắp xếp mới nhất trước (từ file 1)
     */
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy đơn hàng theo email khách hàng (từ file 1)
     */
    public function getByUserEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE email = ? ORDER BY created_at DESC");
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tất cả đơn hàng (không sắp xếp) – bổ sung từ file 2
     */
    public function getAllOrder() {
        $sql = "SELECT * FROM `orders`";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}