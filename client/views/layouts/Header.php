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
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
            border-bottom: 2px solid var(--primary-red);
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

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="/client/index.php?page=home">
                <i class="fas fa-shoe-prints"></i> SoleStyle
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=home">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=list">Sản phẩm</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=cart">Giỏ hàng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=login">Đăng nhập</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=register">Đăng ký</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/client/index.php?page=profile">Tài khoản</a>
                    </li>
                </ul>

                <a href="/client/index.php?page=cart" class="btn btn-outline-red rounded-pill">
                    Giỏ hàng
                </a>

            </div>
        </div>
    </nav>
    <!--  -->
    <main>