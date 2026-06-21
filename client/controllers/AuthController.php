<?php
class AuthController {
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

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            if (empty($email) || empty($password)) {
                $error = 'Vui lòng nhập email và mật khẩu.';
                require __DIR__ . '/../views/pages/login.php';
                return;
            }

            require_once ROOT . '/Models/User.php';
            $userModel = new User($this->pdo);
            $user = $userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                if ($remember) {
                    setcookie('user_id', $user['id'], time() + 86400 * 30, '/');
                    setcookie('username', $user['username'], time() + 86400 * 30, '/');
                }
                $this->mergeCartToUser($user['id']);
                header('Location: index.php?page=profile');
                exit;
            } else {
                $error = 'Email hoặc mật khẩu không đúng.';
                require __DIR__ . '/../views/pages/login.php';
                return;
            }
        } else {
            require __DIR__ . '/../views/pages/login.php';
        }
    }

    private function mergeCartToUser($userId) {
        $sessionId = session_id();
        require_once ROOT . '/Models/Cart.php';
        require_once ROOT . '/Models/CartItem.php';
        $cartModel = new Cart($this->pdo);
        $cartItemModel = new CartItem($this->pdo);

        $userCart = $cartModel->getCartByUserId($userId);
        if (!$userCart) {
            $userCartId = $cartModel->create($userId, null);
        } else {
            $userCartId = $userCart['id'];
        }

        $sessionCart = $cartModel->getCartBySessionId($sessionId);
        if ($sessionCart) {
            $sessionCartId = $sessionCart['id'];
            $items = $cartItemModel->getItemsByCartId($sessionCartId);
            foreach ($items as $item) {
                $cartItemModel->addItem($userCartId, $item['product_id'], $item['quantity'], $item['price']);
            }
            $cartModel->delete($sessionCartId);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            $errors = [];
            if (strlen($fullname) < 3) $errors[] = 'Họ tên phải từ 3 ký tự.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
            if (strlen($password) < 6) $errors[] = 'Mật khẩu phải từ 6 ký tự.';
            if ($password !== $confirm) $errors[] = 'Mật khẩu xác nhận không khớp.';
            if (empty($phone)) $errors[] = 'Số điện thoại không được để trống.';

            if (empty($errors)) {
                require_once ROOT . '/Models/User.php';
                $userModel = new User($this->pdo);
                if ($userModel->findByEmail($email)) {
                    $errors[] = 'Email đã được đăng ký.';
                } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $data = [
                        'username' => $fullname,
                        'email' => $email,
                        'password' => $hashed,
                        'fullname' => $fullname,
                        'phone' => $phone,
                        'address' => $address,
                        'role' => 'user'
                    ];
                    if ($userModel->create($data)) {
                        header('Location: index.php?page=login&registered=1');
                        exit;
                    } else {
                        $errors[] = 'Đăng ký thất bại. Vui lòng thử lại.';
                    }
                }
            }
            $error = implode('<br>', $errors);
            require __DIR__ . '/../views/pages/register.php';
        } else {
            require __DIR__ . '/../views/pages/register.php';
        }
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $userId = $_SESSION['user_id'];
        require_once ROOT . '/Models/User.php';
        require_once ROOT . '/Models/Order.php';
        $userModel = new User($this->pdo);
        $orderModel = new Order($this->pdo);

        $user = $userModel->getById($userId);
        if (!$user) {
            session_destroy();
            header('Location: index.php?page=login');
            exit;
        }

        $orders = $orderModel->getByUserEmail($user['email']);
        require __DIR__ . '/../views/pages/Profile.php';
    }

    public function logout() {
        session_destroy();
        setcookie('user_id', '', time() - 3600, '/');
        setcookie('username', '', time() - 3600, '/');
        header('Location: index.php?page=home');
        exit;
    }
}