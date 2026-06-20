<?php
class Order {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $sql = "INSERT INTO orders (fullname, phone, address, email, total) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['fullname'],
            $data['phone'],
            $data['address'],
            $data['email'],
            $data['total']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE email = ? ORDER BY created_at DESC");
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
