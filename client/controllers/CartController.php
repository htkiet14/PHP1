<?php
class CartController {
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

    private function getCartId() {
        $userId = $_SESSION['user_id'] ?? null;
        $sessionId = session_id();

        // Đảm bảo session_id không rỗng
        if (empty($sessionId) && !$userId) {
            // Nếu không có session_id, tạo mới
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $sessionId = session_id();
        }

        require_once ROOT . '/Models/Cart.php';
        $cartModel = new Cart($this->pdo);

        if ($userId) {
            $cart = $cartModel->getCartByUserId($userId);
            if ($cart) {
                return $cart['id'];
            } else {
                return $cartModel->create($userId, null);
            }
        } else {
            $cart = $cartModel->getCartBySessionId($sessionId);
            if ($cart) {
                return $cart['id'];
            } else {
                return $cartModel->create(null, $sessionId);
            }
        }
    }

    public function render() {
        $cartId = $this->getCartId();
        $items = [];
        $total = 0;
        if ($cartId) {
            require_once ROOT . '/Models/CartItem.php';
            $cartItemModel = new CartItem($this->pdo);
            $items = $cartItemModel->getItemsByCartId($cartId);
            foreach ($items as &$item) {
                $item['subtotal'] = $item['price'] * $item['quantity'];
                $total += $item['subtotal'];
            }
        }
        require __DIR__ . '/../views/pages/Cart.php';
    }

    public function addToCart() {
        // Tắt output không mong muốn
        error_reporting(0);
        header('Content-Type: application/json');
        try {
            $productId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            if ($productId <= 0 || $quantity <= 0) {
                throw new Exception('Dữ liệu không hợp lệ');
            }

            $cartId = $this->getCartId();
            require_once ROOT . '/Models/CartItem.php';
            require_once ROOT . '/Models/Product.php';
            $cartItemModel = new CartItem($this->pdo);
            $productModel = new Product($this->pdo);

            $product = $productModel->getOneProduct($productId);
            if (!$product) {
                throw new Exception('Sản phẩm không tồn tại');
            }

            $cartItemModel->addItem($cartId, $productId, $quantity, $product['price']);

            $items = $cartItemModel->getItemsByCartId($cartId);
            $totalQty = array_sum(array_column($items, 'quantity'));

            echo json_encode(['status' => 'success', 'cart_total' => $totalQty]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function updateQuantity() {
        header('Content-Type: application/json');
        try {
            $itemId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
            if ($itemId <= 0 || $quantity <= 0) {
                throw new Exception('Dữ liệu không hợp lệ');
            }
            require_once ROOT . '/Models/CartItem.php';
            $cartItemModel = new CartItem($this->pdo);
            $result = $cartItemModel->updateQuantity($itemId, $quantity);
            echo json_encode(['status' => $result ? 'success' : 'error']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }

    public function removeItem() {
        $itemId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($itemId <= 0) {
            header('Location: index.php?page=cart');
            exit;
        }
        require_once ROOT . '/Models/CartItem.php';
        $cartItemModel = new CartItem($this->pdo);
        $cartItemModel->removeItem($itemId);
        header('Location: index.php?page=cart');
        exit;
    }
}