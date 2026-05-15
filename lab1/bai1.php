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
        "name" => "Sứ Mệnh Hail Mary - Project Hail Mary",
        "price" => 136000,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
    ],
    [
        "id" => 3,
        "name" => "Người Đàn Ông Mang Tên OVE (Tái Bản)",
        "price" => 115200,
        "image" => "https://cdn1.fahasa.com/media/catalog/product/8/9/8934974182375.jpg"
    ],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        .product-list{
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card{
            width: 250px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover{
            transform: translateY(-5px);
        }

        .card img{
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .card-body{
            padding: 15px;
        }

        .card-title{
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            min-height: 50px;
        }

        .card-price{
            color: red;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .btn{
            display: inline-block;
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .btn:hover{
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="product-list">
        <?php foreach($products as $pro): ?>
            <div class="card">
                <img src="<?= $pro['image'] ?>" alt="<?= $pro['name'] ?>">

                <div class="card-body">
                    <h3 class="card-title"><?= $pro['name'] ?></h3>
                    <p class="card-price"><?= number_format($pro['price']) ?> VNĐ</p>
                    <a href="#" class="btn">Xem chi tiết</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>