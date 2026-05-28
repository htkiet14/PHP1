<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// session_start();

class SinhVien
{
    private $mssv;
    private $ho_ten;
    private $gioi_tinh;
    private $ngay_sinh;
    private $diem_tb;

    public function __construct($mssv = "", $ho_ten = "", $gioi_tinh = "", $ngay_sinh = "", $diem_tb = 0)
    {
        $this->mssv = $mssv;
        $this->ho_ten = $ho_ten;
        $this->gioi_tinh = $gioi_tinh;
        $this->ngay_sinh = $ngay_sinh;
        $this->diem_tb = $diem_tb;
    }

    public function getter($mssv, $ho_ten, $gioi_tinh, $ngay_sinh, $diem_tb)
    {
        $this->mssv;
        $this->ho_ten;
        $this->gioi_tinh;
        $this->ngay_sinh;
        $this->diem_tb;
    }

    public function setter($mssv, $ho_ten, $gioi_tinh, $ngay_sinh, $diem_tb)
    {
        return [
            $this->mssv = $mssv,
            $this->ho_ten = $ho_ten,
            $this->gioi_tinh = $gioi_tinh,
            $this->ngay_sinh = $ngay_sinh,
            $this->diem_tb = $diem_tb
        ];
    }

    public function HienThiThongTin()
    {
        return "MSSV: " . $this->mssv . "<br>" .
            "Họ tên: " . $this->ho_ten . "<br>" .
            "Giới tính: " . $this->gioi_tinh . "<br>" .
            "Ngày sinh: " . $this->ngay_sinh . "<br>" .
            "Điểm trung bình: " . $this->diem_tb;
    }
}

if (!isset($_SESSION['mang_sinh_vien'])) {
    $_SESSION['mang_sinh_vien'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sinh_vien = new SinhVien(
        $_POST['mssv'],
        $_POST['ho_ten'],
        $_POST['gioi_tinh'],
        $_POST['ngay_sinh'],
        $_POST['diem_tb']
    );
    $_SESSION['mang_sinh_vien'][] = $sinh_vien;
}

echo "<h2>Thông tin sinh viên đã lưu:</h2>";
if (!empty($_SESSION['mang_sinh_vien'])) {
    echo $sinh_vien-> HienThiThongTin();
} else {
    echo "Chưa có sinh viên nào.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Nhập thông tin sinh viên</h2>
    <form action="" method="POST">
        <label for="mssv">Mã số sinh viên: </label>
        <input type="text" name="mssv" id="mssv" required><br>

        <label for="ho_ten">Họ và tên: </label>
        <input type="text" name="ho_ten" id="ho_ten" required><br>

        <label for="gioi_tinh">Giới tính: </label>
        <select name="gioi_tinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select><br>

        <label for="ngay_sinh">Ngày sinh: </label>
        <input type="date" name="ngay_sinh" id="ngay_sinh" required><br>

        <label for="diem_tb">Điểm trung bình: </label>
        <input type="number" step="0.01" name="diem_tb" id="diem_tb" required><br>

        <button type="submit">Thêm sinh viên</button>
    </form>
</body>

</html>