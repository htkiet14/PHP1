<?php
require_once "BaseModel.php";

class Product extends BaseModel {

    public function __construct($pdo) {
        parent::__construct($pdo, "product");
    }

    public function getAllProducts() {
        $sql = "SELECT product.*, categories.name AS category_name
                FROM product
                LEFT JOIN categories ON categories.id = product.category_id";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneProduct($id) {
        return $this->getById($id);
    }

    public function addProduct($name,$price,$image,$description,$category_id) {
        $sql = "INSERT INTO product(name,price,image,description,category_id)
                VALUES(?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name,$price,$image,$description,$category_id]);
    }

    public function updateProduct($id,$name,$price,$image,$description,$category_id) {
        $sql = "UPDATE product 
                SET name=?, price=?, image=?, description=?, category_id=? 
                WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name,$price,$image,$description,$category_id,$id]);
    }

    public function deleteProduct($id) {
        return $this->delete($id);
    }
}