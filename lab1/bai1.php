<?php
$products = [
    [
        "id" => 1,
        "name" => "Hồ Điệp Và Kình Ngư",
        "price" => 104000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/i/bia-2d_ho-diep-va-kinh-ngu_17307.jpg"
    ],
    [
        "id" => 2,
        "name" => "Sứ Mệnh Hail Mary",
        "price" => 136000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newProduct = [
        "id" => count($products) + 1,
        "name" => $_POST["name"],
        "price" => $_POST["price"],
        "image" => $_POST["image"]
    ];

    $products[] = $newProduct;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body{
            font-family: Arial;
            padding: 30px;
            background: #f2f2f2;
        }

        form{
            background: white;
            width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        input{
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        button{
            width: 100%;
            padding: 10px;
            background: blue;
            color: white;
            border: none;
        }

        .product-list{
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card{
            width: 220px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
            overflow: hidden;
        }

        .card img{
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .card-body{
            padding: 10px;
        }

        .price{
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 align="center">Thêm sản phẩm</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Tên sản phẩm" required>
    <input type="number" name="price" placeholder="Giá" required>
    <input type="text" name="image" placeholder="Link ảnh" required>
    <button type="submit">Thêm sản phẩm</button>
</form>

<div class="product-list">
    <?php foreach($products as $pro): ?>
        <div class="card">
            <img src="<?= $pro['image'] ?>">
            <div class="card-body">
                <h4><?= $pro['name'] ?></h4>
                <p class="price"><?= number_format($pro['price']) ?> VNĐ</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>