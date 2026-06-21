<div class="main">
    <h3>Sửa danh mục</h3>

    <form method="POST" onsubmit="return validateCategoryEdit()">

        <label>Tên danh mục</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control mb-2"
               value="<?= $category['name'] ?>">

        <button type="submit" name="submit" class="btn btn-primary">
            Cập nhật
        </button>

        <a href="index.php?page=categories" class="btn btn-secondary">
            Hủy
        </a>

    </form>
</div>

<script>
function validateCategoryEdit() {

    let name = document.getElementById("name").value.trim();

    if (name === "") {
        alert("Tên danh mục không được để trống");
        return false;
    }

    return true;
}
</script>