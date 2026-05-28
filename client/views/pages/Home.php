<?php 
$products = require __DIR__ . '/../../config/products.php';
// Kiểm tra nếu $products không phải mảng thì gán mảng rỗng
if (!is_array($products)) {
    $products = [];
}
$featured = array_slice($products, 0, 4, true);
?>
<div class="container py-4">
    <!-- Phần hero banner giữ nguyên -->
    ...
    <!-- Sản phẩm nổi bật -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title">Sản phẩm nổi bật</h2>
            <a href="index.php?page=list" class="text-danger">Xem tất cả <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="row g-4 mt-2">
            <?php if (empty($featured)): ?>
                <p class="text-muted">Chưa có sản phẩm nổi bật.</p>
            <?php else: ?>
                <?php foreach($featured as $product): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-card card h-100 text-center p-3">
                        <div class="product-img"><img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>"></div>
                        <div class="card-body">
                            <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>
                            <div><span class="price"><?= number_format($product['price']) ?>₫</span> <span class="old-price"><?= number_format($product['old_price']) ?>₫</span></div>
                            <a href="index.php?page=detail&id=<?= $product['id'] ?>" class="btn btn-outline-red mt-2 btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
     
</div>