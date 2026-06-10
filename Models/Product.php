<?php
class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProducts()
    {
        $sql = "SELECT product.*, categories.name AS category_name FROM product JOIN categories ON categories.id = product.category_id;";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOneProduct(int $id)
    {
        $sql = "SELECT *FROM `product` WHERE `product`.`id` = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function searchProduct($keyword){
        $keyword = "%$keyword%"; // % là phía trước phía sau của từ khóa cũng đc
        $sql = "SELECT *FROM `products` JOIN `products`.`title`like ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['$keyword']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories(){
        $sql = "SELECT *FROM `categories`";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCategory($keyword){
        $keyword = "%$keyword%"; // % là phía trước phía sau của từ khóa cũng đc
        $sql = "SELECT *FROM `categories` JOIN `categories`.`name`like ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['$keyword']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}