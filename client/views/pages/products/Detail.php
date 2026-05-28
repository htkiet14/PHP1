<?php 
$products = require __DIR__ . '/../../../config/products.php';
if (!is_array($products)) {
    $products = [];
}
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $products[$product_id] ?? null;
if (!$product) {
    echo '<div class="container py-5"><div class="alert alert-danger">Sản phẩm không tồn tại.</div></div>';
    return;
}
?>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-5">
            <img src="<?= $product['image'] ?>" class="img-fluid rounded-4 shadow-sm">
        </div>
        <div class="col-md-7">
            <span class="badge bg-danger mb-2"><?= $product['category'] ?></span>
            <h1><?= $product['name'] ?></h1>
            <div class="price mb-2"><?= number_format($product['price']) ?>₫ <span class="old-price"><?= number_format($product['old_price']) ?>₫</span></div>
            <p class="text-muted"><?= $product['description'] ?></p>
            <div class="mb-3">
                <label class="fw-bold">Size:</label> 
                <div class="d-flex gap-2 mt-1">
                    <?php foreach($product['sizes'] as $size): ?>
                    <button class="btn btn-outline-secondary btn-sm"><?= $size ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-4">
                <label class="fw-bold">Số lượng:</label> 
                <input type="number" class="form-control w-25" value="1" min="1" max="<?= $product['stock'] ?>">
            </div>
            <div class="d-flex gap-3">
                <a href="index.php?page=cart&add=<?= $product['id'] ?>" class="btn btn-red px-4"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</a>
                <a href="index.php?page=checkout" class="btn btn-outline-red">Mua ngay</a>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h4 class="section-title">Mô tả chi tiết</h4>
        <p><?= $product['description'] ?> Sản phẩm còn <?= $product['stock'] ?> chiếc trong kho.</p>
    </div>
    <!--  -->
</div>