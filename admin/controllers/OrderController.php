<?php

class OrderController{


    public function render(){
        $db = new Database();
        $pdo = $db->Connection();    
        $orderModel = new Order($pdo);
        $danhSachDonHang = $orderModel->getAllOrder();
        require "admin/views/orders/index.php";

    }

}

