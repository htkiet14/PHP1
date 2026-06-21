<div class="main">
    <h3>Thêm danh mục</h3>

    <form method="POST" onsubmit="return validateCategory()">

        <label>Tên danh mục</label>
        <input type="text" id="name" name="name" class="form-control mb-2">

        <button type="submit" name="submit" class="btn btn-success">
            Thêm
        </button>

        <a href="index.php?page=categories" class="btn btn-secondary">
            Hủy
        </a>

    </form>
</div>

<script>
function validateCategory() {

    let name = document.getElementById("name").value.trim();

    if (name === "") {
        alert("Tên danh mục không được để trống");
        return false;
    }

    return true;
}
</script>