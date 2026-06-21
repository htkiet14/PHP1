<div class="main">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="mb-0">
                Quản lý tài khoản
            </h3>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Họ tên</th>

                        <th>Email</th>

                        <th>Vai trò</th>

                        <th>Chức năng</th>

                    </tr>

                </thead>

                <tbody>

                <?php if(!empty($users)): ?>

                    <?php foreach($users as $user): ?>

                    <tr>

                        <td>
                            <?= $user['id'] ?>
                        </td>

                        <td class="fw-bold">
                            <?= $user['fullname'] ?>
                        </td>

                        <td>
                            <?= $user['email'] ?>
                        </td>

                        <td>

                            <?php if($user['role']=="admin"): ?>

                                <span class="badge bg-danger px-3 py-2">
                                    Admin
                                </span>

                            <?php else: ?>

                                <span class="badge bg-primary px-3 py-2">
                                    User
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <button
                                class="btn btn-warning btn-sm"
                            >
                                Sửa
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                            >
                                Xóa
                            </button>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5">

                            Không có dữ liệu tài khoản

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
