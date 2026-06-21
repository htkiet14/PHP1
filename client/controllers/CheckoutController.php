<?php
class CheckoutController {
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

        require_once __DIR__ . '/../../Models/Cart.php';
        $cartModel = new Cart($this->pdo);

        if ($userId) {
            $cart = $cartModel->getCartByUserId($userId);
            if (!$cart) return null;
            return $cart['id'];
        } else {
            $cart = $cartModel->getCartBySessionId($sessionId);
            if (!$cart) return null;
            return $cart['id'];
        }
    }

    public function render() {
        $cartId = $this->getCartId();
        if (!$cartId) {
            header('Location: index.php?page=cart');
            exit;
        }

        require_once __DIR__ . '/../../Models/CartItem.php';
        require_once __DIR__ . '/../../Models/Order.php';
        require_once __DIR__ . '/../../Models/OrderItem.php';

        $cartItemModel = new CartItem($this->pdo);
        $orderModel = new Order($this->pdo);
        $orderItemModel = new OrderItem($this->pdo);

        $items = $cartItemModel->getItemsByCartId($cartId);
        if (empty($items)) {
            header('Location: index.php?page=cart');
            exit;
        }

        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (empty($fullname) || empty($phone) || empty($address) || empty($email)) {
                $error = 'Vui lòng nhập đầy đủ thông tin.';
                require __DIR__ . '/../views/pages/Checkout.php';
                return;
            }

            $orderData = [
                'fullname' => $fullname,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'total' => $total
            ];
            $orderId = $orderModel->create($orderData);

            if ($orderId) {
                foreach ($items as $item) {
                    $orderItemModel->create($orderId, $item['product_id'], $item['price'], $item['quantity']);
                }
                $cartItemModel->clearCart($cartId);
                header('Location: index.php?page=thankyou&order=' . $orderId);
                exit;
            } else {
                $error = 'Đặt hàng thất bại. Vui lòng thử lại.';
                require __DIR__ . '/../views/pages/Checkout.php';
                return;
            }
        }

        require __DIR__ . '/../views/pages/Checkout.php';
    }
}