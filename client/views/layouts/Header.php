<?php
// Đảm bảo session đã được bắt đầu (index.php đã bắt đầu)
// Lấy thông tin user từ session
$user_logged_in = isset($_SESSION['user_id']);
$user_name = $user_logged_in ? ($_SESSION['username'] ?? 'User') : '';
$user_role = $user_logged_in ? ($_SESSION['role'] ?? 'user') : '';

// Tính số lượng sản phẩm trong giỏ hàng
$cart_count = 0;
if ($user_logged_in) {
    // Nếu đã đăng nhập, lấy giỏ hàng từ database
    if (isset($pdo)) {
        require_once __DIR__ . '/../../../Models/Cart.php';
        require_once __DIR__ . '/../../../Models/CartItem.php';
        $cartModel = new Cart($pdo);
        $cartItemModel = new CartItem($pdo);
        $cart = $cartModel->getCartByUserId($_SESSION['user_id']);
        if ($cart) {
            $items = $cartItemModel->getItemsByCartId($cart['id']);
            $cart_count = array_sum(array_column($items, 'quantity'));
        }
    }
} else {
    // Nếu chưa đăng nhập, lấy từ session cart
    if (isset($_SESSION['cart'])) {
        $cart_count = array_sum(array_column($_SESSION['cart'], 'quantity'));
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'SoleStyle - Giày Dép Chính Hãng'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <!-- jQuery (cần cho AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1e1e2a;
        }

        :root {
            --primary-red: #e3342f;
            --primary-red-dark: #c62828;
            --light-red-bg: #fff5f5;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(227, 52, 47, 0.2);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--primary-red) !important;
        }

        .navbar-brand i {
            color: var(--primary-red);
        }

        .nav-link {
            font-weight: 500;
            color: #2c2c3a !important;
            transition: 0.2s;
            margin: 0 6px;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-red);
            border-radius: 2px;
        }

        /* Cart badge */
        .cart-badge {
            background-color: var(--primary-red);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.7rem;
            font-weight: 700;
            margin-left: 4px;
            position: relative;
            top: -8px;
        }

        /* Buttons */
        .btn-red {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            color: white;
            font-weight: 600;
            border-radius: 40px;
            padding: 0.5rem 1.5rem;
            transition: 0.2s;
        }

        .btn-red:hover {
            background-color: var(--primary-red-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(227, 52, 47, 0.3);
        }

        .btn-outline-red {
            border: 2px solid var(--primary-red);
            background: transparent;
            color: var(--primary-red);
            font-weight: 600;
            border-radius: 40px;
            padding: 0.4rem 1.2rem;
            transition: 0.2s;
        }

        .btn-outline-red:hover {
            background-color: var(--primary-red);
            color: white;
        }

        /* Product card */
        .product-card {
            border: none;
            border-radius: 24px;
            background: white;
            transition: all 0.25s;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(227, 52, 47, 0.15);
            border-bottom: 2px solid var(--primary-red);
        }

        .price {
            font-weight: 800;
            color: var(--primary-red);
            font-size: 1.4rem;
        }

        .old-price {
            text-decoration: line-through;
            color: #9aa0ac;
            font-size: 0.9rem;
            margin-left: 8px;
        }

        footer {
            background: #fefefe;
            border-top: 1px solid rgba(227, 52, 47, 0.2);
            margin-top: 3rem;
            padding: 2rem 0;
        }

        .section-title {
            font-weight: 700;
            position: relative;
            margin-bottom: 2rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary-red);
            border-radius: 4px;
        }

        /* Profile avatar in nav */
        .nav-avatar {
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary-red);
            color: white;
            text-align: center;
            line-height: 32px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-right: 6px;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }
            .nav-link.active::after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php?page=home">
                <i class="fas fa-shoe-prints"></i> SoleStyle
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page ?? '') == 'home' ? 'active' : '' ?>" href="index.php?page=home">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page ?? '') == 'list' ? 'active' : '' ?>" href="index.php?page=list">
                            <i class="fas fa-th-list"></i> Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page ?? '') == 'cart' ? 'active' : '' ?>" href="index.php?page=cart">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                            <?php if ($cart_count > 0): ?>
                                <span class="cart-badge"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <?php if ($user_logged_in): ?>
                        <!-- Đã đăng nhập -->
                        <li class="nav-item">
                            <a class="nav-link <?= ($page ?? '') == 'profile' ? 'active' : '' ?>" href="index.php?page=profile">
                                <span class="nav-avatar"><?= strtoupper(substr($user_name, 0, 1)) ?></span>
                                <?= htmlspecialchars($user_name) ?>
                            </a>
                        </li>
                        <?php if ($user_role === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/index.php" target="_blank">
                                    <i class="fas fa-tachometer-alt"></i> Admin
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Chưa đăng nhập -->
                        <li class="nav-item">
                            <a class="nav-link <?= ($page ?? '') == 'login' ? 'active' : '' ?>" href="index.php?page=login">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page ?? '') == 'register' ? 'active' : '' ?>" href="index.php?page=register">
                                <i class="fas fa-user-plus"></i> Đăng ký
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <a href="index.php?page=cart" class="btn btn-outline-red rounded-pill position-relative">
                    <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    <?php if ($cart_count > 0): ?>
                        <span class="badge bg-danger rounded-pill ms-1"><?= $cart_count ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </nav>
    <main>