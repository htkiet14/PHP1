<a href="Bai1.php">Lab 2 - Bài 1</a><br>
<a href="Bai2.php">Lab 2 - Bài 2</a><br>
<a href="Bai3.php">Lab 2 - Bài 3</a><br>


<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class SinhVien {
    // private, protected, public
    private $ho_ten;
    private $diem;

    public function nhap($ten,$diem) {
        $this -> ho_ten = $ten;
        $this -> diem = $diem;
        return $this -> diem;
    }

    public function xuat() {
        // khi gặp return thì hàm đó phải được lưu trữ và xử lý tiếp
        return $this -> diem; 
    }
    public function xeploai() {
        if($this -> diem < 5) {
            return $this -> ho_ten."<br>". $this->diem ."<br>". "Yếu";
        }

        if ($this -> diem < 7) {
            return $this -> ho_ten."<br>". $this->diem ."<br>"."Trung bình";
        }

        if ($this -> diem < 8) {
            return $this -> ho_ten."<br>". $this->diem ."<br>". "Khá";
        }

        if ($this -> diem < 9) {
            return $this->ho_ten."<br>". $this->diem ."<br>". "Giỏi";
        }

        if ($this -> diem <= 10) {
            return $this->ho_ten."<br>". $this->diem ."<br>". "Xuất sắc";
        } else {
            return "Nếu lớn hơn 10 lấy số lẻ kỳ sau lấy số chẵn";
        }
    }
}

// instance of Class
$dong = new SinhVien();
$dong -> nhap("Đồng", 8);
echo $dong -> xeploai();