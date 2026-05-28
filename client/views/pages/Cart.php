<?php
$products = require __DIR__ . '/../../config/products.php';
if (!is_array($products)) {
    $products = [];
}
$cart_items = [
    ['id' => 1, 'quantity' => 1],
    ['id' => 2, 'quantity' => 2]
];
$total = 0;
?>
<div class="container py-5">
    <h2 class="section-title">Giỏ hàng của bạn</h2>
    <div class="table-responsive">
        <table class="table cart-table align-middle">
            <thead>
                <tr><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Tổng</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach($cart_items as $item): 
                    $product = $products[$item['id']];
                    $subtotal = $product['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><img src="<?= $product['image'] ?>" width="60" class="rounded"> <?= $product['name'] ?></td>
                    <td><?= number_format($product['price']) ?>₫</td>
                    <td><input type="number" class="form-control w-50" value="<?= $item['quantity'] ?>" min="1"></td>
                    <td><?= number_format($subtotal) ?>₫</td>
                    <td><a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-end">
        <div class="col-md-4">
            <div class="checkout-summary bg-light p-4 rounded-4">
                <h5>Tổng đơn hàng</h5>
                <hr>
                <p class="d-flex justify-content-between"><span>Tạm tính:</span><span><?= number_format($total) ?>₫</span></p>
                <p class="d-flex justify-content-between"><span>Phí vận chuyển:</span><span>Miễn phí</span></p>
                <h5 class="text-danger">Thành tiền: <?= number_format($total) ?>₫</h5>
                <a href="index.php?page=checkout" class="btn btn-red w-100 mt-3">Tiến hành thanh toán</a>
                <a href="index.php?page=list" class="btn btn-outline-red w-100 mt-2">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>