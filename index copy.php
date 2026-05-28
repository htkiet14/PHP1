<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['username'])) {
    echo "Xin chào " . $_SESSION['username'];
} else {
    echo "Bạn chưa đăng nhập";
}

$danhSachSanPham = [
    [
        "ten_san_pham" => "Iphone 16 promax Galaxy A51 SamSung",
        "gia" => 14000,
        "Hinh_anh" => "https://tpmobile.vn/wp-content/uploads/2024/12/2.png",
        "desccription" => "Day la mo ta ngan cua san pham Iphone 16 promax Galaxy A51 SamSung"
    ],
    [
        "ten_san_pham" => "lapTop lenovo Asus",
        "gia" => 15000,
        "Hinh_anh" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJ9BmFu4Lpa6_KDI9g2BFEegLjZ_ovYOBw8Q&s",
        "desccription" => "Day la mo ta ngan cua san pham lapTop lenovo Asus"
    ],
    [
        "ten_san_pham" => "Ipad samsung",
        "gia" => 16000,
        "Hinh_anh" => "https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-plus_4_.png",
        "desccription" => "Day la mo ta ngan cua san pham Ipad samsung"
    ],
    [
        "ten_san_pham" => "Nokia Apple Watch",
        "gia" => 18000,
        "Hinh_anh" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPYQYIq9Ys1m-HL0CnUzkM2VJRZceZHBoK5Q&s",
        "desccription" => "Day la mo ta ngan cua san pham Nokia Apple Watch"
    ]
];
if (!empty($_POST)) {
    $du_lieu_vua_nhap = [
        "ten_san_pham" => $_POST['ten_san_pham'],
        "gia" => $_POST['gia'],
        "Hinh_anh" => $_POST['Hinh_anh'],
        "desccription" => $_POST['desccription']
    ];
    array_push($danhSachSanPham, $du_lieu_vua_nhap);
}
    ?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <section class="product-list">
            <div class="container">
                <div class="row">
                    <?php foreach ($danhSachSanPham as $motCaiSanPham): ?>
                        <div class="col-lg-6">
                            <div class="product-item border mb-3 shadow rounded-3">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <img class="w-100" src="<?= $motCaiSanPham['Hinh_anh'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-3">
                                            <h3 class="title"><?= $motCaiSanPham['ten_san_pham'] ?></h3>
                                            <h6 class="category-name">Ghi danh muc</h6>
                                            <p class="price"> <?= $motCaiSanPham['gia'] ?></p>
                                            <hr>
                                            <p><?= $motCaiSanPham['desccription'] ?></p>
                                            <button class="btn btn-danger">Add to cart</button>
                                            <button class="btn btn-primary">More infor</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="form-product">
            <div class="container">
                <h2 class="title-section">Create Product</h2>
                <form action="" method="POST">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                <td>Ten san pham</td>
                                <td><input name="ten_san_pham" type="text" class="form-control"></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <td>Gia san pham</td>
                                <td><input name="gia" type="text" class="form-control"></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <td>Mo ta san pham</td>
                                <td><input name="desccription" type="text" class="form-control"></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <td>Hinh anh san pham</td>
                                <td><input name="Hinh_anh" type="file" class="form-control"></td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-success">Lưu lại</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>