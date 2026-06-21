<?php
class ProductImages {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByProductId($productId) {
        $stmt = $this->pdo->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}