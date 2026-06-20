<?php

class CategoryController {

    private $model;

    public function __construct() {
        $db = new Database();
        $this->model = new Category($db->Connection());
    }

    // LIST
    public function render() {
        $danhSachDanhMuc = $this->model->getAllCategories();
        require "admin/views/categories/index.php";
    }

    // ADD
    public function add() {
        if (isset($_POST['submit'])) {

            $name = $_POST['name'];

            $this->model->addCategory($name);

            header("Location: index.php?page=categories");
            exit;
        }

        require "admin/views/categories/add.php";
    }

    // EDIT
    public function edit() {
        $id = $_GET['id'];

        $category = $this->model->getOneCategory($id);

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];

            $this->model->updateCategory($id, $name);

            header("Location: index.php?page=categories");
            exit;
        }

        require "admin/views/categories/edit.php";
    }

    // DELETE (BaseModel dùng)
    public function delete() {
        $id = $_GET['id'];

        $this->model->delete($id);

        header("Location: index.php?page=categories");
        exit;
    }
}