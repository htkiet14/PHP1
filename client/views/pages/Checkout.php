<?php
$products = require __DIR__ . '/../../config/products.php';
if (!is_array($products)) {
    $products = [];
}
$cart_items = [['id'=>1,'quantity'=>1], ['id'=>2,'quantity'=>2]];
$total = 0;
?>
<div class="container py-5">
    <h2 class="section-title">Thông tin thanh toán</h2>
    <div class="row g-4">
        <div class="col-md-7">
            <form>
                <div class="mb-3"><label>Họ tên</label><input type="text" class="form-control" placeholder="Nguyễn Văn A"></div>
                <div class="mb-3"><label>Email</label><input type="email" class="form-control"></div>
                <div class="mb-3"><label>Địa chỉ giao hàng</label><textarea class="form-control" rows="2"></textarea></div>
                <div class="mb-3"><label>Ghi chú</label><textarea class="form-control" rows="2"></textarea></div>
            </form>
        </div>
        <div class="col-md-5">
            <div class="checkout-summary bg-light p-4 rounded-4">
                <h5>Đơn hàng của bạn</h5>
                <hr>
                <?php foreach($cart_items as $item): 
                    $product = $products[$item['id']];
                    $subtotal = $product['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <p><?= $product['name'] ?> x <?= $item['quantity'] ?> ... <?= number_format($subtotal) ?>₫</p>
                <?php endforeach; ?>
                <hr>
                <h5 class="text-danger">Tổng cộng: <?= number_format($total) ?>₫</h5>
                <div class="form-check mt-3"><input class="form-check-input" type="radio" name="payment" checked> <label>Thanh toán khi nhận hàng (COD)</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="payment"> <label>Chuyển khoản ngân hàng</label></div>
                <button class="btn btn-red w-100 mt-4">Xác nhận đặt hàng</button>
            </div>
        </div>
    </div>

    <!--  -->
</div>