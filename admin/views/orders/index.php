<div class="main">
    <div class="card p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                Quản lý đơn hàng
            </h3>
        </div>
        <div class="table-responsive">
            <table
                class="table-bordered table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($danhSachDonHang as $order): ?>
                    <tr>
                        <td>
                            <?= $order['id'] ?>
                        </td>
                        <td class="fw-bold">
                            <?= $order['fullname'] ?>
                        </td>
                        <td>
                            <?= $order['phone'] ?>
                        </td>
                        <td>
                            <?= $order['address'] ?>
                        </td>
                        <td class="text-danger fw-bold">
                            <?= number_format(
                                $order['total'],
                                0,
                                ',',
                                '.'
                            ) ?>đ
                        </td>
                        <td>
                            <?= $order['created_at'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>