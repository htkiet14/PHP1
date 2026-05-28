<?php 
$products = require __DIR__ . '/../../../config/products.php';
if (!is_array($products)) {
    $products = [];
}
?>
<div class="container py-4">
    <div class="row">
        <aside class="col-md-3 mb-4">
            <!-- Bộ lọc giữ nguyên -->
            <div class="filter-sidebar p-3 bg-light rounded-4">
                <h5 class="fw-bold text-danger">Bộ lọc</h5>
                <hr>
                <h6>Danh mục</h6>
                <div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label">Thể thao</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label">Lười</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label">Cao gót</label></div>
                <h6 class="mt-3">Khoảng giá</h6>
                <select class="form-select"><option>Dưới 1tr</option><option>1tr - 2tr</option><option>Trên 2tr</option></select>
                <button class="btn btn-red w-100 mt-3">Áp dụng</button>
            </div>
        </aside>
        <div class="col-md-9">
            <div class="d-flex justify-content-between">
                <h2 class="section-title">Tất cả giày</h2>
                <span>Hiển thị <?= count($products) ?> sản phẩm</span>
            </div>
            <div class="row g-4">
                <?php foreach($products as $product): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="product-card card p-3 text-center h-100">
                        <img src="<?= $product['image'] ?>" class="img-fluid mb-2">
                        <h6><?= $product['name'] ?></h6>
                        <div class="price"><?= number_format($product['price']) ?>₫</div>
                        <a href="index.php?page=detail&id=<?= $product['id'] ?>" class="btn btn-outline-red mt-2">Xem chi tiết</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--  -->
</div>