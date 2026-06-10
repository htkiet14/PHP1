<?php

class ProductController{


    public function render(){
        $db = new Database();
        $pdo = $db->Connection();    
        $productModel = new Product($pdo);
        $danhSachSanPham = $productModel->getAllProducts();
        require "admin/views/products/index.php";

    }

}

