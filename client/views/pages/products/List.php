<?php
if (!isset($products) || !is_array($products)) {
    $products = [];
}
if (!isset($totalProducts)) {
    $totalProducts = 0;
}
if (!isset($categories) || !is_array($categories)) {
    $categories = [];
}
$currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$totalPages = isset($totalPages) ? (int)$totalPages : 1;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';
?>
<div class="container py-4">
    <div class="row">
        <aside class="col-md-3 mb-4">
            <div class="filter-sidebar p-3 bg-light rounded-4">
                <h5 class="fw-bold text-danger">Bộ lọc</h5>
                <hr>
                <h6>Danh mục</h6>
                <?php foreach ($categories as $cat): ?>
                    <div class="form-check">
                        <input class="form-check-input filter-category" type="checkbox" 
                               value="<?= $cat['id'] ?>" 
                               <?= ($category_id == $cat['id']) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= htmlspecialchars($cat['name']) ?></label>
                    </div>
                <?php endforeach; ?>
                <h6 class="mt-3">Khoảng giá</h6>
                <select class="form-select" id="price-filter">
                    <option value="">Tất cả</option>
                    <option value="0-1000000">Dưới 1tr</option>
                    <option value="1000000-2000000">1tr - 2tr</option>
                    <option value="2000000-99999999">Trên 2tr</option>
                </select>
                <button class="btn btn-red w-100 mt-3" id="apply-filter">Áp dụng</button>
            </div>
        </aside>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title">Tất cả sản phẩm</h2>
                <span>Hiển thị <?= count($products) ?> / <?= $totalProducts ?> sản phẩm</span>
            </div>

            <form method="GET" action="index.php" class="mb-3">
                <input type="hidden" name="page" value="list">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="<?= $keyword ?>">
                    <button class="btn btn-red" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <div class="row g-4">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="product-card card p-3 text-center h-100 shadow-sm">
                                <img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid mb-2" style="height: 200px; object-fit: cover;" alt="<?= htmlspecialchars($product['name']) ?>">
                                <h6><?= htmlspecialchars($product['name']) ?></h6>
                                <div class="price text-danger fw-bold"><?= number_format($product['price']) ?>₫</div>
                                <div class="mt-2">
                                    <a href="index.php?page=detail&id=<?= $product['id'] ?>" class="btn btn-outline-red btn-sm">Xem chi tiết</a>
                                    <button class="btn btn-danger btn-sm add-to-cart" data-id="<?= $product['id'] ?>">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">Không có sản phẩm nào</div>
                <?php endif; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=list&page_num=<?= $currentPage - 1 ?>&category_id=<?= $category_id ?>&keyword=<?= urlencode($keyword) ?>">«</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a class="page-link" href="index.php?page=list&page_num=<?= $i ?>&category_id=<?= $category_id ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=list&page_num=<?= $currentPage + 1 ?>&category_id=<?= $category_id ?>&keyword=<?= urlencode($keyword) ?>">»</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Thêm vào giỏ hàng từ danh sách
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        var btn = $(this);
        $.ajax({
            url: 'index.php?page=cart_add',
            type: 'POST',
            data: { id: productId, quantity: 1 },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Đã thêm vào giỏ hàng!');
                    if ($('#cart-count').length) {
                        $('#cart-count').text(response.cart_total);
                    }
                    if ($('.cart-badge').length) {
                        $('.cart-badge').text(response.cart_total);
                    }
                } else {
                    alert(response.message || 'Có lỗi xảy ra.');
                }
            },
            error: function() {
                alert('Không thể kết nối đến server.');
            }
        });
    });

    // Lọc theo danh mục
    $('#apply-filter').click(function() {
        var checked = $('.filter-category:checked').val();
        var url = 'index.php?page=list';
        if (checked) {
            url += '&category_id=' + checked;
        }
        window.location.href = url;
    });
});
</script>