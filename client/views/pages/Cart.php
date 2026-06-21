<?php
if (!isset($items)) $items = [];
if (!isset($total)) $total = 0;
?>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="section-title mb-4">🛒 Giỏ hàng của bạn</h2>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center py-5">
                <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                <h4 class="text-muted">Giỏ hàng của bạn đang trống</h4>
                <p class="text-muted">Khám phá những sản phẩm mới nhất ngay!</p>
                <a href="index.php?page=list" class="btn btn-red mt-3">Tiếp tục mua sắm</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <!-- Danh sách sản phẩm -->
            <div class="col-lg-8">
                <div class="cart-items">
                    <?php foreach($items as $item): ?>
                    <div class="cart-item card mb-3 shadow-sm border-0 rounded-4 p-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-3 col-md-2">
                                <img src="<?= htmlspecialchars($item['image'] ?? 'assets/images/no-image.png') ?>" 
                                     class="img-fluid rounded-3" 
                                     alt="<?= htmlspecialchars($item['name']) ?>"
                                     style="max-height: 80px; object-fit: cover;">
                            </div>
                            <div class="col-9 col-md-4">
                                <h6 class="fw-bold mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                <span class="badge bg-danger"><?= number_format($item['price']) ?>₫</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-outline-secondary btn-sm qty-decrease" data-id="<?= $item['id'] ?>">−</button>
                                    <span class="qty-display fw-bold" id="qty-<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                                    <button class="btn btn-outline-secondary btn-sm qty-increase" data-id="<?= $item['id'] ?>">+</button>
                                </div>
                            </div>
                            <div class="col-4 col-md-2 text-end">
                                <span class="fw-bold text-danger"><?= number_format($item['subtotal']) ?>₫</span>
                            </div>
                            <div class="col-2 col-md-1 text-end">
                                <a href="index.php?page=cart_remove&id=<?= $item['id'] ?>" class="text-danger" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tổng kết -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-3">Tổng kết đơn hàng</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span><?= number_format($total) ?>₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span class="text-success">Miễn phí</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Giảm giá</span>
                        <span class="text-danger">0₫</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Thành tiền</span>
                        <span class="fw-bold fs-5 text-danger"><?= number_format($total) ?>₫</span>
                    </div>
                    <a href="index.php?page=checkout" class="btn btn-red w-100 py-2 fw-bold">
                        <i class="fas fa-credit-card me-2"></i>Tiến hành thanh toán
                    </a>
                    <a href="index.php?page=list" class="btn btn-outline-red w-100 mt-2">
                        <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    // Tăng giảm số lượng AJAX
    $('.qty-increase, .qty-decrease').on('click', function(e) {
        e.preventDefault();
        var itemId = $(this).data('id');
        var currentQty = parseInt($('#qty-' + itemId).text());
        var newQty = $(this).hasClass('qty-increase') ? currentQty + 1 : currentQty - 1;
        if (newQty < 1) return;

        $.ajax({
            url: 'index.php?page=cart_update',
            type: 'POST',
            data: { id: itemId, quantity: newQty },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('Cập nhật thất bại.');
                }
            },
            error: function() {
                alert('Không thể kết nối.');
            }
        });
    });

    // Hỗ trợ nhập trực tiếp số lượng (nếu muốn)
    $('.qty-display').on('dblclick', function() {
        var itemId = $(this).attr('id').replace('qty-', '');
        var currentVal = $(this).text();
        var input = $('<input>', {
            type: 'number',
            value: currentVal,
            min: 1,
            class: 'form-control form-control-sm',
            style: 'width: 60px; display: inline-block;'
        });
        $(this).replaceWith(input);
        input.focus().select();
        input.on('blur keyup', function(e) {
            if (e.type === 'blur' || e.key === 'Enter') {
                var newVal = parseInt($(this).val());
                if (isNaN(newVal) || newVal < 1) newVal = 1;
                updateQuantity(itemId, newVal);
            }
        });
    });

    function updateQuantity(itemId, quantity) {
        $.ajax({
            url: 'index.php?page=cart_update',
            type: 'POST',
            data: { id: itemId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') location.reload();
                else alert('Cập nhật thất bại.');
            },
            error: function() { alert('Không thể kết nối.'); }
        });
    }
});
</script>

<style>
.cart-item {
    transition: all 0.2s ease;
}
.cart-item:hover {
    background: #fafafa;
}
.qty-display {
    min-width: 30px;
    text-align: center;
    font-size: 1.1rem;
}
.sticky-top {
    z-index: 1;
}
</style>