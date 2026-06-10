<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý sản phẩm</h2>

    <a href="?act=add" class="btn btn-success">
        Thêm sản phẩm
    </a>
</div>

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        Danh sách sản phẩm
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle text-center">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th width="180">Thao tác</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($danhSachSanPham as $sp): ?>

                <tr>

                    <td><?= $sp['id'] ?></td>

                    <td>
                        <img src="uploads/<?= $sp['image'] ?>"
                             width="80"
                             class="img-thumbnail">
                    </td>

                    <td class="text-start fw-bold">
                        <?= $sp['name'] ?>
                    </td>

                    <td class="text-danger fw-bold">
                        <?= number_format($sp['price'],0,',','.') ?>đ
                    </td>

                    <td>
                        <span class="badge bg-info">
                            <?= $sp['category_name'] ?? $sp['category_id'] ?>
                        </span>
                    </td>

                    <td>
                        <a href="?act=edit&id=<?= $sp['id'] ?>"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <a href="?act=delete&id=<?= $sp['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa?')">
                            Xóa
                        </a>
                    </td>

                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
```

</div>
