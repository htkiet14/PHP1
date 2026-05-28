<?php
class ProductController {
    public function list() {
        require "views/pages/products/List.php";
    }

    public function detail() {
        require "views/pages/products/Detail.php";
    }
}