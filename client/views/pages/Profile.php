<?php
if (!isset($user) || !$user) {
    $user = [];
}
$orders = $orders ?? [];
?>
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-4 text-center">
            <div class="profile-avatar"><i class="fas fa-user fa-3x text-danger"></i></div>
            <h5><?= htmlspecialchars($user['fullname']) ?></h5>
            <p class="text-muted">Thành viên từ <?= date('m/Y', strtotime($user['created_at'])) ?></p>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Đăng xuất</a>
        </div>
        <div class="col-md-8">
            <div class="card p-4 rounded-4">
                <h4 class="text-danger">Thông tin tài khoản</h4><hr>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($user['address']) ?></p>
                <button class="btn btn-red mt-2">Chỉnh sửa hồ sơ</button>
            </div>
            <div class="mt-4">
                <h5>Đơn hàng gần đây</h5>
                <div class="list-group">
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="list-group-item d-flex justify-content-between">
                                <span>#<?= $order['id'] ?> - <?= number_format($order['total']) ?>₫</span>
                                <span class="badge bg-danger">Đang giao</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Chưa có đơn hàng nào.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>