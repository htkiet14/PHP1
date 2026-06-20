<?php

class Category extends BaseModel {

    public function __construct($pdo) {
        parent::__construct($pdo, "categories");
    }

    // LIST
    public function getAllCategories() {
        return $this->getAll();
    }

    // GET ONE
    public function getOneCategory($id) {
        return $this->getById($id);
    }

    // ADD
    public function addCategory($name) {
        $sql = "INSERT INTO categories(name) VALUES(?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name]);
    }

    // UPDATE
    public function updateCategory($id, $name) {
        $sql = "UPDATE categories SET name=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $id]);
    }
}