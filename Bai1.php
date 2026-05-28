<?php

class Person {
    private $name;
    private $age;
    private $address;

    public function setNameAgeAddress(string $name,int $age,string $address) {
        $this -> name = $name;
        if ($age > 0 && is_numeric($age)) {
            $this -> age = $age;
        }
        $this -> address = $address;
    }

    public function getInfo() {
        return "Tên: " .$this->name. "<br>".
        "Tuổi: " .$this->age. "<br>".
        "Địa chỉ: " .$this->address;
    }

    public function canVote() {
        if ($this->age >= 18) {
            echo "Bạn ". $this->name. " có thể bỏ phiếu.";
            return true;
        } else {
            echo "Bạn ". $this->name. " không thể bỏ phiếu.";
            return false;
        }
    }
   
}

$nguoi = new Person;
$nguoi -> setNameAgeAddress("Đồng", 18, "Tỉnh Sóc Trăng");
echo $nguoi->getInfo(). "<br>";
echo $nguoi
->canVote();