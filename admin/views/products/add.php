<div class="main">
<h3>Thêm sản phẩm</h3>

<form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

<label>Tên sản phẩm</label>
<input type="text" id="name" name="name" class="form-control mb-2">

<label>Giá</label>
<input type="number" id="price" name="price" class="form-control mb-2">

<label>Ảnh</label>
<input type="file" id="image" name="image" class="form-control mb-2">

<label>Mô tả</label>
<textarea id="description" name="description" class="form-control mb-2"></textarea>

<label>Danh mục</label>

<select id="category_id" name="category_id" class="form-control mb-3">

    <option value="">-- Chọn danh mục --</option>

    <?php foreach ($categories as $cat): ?>
        <option value="<?=$cat['id']?>">
            <?=$cat['name']?>
        </option>
    <?php endforeach; ?>

</select>

<button type="submit" name="submit" class="btn btn-success">Thêm</button>
<a href="?act=list" class="btn btn-secondary">Hủy</a>

</form>
</div>

<script>
function validateForm() {

    let ten = document.getElementById("name").value.trim();
    let gia = document.getElementById("price").value.trim();
    let anh = document.getElementById("image").value.trim();
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

    if (anh === "") {
        alert("Vui lòng chọn ảnh");
        return false;
    }

    if (mota === "") {
        alert("Mô tả không được để trống");
        return false;
    }

    if (dm === "") {
        alert("Vui lòng chọn danh mục");
        return false;
    }

    return true;
}
</script>