<?php
class OrderItem {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($orderId, $productId, $price, $qty) {
        $sql = "INSERT INTO order_items (order_id, product_id, price, qty) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId, $productId, $price, $qty]);
        return $this->pdo->lastInsertId();
    }

    public function getByOrderId($orderId) {
        $stmt = $this->pdo->prepare("
            SELECT oi.*, p.name, p.image 
            FROM order_items oi 
            JOIN product p ON oi.product_id = p.id 
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}