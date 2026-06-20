<div class="main">
<div class="d-flex justify-content-between align-items-center mb-3">
<h3>Quản lý sản phẩm</h3>
<a href="index.php?page=products&act=add" class="btn btn-success">+ Thêm</a>
</div>

<div class="card p-3">
<table class="table table-bordered text-center align-middle">
<thead class="table-dark">
<tr>
<th>ID</th><th>Ảnh</th><th>Tên</th><th>Giá</th><th>DM</th><th>Hành động</th>
</tr>
</thead>
<tbody>

<?php if(!empty($danhSachSanPham)) foreach($danhSachSanPham as $sp){ ?>
<tr>
<td><?=$sp['id']?></td>
<td><img src="uploads/<?=$sp['image']?>" style="width:70px;height:70px;object-fit:cover"></td>
<td class="text-start fw-bold"><?=$sp['name']?></td>
<td class="text-danger fw-bold"><?=number_format($sp['price'],0,',','.')?>đ</td>
<td><span class="badge bg-info"><?=$sp['category_name']??$sp['category_id']?></span></td>
<td>
<a href="index.php?page=products&act=edit&id=<?=$sp['id']?>" class="btn btn-warning btn-sm">Sửa</a>

<a href="index.php?page=products&act=delete&id=<?=$sp['id']?>"
   onclick="return confirm('Xóa?')" class="btn btn-danger btn-sm">Xóa</a>
</td>
</tr>
<?php } else { ?>
<tr><td colspan="6">Chưa có sản phẩm</td></tr>
<?php } ?>

</tbody>
</table>
</div>
</div>