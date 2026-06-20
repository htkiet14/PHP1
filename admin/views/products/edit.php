<div class="main">
<h3>Sửa sản phẩm</h3>

<form method="POST" enctype="multipart/form-data">

<label>Tên</label>
<input type="text" name="name" class="form-control mb-2" value="<?=$product['name']?>">

<label>Giá</label>
<input type="number" name="price" class="form-control mb-2" value="<?=$product['price']?>">

<label>Ảnh hiện tại</label><br>
<img src="uploads/<?=$product['image']?>" width="100"><br><br>

<input type="file" name="image" class="form-control mb-2">

<label>Mô tả</label>
<textarea name="description" class="form-control mb-2"><?=$product['description']?></textarea>

<label>Danh mục</label>
<input type="number" name="category_id" class="form-control mb-2" value="<?=$product['category_id']?>">

<button name="submit" class="btn btn-primary">Cập nhật</button>
<a href="index.php?page=products" class="btn btn-secondary">Hủy</a>

</form>
</div>