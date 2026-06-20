<div class="main">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Quản lý danh mục</h3>

        <a href="index.php?page=categories&act=add"
           class="btn btn-success">
            + Thêm danh mục
        </a>
    </div>

    <!-- Table -->
    <div class="card p-4 shadow">

        <h5 class="mb-3">Danh sách danh mục</h5>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($danhSachDanhMuc as $dm): ?>
                    <tr>
                        <td><?= $dm['id'] ?></td>

                        <td class="text-start fw-bold">
                            <?= $dm['name'] ?>
                        </td>

                        <td>

                            <!-- EDIT -->
                            <a href="index.php?page=categories&act=edit&id=<?= $dm['id'] ?>"
                               class="btn btn-warning btn-sm me-2">
                                Sửa
                            </a>

                            <!-- DELETE -->
                            <a href="index.php?page=categories&act=delete&id=<?= $dm['id'] ?>"
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