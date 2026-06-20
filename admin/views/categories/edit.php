<div class="main">
    <h3>Sửa danh mục</h3>

    <form method="POST">

        <label>Tên danh mục</label>
        <input type="text"
               name="name"
               class="form-control mb-2"
               value="<?= $category['name'] ?>"
               required>

        <button type="submit" name="submit" class="btn btn-primary">
            Cập nhật
        </button>

        <a href="index.php?page=categories" class="btn btn-secondary">
            Hủy
        </a>

    </form>
</div>