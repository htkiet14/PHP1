<div class="container py-5" style="max-width:500px">
    <div class="card border-0 rounded-4 p-4 shadow-sm">
        <h3 class="text-center text-danger fw-bold">Đăng ký thành viên</h3>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="index.php?page=register">
            <div class="mb-3"><label>Họ và tên</label><input type="text" name="fullname" class="form-control" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label>Số điện thoại</label><input type="text" name="phone" class="form-control" required></div>
            <div class="mb-3"><label>Địa chỉ</label><input type="text" name="address" class="form-control"></div>
            <div class="mb-3"><label>Mật khẩu</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3"><label>Xác nhận mật khẩu</label><input type="password" name="confirm_password" class="form-control" required></div>
            <button type="submit" class="btn btn-red w-100">Đăng ký</button>
            <div class="text-center mt-3"><a href="index.php?page=login" class="text-danger">Đã có tài khoản? Đăng nhập</a></div>
        </form>
    </div>
</div>