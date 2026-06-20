<?php
class Cart {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getItemsByCartId($cartId) {
    $stmt = $this->pdo->prepare("
        SELECT ci.*, p.name, p.image 
        FROM cart_item ci 
        JOIN product p ON ci.product_id = p.id 
        WHERE ci.cart_id = ?
    ");
    $stmt->execute([$cartId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function getCartByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCartBySessionId($sessionId) {
        $stmt = $this->pdo->prepare("SELECT * FROM cart WHERE session_id = ?");
        $stmt->execute([$sessionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($userId = null, $sessionId = null) {
        $sql = "INSERT INTO cart (user_id, session_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $sessionId]);
        return $this->pdo->lastInsertId();
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE id = ?");
        return $stmt->execute([$id]);
    }
}