<!DOCTYPE html>
<html lang="vi">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin MVC</title>


    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- FONT AWESOME -->

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>

        body{
            background:#f1f5f9;
        }

        .sidebar{

            width:250px;

            height:100vh;

            background:#0f172a;

            position:fixed;

            top:0;

            left:0;

            padding:20px;
        }

        .sidebar h2{

            color:white;

            text-align:center;

            margin-bottom:30px;
        }

        .sidebar .nav-link{

            color:white;

            margin:10px 0;

            border-radius:10px;

            padding:12px;
        }

        .sidebar .nav-link:hover{

            background:#1e293b;
        }

        .main{

            margin-left:250px;

            padding:20px;
        }

        .topbar{

            background:white;

            padding:15px 20px;

            border-radius:10px;

            box-shadow:0 2px 5px rgba(0,0,0,0.1);

            margin-bottom:20px;
        }

        .card{

            border:none;

            border-radius:15px;

            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <h2>ADMIN</h2>

    <ul class="nav flex-column">


        <li class="nav-item">

            <a class="nav-link" href="index.php?page=dashboard">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>

        </li>



        <li class="nav-item">

            <a class="nav-link" href="index.php?page=products">

                <i class="fa-solid fa-box"></i>

                Quản lý sản phẩm

            </a>

        </li>



        <li class="nav-item">

            <a class="nav-link" href="index.php?page=categories">

                <i class="fa-solid fa-list"></i>

                Quản lý danh mục

            </a>

        </li>



        <li class="nav-item">

            <a class="nav-link" href="index.php?page=orders">

                <i class="fa-solid fa-cart-shopping"></i>

                Quản lý đơn hàng

            </a>

        </li>



        <li class="nav-item">

            <a class="nav-link" href="index.php?page=users">

                <i class="fa-solid fa-users"></i>

                Quản lý tài khoản

            </a>

        </li>

    </ul>

</div>



<!-- MAIN -->

<div class="main">

    <div class="topbar d-flex justify-content-between align-items-center">

        <h3>Trang Quản Trị</h3>

        <button class="btn btn-danger">

            Đăng xuất

        </button>

    </div>