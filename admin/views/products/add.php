<div class="main">
<h3>Thêm sản phẩm</h3>

<form method="POST" enctype="multipart/form-data">

<label>Tên sản phẩm</label>
<input type="text" name="name" class="form-control mb-2" required>

<label>Giá</label>
<input type="number" name="price" class="form-control mb-2" required>

<label>Ảnh</label>
<input type="file" name="image" class="form-control mb-2" required>

<label>Mô tả</label>
<textarea name="description" class="form-control mb-2"></textarea>

<label>Danh mục</label>
<select name="category_id" class="form-control mb-3">
<option value="1">Category 1</option>
<option value="2">Category 2</option>
</select>

<button type="submit" name="submit" class="btn btn-success">Thêm</button>
<a href="?act=list" class="btn btn-secondary">Hủy</a>

</form>
</div>