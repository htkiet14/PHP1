<?php
/**
 * @var array $product Dữ liệu sản phẩm từ controller
 */
if (!isset($product) || empty($product)) {
    echo '<div class="container py-5"><div class="alert alert-danger">Sản phẩm không tồn tại.</div></div>';
    return;
}

// Xử lý ảnh
$imagePath = !empty($product['image']) ? htmlspecialchars($product['image']) : 'assets/images/no-image.png';
$images = $product['images'] ?? [];
?>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-5">
            <div class="product-gallery">
                <img src="<?= $imagePath ?>" 
                     class="img-fluid rounded-4 shadow-sm" 
                     alt="<?= htmlspecialchars($product['name']) ?>"
                     style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            <?php if (!empty($images) && is_array($images)): ?>
            <div class="d-flex gap-2 mt-3">
                <?php foreach ($images as $img): ?>
                    <img src="<?= htmlspecialchars($img) ?>" 
                         class="img-thumbnail" 
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                         onclick="changeMainImage(this.src)">
                <?php endforeach; ?>
            </div>
            <script>
                function changeMainImage(src) {
                    document.querySelector('.product-gallery img').src = src;
                }
            </script>
            <?php endif; ?>
        </div>

        <div class="col-md-7">
            <span class="badge bg-danger mb-2"><?= htmlspecialchars($product['category_name'] ?? 'Danh mục') ?></span>
            <h1 class="mb-3"><?= htmlspecialchars($product['name']) ?></h1>
            <div class="price-wrapper mb-3">
                <span class="price text-danger fw-bold fs-3"><?= number_format($product['price']) ?>₫</span>
                <?php if (!empty($product['old_price']) && $product['old_price'] > $product['price']): ?>
                    <span class="old-price text-muted text-decoration-line-through ms-3 fs-5"><?= number_format($product['old_price']) ?>₫</span>
                <?php endif; ?>
            </div>
            <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'] ?? '')) ?></p>

            <!-- Số lượng -->
            <div class="mb-4">
                <label class="fw-bold">Số lượng:</label>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="decreaseQty()">−</button>
                    <input type="number" id="qty-input" class="form-control text-center" value="1" min="1" max="10" style="width: 80px;">
                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="increaseQty()">+</button>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="d-flex gap-3 flex-wrap">
                <button class="btn btn-danger px-4 add-to-cart-detail" data-id="<?= $product['id'] ?>">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                </button>
                <a href="index.php?page=checkout&id=<?= $product['id'] ?>" class="btn btn-outline-danger">Mua ngay</a>
            </div>
        </div>
    </div>

    <!-- Mô tả chi tiết -->
    <div class="mt-5">
        <h4 class="section-title">Mô tả chi tiết</h4>
        <div class="p-4 bg-light rounded-4">
            <p><?= nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả cho sản phẩm này.')) ?></p>
        </div>
    </div>
</div>

<script>
function increaseQty() {
    let qty = document.getElementById('qty-input');
    let val = parseInt(qty.value);
    if (val < 10) qty.value = val + 1;
}
function decreaseQty() {
    let qty = document.getElementById('qty-input');
    let val = parseInt(qty.value);
    if (val > 1) qty.value = val - 1;
}

$(document).ready(function() {
    $('.add-to-cart-detail').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        var quantity = $('#qty-input').val();

        if (quantity < 1 || quantity > 10) {
            alert('Số lượng không hợp lệ (1-10).');
            return;
        }

        $.ajax({
            url: 'index.php?page=cart_add',
            type: 'POST',
            data: { id: productId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Đã thêm ' + quantity + ' sản phẩm vào giỏ hàng!');
                    // Cập nhật badge
                    $('.cart-badge, #cart-count').text(response.cart_total);
                } else {
                    alert(response.message || 'Có lỗi xảy ra.');
                }
            },
            error: function() {
                alert('Không thể kết nối đến server.');
            }
        });
    });
});
</script>