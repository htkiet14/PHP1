<?php
// $featured và $categories được truyền từ HomeController
if (!isset($featured) || !is_array($featured)) {
    $featured = [];
}
if (!isset($categories) || !is_array($categories)) {
    $categories = [];
}
?>

<!-- ============================================================
    CSS NHÚNG TRONG FILE (có thể chuyển ra file riêng sau)
============================================================ -->
<style>
    /* Banner Carousel */
    .banner-slider .carousel-item img {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }
    .banner-slider .carousel-caption {
        background: rgba(0,0,0,0.4);
        padding: 20px;
        border-radius: 10px;
        bottom: 30%;
    }
    .banner-slider .carousel-caption h2 {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    .banner-slider .carousel-caption p {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    /* Danh mục */
    .category-card {
        transition: all 0.3s ease;
        background: #f8f9fa;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: #333;
    }
    .category-card:hover {
        background: #dc3545;
        color: #fff !important;
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(220,53,69,0.2);
    }
    .category-card:hover i,
    .category-card:hover h5 {
        color: #fff !important;
    }
    .category-card i {
        font-size: 2.5rem;
        color: #dc3545;
    }

    /* Sản phẩm */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .product-img {
        height: 200px;
        overflow: hidden;
    }
    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .product-card:hover .product-img img {
        transform: scale(1.05);
    }
    .price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #dc3545;
    }
    .old-price {
        font-size: 0.9rem;
        color: #999;
        text-decoration: line-through;
    }

    /* Section title */
    .section-title {
        font-weight: 700;
        color: #dc3545;
        border-left: 5px solid #dc3545;
        padding-left: 15px;
        margin-bottom: 20px;
    }
    .section-title.text-center {
        border-left: none;
        border-bottom: 3px solid #dc3545;
        display: inline-block;
        padding-bottom: 5px;
    }
</style>

<!-- ============================================================
    NỘI DUNG TRANG HOME
============================================================ -->
<div class="container-fluid px-0">

    <!-- ===== BANNER SLIDER ===== -->
    <div id="bannerCarousel" class="carousel slide banner-slider" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/banner1.jpg" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h2>🔥 Siêu sale 50%</h2>
                    <p>Giày thể thao, giày sneaker chính hãng</p>
                    <a href="index.php?page=list" class="btn btn-danger btn-lg">Mua ngay</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner2.jpg" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h2>👟 Bộ sưu tập mới</h2>
                    <p>Phong cách thời thượng, chất lượng đỉnh cao</p>
                    <a href="index.php?page=list" class="btn btn-danger btn-lg">Xem ngay</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner3.jpg" class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                    <h2>🎯 Giày chạy bộ</h2>
                    <p>Êm nhẹ, bền bỉ, hỗ trợ tối đa</p>
                    <a href="index.php?page=list" class="btn btn-danger btn-lg">Khám phá</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sau</span>
        </button>
    </div>

    <!-- ===== DANH MỤC SẢN PHẨM ===== -->
    <div class="container py-5">
        <h2 class="section-title text-center"> Danh mục sản phẩm</h2>
        <div class="row g-4 justify-content-center mt-3">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <div class="col-md-3 col-sm-6">
                        <a href="index.php?page=list&category_id=<?= $cat['id'] ?>" class="category-card d-block p-4 text-center rounded-4 shadow-sm">
                            <i class="fas fa-tags"></i>
                            <h5 class="mt-2"><?= htmlspecialchars($cat['name']) ?></h5>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-center">Chưa có danh mục nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== SẢN PHẨM NỔI BẬT ===== -->
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title"> Sản phẩm nổi bật</h2>
            <a href="index.php?page=list" class="text-danger fw-bold">
                Xem tất cả <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php if (!empty($featured)): ?>
                <?php foreach ($featured as $product): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="product-card card h-100 text-center p-3">
                            <div class="product-img">
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>
                                <div class="price-wrapper mt-auto">
                                    <span class="price"><?= number_format($product['price']) ?>₫</span>
                                    <?php if (!empty($product['old_price'])): ?>
                                        <span class="old-price ms-2"><?= number_format($product['old_price']) ?>₫</span>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3 d-flex justify-content-center gap-2">
                                    <a href="index.php?page=detail&id=<?= $product['id'] ?>" class="btn btn-outline-danger btn-sm">Chi tiết</a>
                                    <button class="btn btn-danger btn-sm add-to-cart" data-id="<?= $product['id'] ?>">
                                        <i class="fas fa-cart-plus"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-center">Chưa có sản phẩm nổi bật.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- ============================================================
    JAVASCRIPT NHÚNG TRONG FILE
============================================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lấy tất cả nút "Thêm vào giỏ"
    const addBtns = document.querySelectorAll('.add-to-cart');

    addBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            const button = this;

            // Tạo request AJAX
            fetch('index.php?page=cart_add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + productId + '&quantity=1'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('✅ Đã thêm sản phẩm vào giỏ hàng!');
                    // Cập nhật số lượng giỏ hàng trên header (nếu có)
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_total;
                    }
                } else {
                    alert('❌ ' + (data.message || 'Có lỗi xảy ra!'));
                }
            })
            .catch(error => {
                alert('❌ Không thể kết nối đến server.');
                console.error('Error:', error);
            });
        });
    });

    // (Tùy chọn) Tự động chạy carousel mỗi 4 giây
    // Bạn có thể bật nếu muốn thay vì dùng data-bs-ride
    // const carousel = new bootstrap.Carousel(document.getElementById('bannerCarousel'), {
    //     interval: 4000,
    //     pause: 'hover'
    // });
});
</script>