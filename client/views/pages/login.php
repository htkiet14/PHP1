<div class="container py-5" style="max-width:500px">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="text-center text-danger fw-bold">Đăng nhập</h3>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="index.php?page=login">
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" placeholder="example@mail.com" required></div>
            <div class="mb-3"><label>Mật khẩu</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3 form-check"><input type="checkbox" name="remember" class="form-check-input"><label>Ghi nhớ đăng nhập</label></div>
            <button type="submit" class="btn btn-red w-100">Đăng nhập</button>
            <div class="text-center mt-3"><a href="index.php?page=register" class="text-danger">Chưa có tài khoản? Đăng ký ngay</a></div>
        </form>
    </div>
</div>