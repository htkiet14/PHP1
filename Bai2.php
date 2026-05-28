<?php

class Product {
    private $name;
    private $price;
    private $quantity;

    public function setNamePriceQuantity(string $name,int $price,int $quantity) {
        $this -> name = $name;
        if ($price > 0 && is_numeric($price)) {
            $this -> price = $price;
        }
        if ($price > 0 && is_numeric($price)) {
            $this -> quantity = $quantity;
        }
    }

    public function getInfo() {
        return "Tên sản phẩm: ". $this->name ."<br>".
        "Giá: ". $this->price ." VNĐ". "<br>".
        "Số lượng: ". $this->quantity. "<br>";
    }

    public function calculateTotal() {
        return $this->price * $this->quantity;
    }
}

$Product = new Product;
$Product -> setNamePriceQuantity("Áo thun", 5000, 10);
echo $Product->getInfo();
echo "Total: ". $Product->calculateTotal(). " VNĐ";