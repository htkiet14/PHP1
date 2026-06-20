<?php
if (!isset($items)) $items = [];
if (!isset($total)) $total = 0;
$error = $error ?? '';
?>
<div class="container py-5" style="max-width:600px">
    <h2 class="section-title">Thanh toán</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <div class="card p-4 rounded-4">
        <form method="POST" action="index.php?page=checkout">
            <div class="mb-3"><label>Họ tên</label><input type="text" name="fullname" class="form-control" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label>Số điện thoại</label><input type="text" name="phone" class="form-control" required></div>
            <div class="mb-3"><label>Địa chỉ</label><textarea name="address" class="form-control" rows="3" required></textarea></div>
            <div class="mb-3">
                <h5>Tổng tiền: <?= number_format($total) ?>₫</h5>
            </div>
            <button type="submit" class="btn btn-red w-100">Đặt hàng</button>
        </form>
    </div>
</div>