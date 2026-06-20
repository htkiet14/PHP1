<?php
class CartItem {
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
            ORDER BY ci.id ASC
        ");
        $stmt->execute([$cartId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Các phương thức khác giữ nguyên
    public function findItem($cartId, $productId) {
        $stmt = $this->pdo->prepare("SELECT * FROM cart_item WHERE cart_id = ? AND product_id = ?");
        $stmt->execute([$cartId, $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addItem($cartId, $productId, $quantity, $price) {
        $existing = $this->findItem($cartId, $productId);
        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $stmt = $this->pdo->prepare("UPDATE cart_item SET quantity = ? WHERE id = ?");
            $stmt->execute([$newQty, $existing['id']]);
            return $existing['id'];
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO cart_item (cart_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cartId, $productId, $quantity, $price]);
            return $this->pdo->lastInsertId();
        }
    }

    public function updateQuantity($id, $quantity) {
        $stmt = $this->pdo->prepare("UPDATE cart_item SET quantity = ? WHERE id = ?");
        return $stmt->execute([$quantity, $id]);
    }

    public function removeItem($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cart_item WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function clearCart($cartId) {
        $stmt = $this->pdo->prepare("DELETE FROM cart_item WHERE cart_id = ?");
        return $stmt->execute([$cartId]);
    }
}