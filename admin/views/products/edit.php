<div class="main">
<h3>Sửa sản phẩm</h3>

<form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

<label>Tên</label>
<input type="text" id="name" name="name" class="form-control mb-2"
value="<?=$product['name']?>">

<label>Giá</label>
<input type="number" id="price" name="price" class="form-control mb-2"
value="<?=$product['price']?>">

<label>Ảnh hiện tại</label><br>
<img src="uploads/<?=$product['image']?>" width="100"><br><br>

<input type="file" id="image" name="image" class="form-control mb-2">

<label>Mô tả</label>
<textarea id="description" name="description" class="form-control mb-2"><?=$product['description']?></textarea>

<label>Danh mục</label>
<select id="category_id" name="category_id" class="form-control mb-2">

    <option value="">-- Chọn danh mục --</option>

    <?php foreach ($categories as $cat): ?>
        <option value="<?=$cat['id']?>"
            <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
            <?=$cat['name']?>
        </option>
    <?php endforeach; ?>

</select>

<button name="submit" class="btn btn-primary">Cập nhật</button>
<a href="index.php?page=products" class="btn btn-secondary">Hủy</a>

</form>
</div>

<script>
function validateForm() {

    let ten = document.getElementById("name").value.trim();
    let gia = document.getElementById("price").value.trim();
    let mota = document.getElementById("description").value.trim();
    let dm = document.getElementById("category_id").value;

    if (ten === "") {
        alert("Tên sản phẩm không được để trống");
        return false;
    }

    if (gia === "") {
        alert("Giá không được để trống");
        return false;
    }

    if (mota === "") {
        alert("Mô tả không được để trống");
        return false;
    }

    if (dm === "") {
        alert("Vui lòng chọn danh mục hợp lệ");
        return false;
    }

    return true;
}
</script>