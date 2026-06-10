<?php

class CategoryController{


    public function render(){

        $db = new Database();
        $pdo = $db->Connection();
        $productModel = new Product($pdo);
        $danhSachDanhMuc = $productModel->getAllCategories();
        require "admin/views/categories/index.php";

    }

}

?>