<?php
class ProductController {

    private $productModel;
    private $categoryModel;


    public function __construct() {
        $db = new Database();
        $this->productModel = new Product($db->Connection());
        $this->categoryModel = new Category($db->Connection());
    }

    // LIST
    public function render() {
        $danhSachSanPham = $this->productModel->getAllProducts();
        require "admin/views/products/index.php";
    }

    // ADD
    public function add() {
        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);

            $this->productModel->addProduct($name,$price,$image,$description,$category_id);

            header("Location: index.php?page=products");
            exit;
        }
        $categories = $this->categoryModel->getAll();

        require "admin/views/products/add.php";
    }

    public function edit() {
        $id = $_GET['id'];
        $product = $this->productModel->getOneProduct($id);
        $categories = $this->categoryModel->getAll();
        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $image = $_FILES['image']['name'];

            if ($image != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
            } else {
                $image = $product['image'];
            }

            // FIX: gọi đúng hàm
            $this->productModel->updateProduct($id,$name,$price,$image,$description,$category_id);

            header("Location: index.php?page=products");
            exit;
        }

        require "admin/views/products/edit.php";
    }

    // DELETE
    public function delete() {
        $id = $_GET['id'];

        $this->productModel->deleteProduct($id);

        header("Location: index.php?page=products");
        exit;
    }
}