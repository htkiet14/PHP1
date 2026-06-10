<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý danh mục</h2>
    <a href="?act=add-category" class="btn btn-success">
        Thêm danh mục
    </a>
</div>
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        Danh sách danh mục
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th width="180">Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($danhSachDanhMuc as $dm): ?>
                <tr>
                    <td><?= $dm['id'] ?></td>
                    <td class="fw-bold">
                        <?= $dm['name'] ?>
                    </td>
                    <td>
                        <a href="?act=edit-category&id=<?= $dm['id'] ?>"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>
                        <a href="?act=delete-category&id=<?= $dm['id'] ?>"
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
</div>
