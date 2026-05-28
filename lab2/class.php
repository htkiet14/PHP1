<?php

class Student{
    private $name;

    public function capNhatName($ten) {
        $this->name = $ten;
    }

    public function layNameRaManHinh() {
        return $this->name;
    }
 
}

$sinh_vien_1 = new Student();
$sinh_vien_1->capNhatName("Tính");
echo $sinh_vien_1->layNameRaManHinh();